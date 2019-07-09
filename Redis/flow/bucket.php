<?php
class Funnel {

    private $capacity;
    private $leakingRate;
    private $leftQuote;
    private $leakingTs;

    public function __construct($capacity, $leakingRate)
    {
        $this->capacity = $capacity;    //漏斗容量
        $this->leakingRate = $leakingRate;//漏斗流水速率
        $this->leftQuote = $capacity; //漏斗剩余空间
        $this->leakingTs = time(); //上一次漏水时间
    }

    public function makeSpace()
    {
        $now = time();
        $deltaTs = $now-$this->leakingTs; //距离上一次漏水过去了多久
        $deltaQuota = $deltaTs * $this->leakingRate; //可腾出的空间
        if($deltaQuota < 1) {
            return;
        }
        $this->leftQuote += $deltaQuota;   //增加剩余空间
        $this->leakingTs = time();         //记录漏水时间
        if($this->leftQuota > $this->capacaty){
            $this->leftQuote - $this->capacity;
        }
    }

    public function watering($quota)
    {
        $this->makeSpace(); //漏水操作
        if($this->leftQuote >= $quota) {
            $this->leftQuote -= $quota;
            return true;
        }
        return false;
    }
}


$funnels = [];
global $funnel;

function isActionAllowed($userId, $action, $capacity, $leakingRate)
{
    $key = sprintf("%s:%s", $userId, $action);
    $funnel = $GLOBALS['funnel'][$key] ?? '';
    if (!$funnel) {
        $funnel  = new Funnel($capacity, $leakingRate);
        $GLOBALS['funnel'][$key] = $funnel;
    }
    return $funnel->watering(1);
}

for ($i=0; $i<16; $i++){
    var_dump(isActionAllowed("110", "reply", 15, 0.5)); //执行可以发现只有前15次是通过的
}
