<?php

/**
 * array_merge巧用数组默认值
 * Class demo
 */
class demo
{

    public function createMenu(array &$config)
    {
        $config = array_filter($config);
        $config = array_merge([//默认值
            'title' => 'Foo',
            'body' => 'body',
            'buttonText' => 'Baz',
            'cancellable' => true,
        ], $config);
    }
}
//实例
$menuConfig = [
    'title' => '我是标题',
    // User did not include 'body' key
    'body' => null,
    'buttonText' => 'Send',
    'cancellable' => true,
];
$obj = new demo();
$obj->createMenu($menuConfig);

var_dump($menuConfig);
