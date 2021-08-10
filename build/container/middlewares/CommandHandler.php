<?php


namespace container\middlewares;


use container\Application;
use container\interfaces\Middlewares;

class CommandHandler implements Middlewares
{

    public function handle(Application $app)
    {
        $argv = $app->params['argv'];
        $error = '';
        if (count($argv) < 2) {
            $error = <<<TXT
 Wrong instruction, this is help:
[php build table_name] is build database structure;
[php build table_name] is build database structure;

TXT;
        }

        echo $error;
    }
}