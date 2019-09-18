<?php

namespace user;

class User implements \Pimple\ServiceProviderInterface
{

    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param \Pimple\Container $pimple A container instance
     */
    public function register(\Pimple\Container $pimple)
    {
       $pimple['user'] = function ($pimple){
            return new self();
       };
    }
    public function test(){
        echo 'hello world';
    }
}
