
# 项目地址

[https://github.com/liaoshengping/phpNote/tree/master/basis/container/my_container](https://github.com/liaoshengping/phpNote/tree/master/basis/container/my_container)
下载在本地 执行 index.php
# 效果

```php
$app = new Application();
$app->db->test();
```




# 容器类

arrayAccess 赋予object 具有数组的功能

```php
<?php

class Container implements \ArrayAccess
{
    private $values = array();
    public $register;

    public function serviceRegister(Provider $provider)
    {
        $provider->serviceProvider($this);
        return $this;
    }

    public function offsetExists($offset)
    {
        // TODO: Implement offsetExists() method.
    }
	//可能多次调用，所以把类储存在instances 中，防止反复实例
    public function offsetGet($offset)
    {
        if(isset($this->instances[$offset])){
            return $this->instances[$offset];
        }
        $raw = $this->values[$offset];
        $val = $this->values[$offset] = $raw($this);
        $this->instances[$offset] = $val;
        return $val;
    }



    public function offsetSet($offset, $value)
    {
        $this->values[$offset] = $value;
    }

    public function offsetUnset($offset)
    {

    }
}

```



# 基础类

```php
class Base extends Container
{
    protected $provider = [];

    public function __construct()
    {
        $provider_callback = function ($provider) {
            $this->serviceRegister(new $provider);
        };
        array_walk($this->provider, $provider_callback);//注册
    }

    public function __get($id)
    {
        return $this->offsetGet($id);

    }
}
```
# 服务
注释让开发效率翻倍
```php
/**
 * Class Application
 * @property   Db db
 */
class Application extends Base
{
    protected $provider = [
        DbServiceProvider::class,
        //...其他服务
    ];

}
```

# 具体服务提供者

```php
class DbServiceProvider implements Provider
{
    /**
     * 服务提供者
     * @param Container $container
     * @return mixed
     */
    public function serviceProvider(Container $container,array $values = array())
    {

        $container['db'] = function () {
            return new DB();
        };


    }
}



```
# 接口

```php
interface Provider
{
    public function serviceProvider(Container $container);
}

```

# 实际功能类

```php
class DB
{
    public function test()
    {
        echo 'laji';
    }
}

```

具体以仓库代码为准：
[https://github.com/liaoshengping/phpNote/tree/master/basis/container/my_container](https://github.com/liaoshengping/phpNote/tree/master/basis/container/my_container)
