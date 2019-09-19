<?php

namespace functions;
use core\BaseClient;

class Db extends BaseClient
{

    public function connection(){
        $this->app->sale->lists();
        echo 'hello im db class';
    }
}
