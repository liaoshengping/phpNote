<?php


namespace common\redis_publish\base;


use common\services\system\log\LogService;
use yii\base\Exception;

abstract class PublishAbstract
{
    /**
     * 命名空间
     * @var
     */
    public $namespance;
    /**
     * 订阅消息通道名称
     * @var
     */
    public $channel = 'channel_name';
    /**
     * 初始化
     * PublishAbstract constructor.
     */
    abstract function __construct();

    /**
     * 订阅处理的事件
     * @param array $params
     * @return mixed
     */
    abstract public function handle($params = []);

    /**
     * 发布事件
     * @return mixed
     */
    public function publish($params = 'test')
    {
        $this->push($params);
    }

    /**
     * 设置命名空间
     * @param mixed $namespance
     */
    public function setNamespance($namespance)
    {
        $this->namespace = $namespance;
    }

    /**
     * 发送到redis
     * @param $params
     */
    public function push($params = 'test')
    {

        if (!is_array($params) && !is_string($params)) {
            LogService::warning('添加队列错误，参数' . serialize($params));
            throw new Exception('参数错误，要么数组要么，字符串');
        }
        $data = [
            'namespace' => $this->namespace,
            'params' => $params,
            'id' => time() . rand(0, 999999999),
        ];
        //文件锁，监听订阅是否存在
        $file = fopen(\Yii::getAlias('@data') . '/other/system/lock/' . $this->channel . '_lock.txt', 'r');
        if (flock($file, LOCK_EX | LOCK_NB)) {
            //订阅失败，直接执行程序,影响程序效率，发短信通知管理员开启订阅
            LogService::warning($this->channel . '订阅程序进程已经停止，请重新开启');
            return $this->handle($params);
        } else {
            //发布
            $this->addRedisHash($data);
            $data = json_encode($data);
            $redis = RedisClient::init();
            return $redis->publish($this->channel, $data);
        }
    }

    /**
     * 添加哈希队列，在订阅中删除哈希
     * @param $params
     */
    private function addRedisHash($params)
    {
        $redis = RedisClient::init();
        $data = json_encode($params);
        $redis->hSet($this->channel, $params['id'], $data);
    }

}
