<?php


namespace common\redis_publish\Jiguang;


use common\redis_publish\base\PublishAbstract;
use common\services\im\UserImService;
use yii\base\Exception;

/**
 * 用户编辑信息，异步操作
 * Class ImEdit
 * @package common\redis_publish\Jiguang
 */
class ImEdit extends PublishAbstract
{

    /**
     * 初始化
     * PublishAbstract constructor.
     */
    public function __construct()
    {
        $this->setNamespance(__CLASS__);
    }

    /**
     * 订阅处理的事件  subscribe`
     * @param array $params
     * @return mixed
     */
    public function handle($params = [])
    {
        //更新极光信息
        $res =UserImService::getInstance($params['clinet'])->checkExistByUserName($params['user_id']);
        if(empty($res['http_code'])){
            throw new Exception(json_encode($res));
        }
        if(!in_array($res['http_code'],['201','204','200','202','203']) ){
            throw new Exception(json_encode($res));
        }

    }

}
