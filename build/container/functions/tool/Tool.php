<?php


namespace container\functions\tool;


use container\core\BaseClient;

class Tool extends BaseClient
{
    // 将下划线删除，首字母大写
    public function struct($str)
    {
        $str = ucwords(str_replace('_', ' ', $str));
        $str = str_replace(' ', '', ucfirst($str));
        return $str;
    }
}
