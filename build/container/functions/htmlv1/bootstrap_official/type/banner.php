<?php

namespace container\functions\htmlv1\bootstrap_official\type;

use Philo\Blade\Blade;

class banner
{
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function handle()
    {
        $banner = view('banner',$this->config);

        $banner = str_replace('{{banner_item}}', $banner, $banner);

        return $banner;

    }
}