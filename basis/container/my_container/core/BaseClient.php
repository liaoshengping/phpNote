<?php


namespace core;

use functions\Sale;

/**
 * Class BaseClient
 * @package core
 * @property \Application app
 */
class BaseClient
{
    protected $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

}
