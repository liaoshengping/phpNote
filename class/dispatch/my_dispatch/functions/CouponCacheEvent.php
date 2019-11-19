<?php


namespace functions;


use Symfony\Component\EventDispatcher\Event;

class CouponCacheEvent extends Event
{
    const NAME = 'coupon.cache';

    protected $request;  // 在监听器里要操作的对象

    protected $response;  // 在监听器里要操作的对象

    public function __construct($request, $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

}
