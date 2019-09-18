<?php
namespace interfaces;

use core\Container;

interface Provider
{
    public function serviceProvider(Container $container);
}
