<?php
namespace App\Services\AliOpen\interfaces;

use App\Services\AliOpen\core\Container;

interface Provider
{
    public function serviceProvider(Container $container);
}
