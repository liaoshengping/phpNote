<?php
//函数功能单一性参考：https://www.cnblogs.com/liaosp/p/11459648.html
class demo1
{
    public function index()
    {
        $a = array("a" => "red", "b" => "green", "c" => "blue");

        array_walk($a, array(new demo2(), 'myfunction'), ['username'=>'liaosp']);

        var_dump($a);
    }
}

class demo2
{
    /**
     * @param $value
     * @param $key
     * @param array $userdata
     * @var  $username
     */
    public function myfunction(&$value, $key, array $userdata)
    {
        $username ='';//来源userdata 数组
        extract($userdata);
        $value = $username;
    }
}

//so good !!! demo3

class demo3{
    public function emailClients(array $clients) {

        $activeClients = $this->activeClients($clients);//过滤不要触发email

        array_walk($activeClients, array($this,'email'));
    }

    function activeClients(array $clients) {
        return array_filter($clients, array($this,'isClientActive'));
    }

    public function isClientActive(array $client) {
        $status = 0;//extract 赋值
        extract($client);
        if($status ==0){
            return false;
        }
        return true;
    }
    public function email($value){
        var_dump($value);
    }

}

//$obj = new demo1();
//$obj->index();

//$obj = new demo3();
//$client = [
//    ['username'=>'liaosp','status'=>1,'email'=>'liaosp@qq.com'],
//    ['username'=>'mm','status'=>1,'email'=>'mm@qq.com'],
//];
//$obj->emailClients($client);

function demo4(){
    $arr = [1,2,3];
    $function = function(&$value,$key){
        $value++;
    };
    array_walk($arr,$function);
    var_dump($arr);
}
demo4();
