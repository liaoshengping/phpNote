<?php


namespace common\redis_publish;


use common\redis_publish\base\PublishAbstract;
use yii\base\Exception;

class Demo extends PublishAbstract
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
//        sleep(1);

        print_r($params);
       echo '处理demo22334444';
    }
}
