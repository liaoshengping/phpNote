<?php


namespace Cblink\MeituanDispatch;


class Test
{
    public function index()
    {
        //依赖：composer require hanson/foundation-sdk -vvv
        //参考：https://learnku.com/articles/14995/dried-food-hand-in-hand-to-teach-you-to-write-sdk
        $dispatch = new Dispatch($config = []);
        $dispatch = $dispatch->createByShop($param = []);
    }
}
