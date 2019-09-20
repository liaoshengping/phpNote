<?php


namespace functions;


use core\BaseClient;

class Curl extends BaseClient
{
//    public function
    /**
     * @throws \Exception
     */
    public function request()
    {
        //处理中间件
        foreach ($this->app->getMiddlewares() as $middleware) {
            if (empty($middleware[0])) {
                throw new \Exception('中间件缺少类');
            }
            if (empty($middleware[1])) {
                throw new \Exception('缺少中间件方法');
            }
            if (!class_exists($middleware[0])) {
                throw new \Exception('中间件第一参数必须是类，本类使用this' . $middleware[0]);
            }
            $obj = new $middleware[0]($this->app);
            $function = $middleware[1];
            $obj->$function();
        }
        echo '请求成功';
    }


}
