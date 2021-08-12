<?php

namespace container\functions\go\gin;

use container\functions\go\Common;

class Gin extends Common
{
    public function run(){
        echo "跑起来了";
        echo $this->app->table->table_name;

    }
}
