<?php
$data = simplexml_load_string('<body><name>李华</name><arr><age>12</age></arr></body>');
////
var_dump(json_decode(json_encode($data),true));