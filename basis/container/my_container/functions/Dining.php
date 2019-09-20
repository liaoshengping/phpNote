<?php


namespace functions;


use core\BaseClient;

class Dining extends BaseClient
{
    public function bojiBan(){
        $spicy = $this->app->params['spicy'];
        echo "点一份簸箕板".$spicy;
    }

    public function BeijingKaoYa(){
        echo '点一份北京烤鸭';
    }
}
