<?php


class Qiniu
{
    protected $key;
    protected $secret;
    protected $buff;
    public function __construct($key,$secret,$buff)
    {
        $this->key= $key;
        $this->secret= $secret;
        $this->buff = $buff;
        return $this;
    }
    public static function create()
    {
        return new self(...func_get_args());
    }
    public function upload($path){
       echo "用 key:".$this->key.'上传文件'.$path;
    }
}
