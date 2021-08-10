<?php

include_once ("Loder.php");

$app = new \container\Application([
    'argv'=>$argv
]);

$data =$app->db->table("bqb_item")->get();

var_dump(count($data));



