<?php

include ("../vendor/autoload.php");
include ('curl.helper.php');

//$url = 'https://mdskip.taobao.com/core/initItemDetail.htm?&itemId=601365680643';
//$url = 'https://mdskip.taobao.com/core/initItemDetail.htm?itemId=563740702710&callback';
//$url = 'https://extmdskip.tmall.com/core/initItemDetail.htm?isUseInventoryCenter=true&cartEnable=true&service3C=false&isApparel=false&isSecKill=false&tmallBuySupport=true&isAreaSell=true&tryBeforeBuy=false&offlineShop=false&itemId=601365680643&showShopProm=false&isPurchaseMallPage=false&itemGmtModified=1677202132000&isRegionLevel=true&household=false&sellerPreview=false&queryMemberRight=true&addressLevel=3&isForbidBuyItem=false&callback=onMdskip&ref=https%253A%252F%252Fwww.tmall.com%252F&brandSiteId=0&isg=fBNAtuZcLI1Vc3gYBOfwPurza77OjIRfguPzaNbMi9fPOV1e5SiAW689CbLwCnGVEsAXJ3PZC7jvBRLLCy4EQxv9-eGHQpjIDdTno34ey&isg2=BBcXMwN_OJaU6b3fCgnmqIrdpothXOu-8mNbvWlEPOZNmDbacCzcD-r5-jiGcMM2';

$num_iid = '601365680643';
$refer = 'http://detail.tmall.com/item.htm?id=' . $num_iid;
$url   = 'http://mdskip.taobao.com/core/initItemDetail.htm?queryMaybach=true&itemId=' . $num_iid;

$headers = ['referer' => $refer];

$client =new Curl();
$res = $client->get($url);


var_dump($res);



