<?php

namespace functions;
use core\BaseClient;

class Db extends BaseClient
{

    public function connection(){
        $this->app->sale->lists();
        echo 'hello im db class';
    }
    public function test(){
        echo '我是中间件调用的方法222';
    }
}
