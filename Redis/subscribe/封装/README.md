## redis发布订阅操作说明
> 定时任务：重新执行失败的命令   yii redis/subscribe/error
> 开启监听  yii redis/subscribe
## 添加一个订阅发布（默认通道）
创建 common/redis_publish/Demo.php

发布：
```
$obj = new Demo();
$obj->publish(['name'=>'Mali']);
```
订阅处理
在 Demo.php ：
```
    public function handle($params = [])
    {
        $name = $params['name'];
        echo $name;// Mali
    }
```
如果想 失败之后稍后执行，可在handle方法中，直接抛出异常

定时任务如果操纵该订阅（error_num）超过设定的值，在system_redis_sub 这张表中改变状态为2



===========================================================================
### 新建通道
>同一个通道，如果添加数量较多，执行脚本较长的，可添加新的通道：
复制一份 SubscribeController.php

```php
    public $channel = '修改成你要的通道名称';
```
>同时在 /common/redis_publish
新建发布文件

```php
class Test extends PublishAbstract
{
    /**
     * 初始化
     * PublishAbstract constructor.
     */
    public function __construct()
    {
        $this->channel='修改成你要的通道名称'；
        $this->setNamespance(__CLASS__);
    }

    /**
     * 订阅处理的事件  subscribe`
     * @param array $params
     * @return mixed
     */
    public function handle($params = [])
    {
        //更新极光信息
        UserImService::getInstance($params['clinet'])->checkExistByUserName($params['user_id']);
    }

}
```
##### 使用
发布：
```
$obj = new Test();
$obj->publish('test');
```









