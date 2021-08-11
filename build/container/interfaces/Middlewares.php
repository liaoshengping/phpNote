<?php


namespace container\interfaces;


use container\Application;
use container\core\ContainerBase;

interface Middlewares
{
    /**
     * @return mixed
     */
    public function handle(Application $app);
}
