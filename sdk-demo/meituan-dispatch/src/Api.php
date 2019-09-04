<?php


namespace Cblink\MeituanDispatch;


use Hanson\Foundation\AbstractAPI;

class Api extends AbstractAPI
{
    private $appKey;
    private $secret;
    const URL = 'http://test.com';

    /**
     * Api constructor.
     * @param string $appKey
     * @param string $secret
     */
    public function __construct(string $appKey, string $secret)
    {
        $this->appKey = $appKey;
        $this->secret = $secret;
    }

    public function signature(array $params)
    {
        ksort($params);
        return '签名后的参数';
    }

    public function request(string $method, array $params)
    {
        $params = array_merge($params, [
            'appkey' => $this->appKey,
        ]);
        $params['sign'] = $this->signature($params);
        $http = $this->getHttp();
        $response = $http->post(self::URL . $method, $params);
        return json_decode(strval($response->getBody()), true);
    }
}
