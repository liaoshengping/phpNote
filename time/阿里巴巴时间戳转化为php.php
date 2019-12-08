<?php
/**
 * Created by PhpStorm.
 * User: liaosp
 * Date: 2019/12/8
 * Time: 17:06
 */

/**
 * 20191207170144000+0800
 * @param $time
 */
 function aliTimeToPHPTime($time){
    $year = substr($time,0,4);
    $month = substr($time,4,2);
    $day = substr($time,6,2);
    $H =substr($time,8,2);
    $I = substr($time,10,2);
    $S = substr($time,12,2);
    $timeString = $year.'-'.$month.'-'.$day.' '.$H.':'.$I.':'.$S;
    return $timeString;
}
