<?php
require_once ("../vendor/autoload.php");
$config = require(__DIR__."/config.php");
use Hanson\Vbot\Foundation\Vbot;

//$data = file_get_contents('https://www.apiopen.top/satinApi?type=2&page=0');
//$data = $data['data'][0]['text'];

$curl = new \GuzzleHttp\Client();
$json = '{
	"reqType":0,
    "perception": {
        "inputText": {
            "text": "厦门天气"
        },
 

    },
    "userInfo": {
        "apiKey": "8899f6c11e974fc192e7f94afecb8c85",
        "userId": "492097"
    }
}';
$data =$curl->post('http://openapi.tuling123.com/openapi/api/v2',array(
    'content-type' => 'application/json',

));
$res =$data->getBody();
echo $res;exit;

exit;
$vbot = new Vbot($config);

$vbot->messageHandler->setHandler(function(\Illuminate\Support\Collection $message){
     echo json_encode($message);
//    \Hanson\Vbot\Message\Text::send($message['from']['UserName'], 'hi');
});

$vbot->server->serve();
