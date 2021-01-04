<?php
$json = <<<Json
[
												{
													"key": "title",
													"value": "槈李厚霖地脸李厚",
													"description": "发票标题",
													"type": "text"
												},
												{
													"key": "sub_title",
													"value": "",
													"description": "副标题",
													"type": "text"
												},
												{
													"key": "description",
													"value": "",
													"description": "描述",
													"type": "text"
												},
												{
													"key": "instructions",
													"value": "",
													"description": "使用说明",
													"type": "text"
												},
												{
													"key": "face_value",
													"value": "100",
													"description": "面值",
													"type": "text"
												},
												{
													"key": "issue_num",
													"value": "1000",
													"description": "发放总量",
													"type": "text"
												},
												{
													"key": "validity_begin_time",
													"value": "1011222222",
													"description": "有效期开始时间",
													"type": "text"
												},
												{
													"key": "validity_end_time",
													"value": "20122222222",
													"description": "有效期结束时间",
													"type": "text"
												},
												{
													"key": "get_user_type",
													"value": "named_member",
													"description": "用户领取类型",
													"type": "text"
												},
												{
													"key": "get_user_set",
													"value": "22,,,22222",
													"description": "领取用户集合",
													"type": "text"
												},
												{
													"key": "get_num_limit",
													"value": "5",
													"description": "可领数量",
													"type": "text"
												},
												{
													"key": "goods_available_type",
													"value": "part",
													"description": "商品可用类型",
													"type": "text"
												},
												{
													"key": "spec_available_set",
													"value": "188,191",
													"description": "可用商品集合",
													"type": "text"
												},
												{
													"key": "tip_expire_day",
													"value": "4",
													"description": "过期提醒天数",
													"type": "text"
												},
												{
													"key": "threshold_using_switch",
													"value": "1",
													"description": "使用门槛开关",
													"type": "text"
												},
												{
													"key": "threshold_amount",
													"value": "1",
													"description": "门槛金额",
													"type": "text"
												},
												{
													"key": "active_both_switch",
													"value": "1",
													"description": "原价购买可用开关",
													"type": "text"
												}
											]
Json;

$datas =json_decode($json,true);

foreach ($datas as $data){
    echo '|'.$data['key'].'|'.$data['value'].'|'.$data['description'].'|'.PHP_EOL;
}


