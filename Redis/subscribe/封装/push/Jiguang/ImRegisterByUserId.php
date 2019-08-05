<?php


namespace common\redis_publish\Jiguang;


use common\redis_publish\base\PublishAbstract;
use common\services\EventService;
use common\services\im\UserImService;

class ImRegisterByUserId extends PublishAbstract
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
     * 订阅处理的事件
     * @param array $params
     * @return mixed
     */
    public function handle($params = [])
    {
       $user_id = $params['user_id'];
        UserImService::getInstance(EventService::CLIENT_TYPE_BUYER)->checkExistByUserName($user_id);
    }
}
