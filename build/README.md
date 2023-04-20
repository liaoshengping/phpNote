eie
===================
配置信息

## 大配置 ：
"data_list_filter_time" => 'created_at', 列表接口是否有时间筛选


|  文件   | 说明  |
|  ----  | ----  |
| `config/database.php`  | 数据库配置信息 |

数据库生成规则

* rule[required] //laravel 判空
* rule[required|unique|min:1|max:50] // 规则 如最小长度 最大长度 唯一
* 枚举 类型(a_cat:小程序分类,web:网页,other:其他) // 枚举eg  status tinyint [default: 1, note: '状态(1:启用,2:禁用)']
* 如果表中的status包含delete 字眼，删除则是修改状态，同样在列表中也排除delete的的状态数据
* help[这里是帮助文档] laravel-admin 后台字段帮助
* msg[注释]  // msg[商品名称]
* 
* fieldHide // 字段不显示
* fieldDisable // 字段禁止编辑
* editDisable // 编辑不可操作，新增可以
* notDelete // 表不能删除
* notEdit // 表不能编辑
* formHide 表单隐藏
* search // 搜索字段
* 
* belongsTo[表名] // belongsTo[shop_type] 一对一
* hasOne[表名] // hasOne[order] 一对一
* hasMany[表名1,表名2] // hasMany[goods_sku,goods_put_info] 一对多关联
* relationField[表名.字段名] //  relationField[merchant.name] hasOne或hasMany 关联表字段ID，列表需要展示关联表字段名称




|  名称   | 说明  ||
|  ----  | ----  |----|
|  | 枚举 ||
| chsAlphaNum  | 中文 |[laravel 跳转]() tp自带|
| rule[require|chsAlphaNum|mobile]  | thinkphp验证 || 
| hidden  | 不需要显示给前端用户 ||


required laravel 验证

    

文档

* laravel swagger 生成文档 https://github.com/DarkaOnLine/L5-Swagger  访问：/api/documentation

* thinkphp apidoc https://hgthecode.github.io/thinkphp-apidoc

待研究 formbuilder 生成表单

Laravel笔记

|     | 使用|
|  ----  | ---- |
| barryvdh/laravel-ide-helper | php artisan ide-helper:generate  https://learnku.com/articles/10172/laravel-super-good-code-prompt-tool-laravel-ide-helper|
| darkaonline/l5-swagger  |php artisan vendor:publish --provider L5Swagger\L5SwaggerServiceProvider    php artisan l5-swagger:generate|
| liaosp/laravel-validate-ext  |  |
| laravel/telescope  |  php artisan telescope:install      php artisan migrate|


auto_build_time 是否自动生成 create_at 和deleted_at


# php中

$this->getRelation() 获取所有配置的关联信息 就是table 的 relations 里的信息

$this->getCurrentSetting()  获取当前表的设置，想 request_method 的方法


# 关联模型使用说明

//例子

```
        'goods_attr' => [
            'name' => '商品属性管理',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
            'is_auth'=>true,//只可以获取自己的信息，结合auth_user_id 使用

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            'controller_actions' => ['create','list','show','delete'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'relations' => [
//                [
//                    'relation' => "hasMany",
//                    'tables' => [
//                        [
//                            'table_name' => 'order_goods',
//                            'target' => 'order_id', //目标表中的字段
//                            'origin' => 'id',//本表的字段
//                            'limit' => 30,//查询为10条
//                            'list_show' => true,
//                            'list_exist' => false,
//                            'one_show' => true,
//                            'create_relation' => false,//创建时，是否可以关联添加
//                        ]
//                    ],
//                ],
                [
                    'relation' => "hasOne",
                    'tables' => [
                        [
                            'table_name' => 'goods_attr',
                            'target' => 'goods_attr_id', //目标表中的字段
                            'origin' => 'goods_attr_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'goods_unit',
                            'target' => 'goods_unit_id', //目标表中的字段
                            'origin' => 'goods_unit_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                    ],

                ]
            ]
        ]
```

### 表的相关配置：

| 关键词 | 说明 | 备注 |
| -----| ---- | ---- |
| name | 用于接口或后台名字 | 比如：订单管理 |
| request_method | 请求的方式多用于swagger 中的请求方法 |  |
| fields | 表中的字段 | 可以为空 |
| input | 可输入的字段 | 可以为空 |
| create_input | 创建需要的字段如果为空取上面的 | 可以为空 |
| edit_input | 编辑需要的字段如果为空取上面的 | 可以为空 |
| list_input | 列表页面可筛选的字段 | 可以为空 |
| is_auth | 是否需要用Auth 中的userid  | 根据场景不一样有可能是store_id 查询的时候用的 |
| is_auth_store | 在config 配置auth_store_id |是否需要查询store_id  |
| status_delete | 指定状态删除 |列表不显示这条数据 |
| change_status | 修改状态的接口 |接口 |
| delete_check | 删除时候去检查 | 检查是否可删除 |
| create_other_params | 新增数据时候的其他参数 |接口 |
| relation_save | 关联保存 | liaosp/laravel-relation-save 安装这个库，否则报错 |
| list_keyword_search | 列表关键字搜索 | 列表关键字搜索 |
| time_between_field | 替换created_at | 区间查询 whereBetween 的字段 比如order_at|
| list_other_params | 列表的其他参数  | |
| disable_soft_delete | 关闭软删除  | |
| list_created_at_add_time | 列表时间筛选结束时间end_at是否加1天 默认day | |
| 'no_swagger_actions' => ['create'], | 不生成控制器swagger文档| |
| query_join| bool 列表展示是否为join展示| |



* 列表添加参数
``` 
'list_other_params' => [
    [
        'key' => 'scene',
        'des' => '使用场景,采购：传no_period,开单:order',//描述
        'required' => 'false',//是否必须
    ]

],
```


* 检查是否被使用
```
"delete_check" => [
    [
        'table' => 'goods',
        'model' => '\App\Models\Goods',
        'key' => 'dict_id'
    ],
    [
        'table' => 'store_contacts',
        'model' => '\App\Models\StoreContacts',
        'key' => 'dict_id'
    ],
],
```

* 关键字搜索
````
'list_keyword_search' =>[
    [
        'key'=>'name',
        'op'=> 'like',
    ],
    [
        'key'=>'',
        'op'=>'',
    ]
],
````


* 新增数据时候的其他参数
````
'create_other_params'=>[
    [
        'key'=>'initial_stock_quantity',
        'des'=>'初始库存数量',//描述
        'required'=>'false',//是否必须
    ],

], //创建时额外的参数，用于swagger 生成
````

* 修改状态的接口 例子
````
   "change_status" => [
    'key'=>'status',
    ],

````

* 状态删除例子
```
            'status_delete'=>[
                'key'=>'status',
                'value'=>'delete',
            ],
```

### 关联中的说明

| 关键词 | 说明 | 备注 |
| -----| ---- | ---- |
| table_name | 关联表名 |  |
| target | 目标表中的关联的字段 |  |
| origin | 本表关联的字段 |  |
| list_show | 列表展示的时候是否展示 | bool |
| list_exist | 是否展示列表是否存在 | 用于laravel 中的 withHas |
| one_show | 详情接口是否展示 | bool |
| create_relation | 创建时候是否关联可添加 | bool |


## 代码方法

- 获取所有数据库表信息 $this->table->getAllTables()


