eie
===================
配置信息

|  文件   | 说明  |
|  ----  | ----  |
| `config/database.php`  | 数据库配置信息 |

数据库生成规则

* rule[required]
* 枚举 类型(a_cat:小程序分类,web:网页,other:其他)

|  名称   | 说明  ||
|  ----  | ----  |----|
|  | 枚举 ||
| chsAlphaNum  | 中文 |[laravel 跳转]() tp自带|
| rule[require|chsAlphaNum]  | thinkphp验证 ||
| hidden  | 不需要显示给前端用户 ||


文档

* laravel swagger 生成文档 https://github.com/DarkaOnLine/L5-Swagger  访问：/api/documentation

* thinkphp apidoc https://hgthecode.github.io/thinkphp-apidoc

待研究 formbuilder 生成表单

Laravel笔记

|     | 使用|
|  ----  | ---- |
| barryvdh/laravel-ide-helper | php artisan ide-helper:generate |
| darkaonline/l5-swagger  |php artisan vendor:publish --provider L5Swagger\L5SwaggerServiceProvider    php artisan l5-swagger:generate|
| liaosp/laravel-validate-ext  |  |
| laravel/telescope  |  php artisan telescope:install      php artisan migrate|


auto_build_time 是否自动生成 create_at 和deleted_at


# php中

$this->getRelation() 获取所有配置的关联信息 就是table 的 relations 里的信息

$this->getCurrentSetting()  获取当前表的设置，想 request_method 的方法



