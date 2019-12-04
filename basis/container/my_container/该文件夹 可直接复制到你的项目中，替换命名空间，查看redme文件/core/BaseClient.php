<?php


namespace App\Services\AliOpen\core;


/**
 * Class BaseClient
 * @package App\Services\AliOpen\core
 * @property \App\Services\AliOpen\Application app
 */
class BaseClient
{
    protected $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

}
