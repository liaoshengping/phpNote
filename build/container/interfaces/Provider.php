<?php
namespace container\interfaces;

use container\core\Container;

interface Provider
{
    public function serviceProvider(Container $container);
}
