<?php

namespace container\functions\tool;

use container\core\BaseClient;
use Inhere\Console\IO\Input;
use Inhere\Console\IO\Output;

class Console extends BaseClient
{
    /**
     * @var \Inhere\Console\Application $console
     */
    public $command;

    public function init()
    {
        $meta = [
            'name' => 'console',
            'version' => '1.0.0',
        ];

        $input = new Input;
        $output = new Output;
// 通常无需传入 $input $output ，会自动创建
        $this->command = new \Inhere\Console\Application($meta, $input, $output);
    }

    public function run()
    {
        $this->command->run();
    }



}
