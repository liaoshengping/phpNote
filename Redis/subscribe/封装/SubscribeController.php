<?php

namespace console\controllers\redis;

use common\models\SystemRedisSubRecord;
use common\redis_publish\base\PublishAbstract;
use common\redis_publish\base\RedisClient;
use common\services\system\log\LogService;
use common\services\system\redis\RedisSubRecordService;
use console\controllers\ConsoleBaseController;
use yii\base\Exception;

class SubscribeController extends ConsoleBaseController
{
    /**
     * 订阅通道
     * @var string
     */
    public $channel = 'channel_name';
    /**
     * 执行订阅脚本
     */
    public function actionIndex()
    {
        $redis = RedisClient::init();
        echo '开启成功' . PHP_EOL;
//        $this->restoreData();
//        开启锁
        $file = fopen(\Yii::getAlias('@data').'/other/system/lock/'.$this->channel.'_lock.txt','r');
        flock($file,LOCK_EX|LOCK_NB);
        //设置超时控制
        $redis->setOption(\Redis::OPT_READ_TIMEOUT, -1);
        $redis->subscribe([$this->channel], function (\Redis $instance, $channel, $message) {
            try{
                $this->distribution($message);
                echo '执行成功' . PHP_EOL;
            }catch (\Exception $exception){
                $msg = '订阅失败，原因：'.$exception->getMessage().'数据：'.$message;
                RedisSubRecordService::saveRecord('',$message,$this->channel,$msg);
                LogService::error($msg);
                echo $msg.PHP_EOL;
            }

        });

    }

    /**
     * 内容分发
     * @param string $params
     *
     */
    public function distribution($params=''){
//        $redis = RedisClient::init();
        $data = json_decode($params, true);
        $namespace = $data['namespace'];
        if(!class_exists($namespace)){
//            $redis->hDel($this->channel,$data['id']);
            throw new Exception($namespace.'>>>Class does not exist');
        };

        /**
         * @var $obj PublishAbstract
         */
        $obj = new $namespace();
        $obj->handle($data['params']);
//        if($redis->hGet($this->channel,$data['id'])){
//            $redis->hDel($this->channel,$data['id']);
//        }
        unset($obj);
    }

    /**
     * 系统挂掉之后恢复没有执行完成的任务  -》会挂掉，取消，待优化
     * @throws Exception
     */
    private function restoreData(){
        $redis = RedisClient::init();
        $hgetAll =$redis->hGetAll($this->channel);
        if(!empty($hgetAll)){
            echo '执行挂掉之后剩下的任务'.PHP_EOL;
            foreach ($hgetAll as $key=>$value){
                $this->distribution($value);
            }
        }
    }

    /**
     * 错误处理
     */
    public function actionError(){
        //扩展，可查询等待处理的数量
        $obj = SystemRedisSubRecord::find();
        $recrod = $obj->where([
            'status'=>RedisSubRecordService::Wait_Status,
            'channel'=>$this->channel,
        ])->asArray()
            ->all();
        if(empty($recrod)){
            echo "没有等待异常处理的数据".PHP_EOL;
            return false;
        }
        foreach ($recrod as $key=>$value){
            try{
                $this->distribution($value['params']);
                echo "重新执行成功".PHP_EOL;
                LogService::info('重新执行订阅成功id为：'.$key);
                RedisSubRecordService::finishRecord($value['id']);
            }catch (\Exception$exception){
                echo '重新订阅错误原因:'.$exception->getMessage().'数据库id:'.$value['id'];
                RedisSubRecordService::saveRecord($value['id'],$value['params'],$value['channel'],$exception->getMessage().$exception->getFile().$exception->getLine());
                continue;
            }
        }
    }
}
