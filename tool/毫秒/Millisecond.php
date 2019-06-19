<?php
class Time{
    private function getMillisecond() {
        list($s1, $s2) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
    }
    public function index(){
        $t1 = $this->getMillisecond();
        echo $t1.PHP_EOL;
        file_get_contents('http://baidu.com');
        $t2 = $this->getMillisecond();
        echo $t2.PHP_EOL;
        echo "花费".($t2-$t1).'ms';
    }
}

$obj = new Time();
$obj->index();
