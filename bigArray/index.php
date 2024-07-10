<?php
/**
 * Created by PhpStorm.
 * Date: 2019/7/1
 * Time: 22:32
 */
class BigArray{
    /**
     * 渠道
     * @var
     */
    private $channel;
    /**
     * 返回值
     * @var array
     */
    private $respose =[];

    /**
     * @param array $array
     * @param array $only_channel
     * @param array $outside_chanel
     * @return array
     */
    public function addArray($array=[], $only_channel=[], $outside_chanel=[]){
        if(empty($array)){
            return $this->respose;
        }
        if(!empty($only_channel)){
            $o = 0;
            foreach ($only_channel as $key=>$value){
                if($value ==$this->channel){
                    $o++;
                }
            }
            if($o ==0){
                return $this->respose;
            }
        }
        if(!empty($outside_chanel)){
            foreach ($outside_chanel as $key=>$value){
                if($value ==$this->channel){
                    return $this->respose;
                }
            }
        }


    }

}