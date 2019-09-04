<?php


namespace Cblink\MeituanDispatch;


class Order extends Api
{
    public function createByShop(array $params){
        return $this->request('/order/createByShop',$params);
    }
}
