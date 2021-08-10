<?php
namespace container\middlewares;

use container\Application;
use container\core\ContainerBase;
use container\interfaces\Middlewares;

class configHandler implements Middlewares
{

    public function handle(Application $app)
    {
        echo "Connecting to database...".PHP_EOL;

    }


}
