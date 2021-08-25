<?php


namespace container\core;


/**
 * Class BaseClient
 * @package container\core
 * @property \container\Application app
 */
class BaseClient
{

    protected $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

}
