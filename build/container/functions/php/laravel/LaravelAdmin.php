<?php


namespace container\functions\php\laravel;


use container\Application;
use Inhere\Console\Util\Show;


trait LaravelAdmin
{

    private $AdminTemplate;

    private $ControllerPath;

    private $filterTemplate;
    /**
     * 生成laravel控制器
     */
    public function buildLaravelAdminController(){
        //检查admin 控制器是否存在
        /**
         * @var Application $app
         */
        $app = $this->app;

        if (!$this->checkPath()){
            return false;
        }

        $this->AdminTemplate = file_get_contents(APP_PATH . "/studs/" . $this->app->frame . '/admin_controller');

        //基础
        $this->AdminTemplate = str_replace('{{name}}',$this->getThisTags(),$this->AdminTemplate);

        $this->AdminTemplate = str_replace('{{ClassName}}',$app->className,$this->AdminTemplate);

        //列表
        $column = $this->column();
        $this->AdminTemplate = str_replace('{{column}}',$column,$this->AdminTemplate);
        //详情
        $field = $this->field();
        $this->AdminTemplate = str_replace('{{field}}',$field,$this->AdminTemplate);

        //表单编辑
        $form = $this->form();
        $this->AdminTemplate = str_replace('{{form}}',$form,$this->AdminTemplate);



        //保存位置
        file_put_contents($this->ControllerPath,$this->AdminTemplate);

        Show::block('成功保存：'.$this->ControllerPath);

        //生成路由
        $frame_path = config('frame_path');
        $route = $frame_path.'app/Admin/routes.php';
        $routesFile = file_get_contents($route);

        $controllerName = $app->className.'Controller';
        $remark = '//@router请勿修改和删除这个';
        $name = '$router->resource("'.$app->className.'", '.$controllerName.'::class);';
        $res_name = $name.PHP_EOL;
        $res_name =$res_name.$remark;
        do{
            if (strstr($routesFile,$name)){
                break;
            }
            if (!strstr($routesFile,$remark)){
                Show::block('请在routes.php添加'.$remark);
                return false;
            }
        }while(false);

        //数据库添加 菜单名称
        $routesFile = str_replace($remark,$res_name,$routesFile);

        file_put_contents($route,$routesFile);

        //添加菜单成功
        Show::block('路由配置成功'.$route);

        //数据库添加菜单路径


    }

    /**
     * 检查路径
     * @return bool
     */
    private function checkPath(){
        /**
         * @var Application $app
         */

        $app = $this->app;
        //model name
        $ControllerName  = $app->className.'Controller';
        $frame_path = config('frame_path');
        $Controller = $frame_path.'app/Admin/Controllers/'.$ControllerName.'.php';
        $exsit = is_file($Controller);
        $this->ControllerPath= $Controller;

        if (is_file($this->ControllerPath) && $this->getCurrentSetting('no_cover_admin')){
            Show::block('错误已经设置不可以强制覆盖：'.$this->ControllerPath,'error','error');
            return false;
        }


        return true;
    }

    /**
     * 列表
     */
    private  function column(){
        $list = '';
        /**
         * @var Application $app
         */
        $app = $this->app;

        //过滤信息

        $template = '';
        $filter = '';
        foreach ($app->struct->struct as $item) {

            if (strstr($item['name'],'name')){
                $filter.= '       $filter->like("'.$item['name'].'", "'.$item["comment"].'");'.PHP_EOL;
                continue;
            }
            //枚举筛选
            if (!empty($item['enum'])){
                $enumsClass = $app->className.'::'.$item['name'];
                $filter.= '       $filter->in("'.$item["name"].'","'.$item['comment'].'")->checkbox('.$enumsClass.');'.PHP_EOL;
            }
            //时间筛选
            if ($item['name'] == 'created_at'){
                $filter.='     $filter->between("created_at", "创建时间")->datetime();';

            }


        }
        if ($filter){
            $template = '$grid->filter(function($filter){
    {{filter}}
});';
            $template= str_replace('{{filter}}',$filter,$template);

        }
        $this->AdminTemplate = str_replace("{{filter}}",$template,$this->AdminTemplate);

        $orderBy = '';

        $orderBy = '$grid->model()->orderBy(\'created_at\',\'desc\');';
        //默认倒叙
        $this->AdminTemplate = str_replace("{{orderBy}}",$orderBy,$this->AdminTemplate);

        //操作
        $action = ' $grid->actions(function ($actions) {

    // 去掉删除
    $actions->disableDelete();

    // 去掉编辑
    //$actions->disableEdit();

    // 去掉查看
    //$actions->disableView();
});';

        $this->AdminTemplate = str_replace("{{action}}",$action,$this->AdminTemplate);
        foreach ($app->struct->struct as $item) {

            if (in_array($item['name'],['updated_at','deleted_at'])) continue;

            $enum = !empty($this->enums[$item['name']])?$this->enums[$item['name']]:'';
          if ($enum){
              $list.='       $grid->column("'.$item['name'].'", __("'.$enum['key_note'].'"))->using('.$app->className.'::'.$item['name'].');'.PHP_EOL;
          }else{
              $list.='       $grid->column("'.$item['name'].'", __("'.$item['comment'].'"));'.PHP_EOL;
          }

        }
        return $list;
    }


    /**
     * 详情
     */
    private  function field(){
        $list = '';
        /**
         * @var Application $app
         */
        $app = $this->app;
        $lng= false;
        foreach ($app->struct->struct as $item) {
//            ["name"]=>
//  string(2) "id"
//            ["type"]=>
//  string(6) "bigint"
//            ["comment"]=>
//  string(0) ""
//            ["default"]=>
//  NULL
            //经纬度
            if ($item['name'] =='lng' || $item['name']== 'lat'){
                if ($lng == false){
                    $list.= '       $show->field("经纬度")->latlong("lat", "lng", $height = 400, $zoom = 16);'.PHP_EOL;
                }
                $lng = true;
                continue;
            }

            $enum = !empty($this->enums[$item['name']])?$this->enums[$item['name']]:'';
            if ($enum){
                $list.='       $show->'.$item['name'].'("'.$enum['key_note'].'")->using('.$app->className.'::'.$item['name'].');'.PHP_EOL;
            }else{
                $list.='       $show->field("'.$item['name'].'", __("'.$item['comment'].'"));'.PHP_EOL;
            }
        }
        return $list;
    }

    /**
     * 编辑
     */
    private  function form(){
        /**
         * @var Application $app
         */
        $app = $this->app;
        $list = '';
        /**
         * @var Application $app
         */
        $app = $this->app;
        $lng= false;


        //右上角的操作按钮
        $tools = '$form->tools(function (Form\Tools $tools) {

    // 去掉`列表`按钮
    //$tools->disableList();

    // 去掉`删除`按钮
    $tools->disableDelete();

    // 去掉`查看`按钮
   // $tools->disableView();

    // 添加一个按钮, 参数可以是字符串, 或者实现了Renderable或Htmlable接口的对象实例
   // $tools->add(\'<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>\');
});';
        $this->AdminTemplate = str_replace('{{tools}}',$tools,$this->AdminTemplate);



        foreach ($app->struct->struct as $item) {



            if (in_array($item['name'],config('exclude_fillable'))) continue;
            if ($item['name'] =='lng' || $item['name']== 'lat'){
                if ($lng == false){
                    $list.='       $form->latlong("lat", "lng", "经纬度")->default(["lat" =>23.129102812719083, "lng" =>113.26416495256126]);'.PHP_EOL;
                }
                $lng = true;
                continue;
            }
            $default_str ='';
            if (!empty($item['default'])){
                $default_str = '->default("'.$item['default'].'")';
            }

            //帮助
            $help_str = !empty($item['help'])?$item['help']:'';
            if ($help_str){
                $help_str = '->help("'.$item['help'].'")';
            }

            if ($item['name'] == $app->table->pk){
                $list.='       $form->text("'.$item['name'].'", __("'.$item['comment'].'"))->disable()'.$default_str.$help_str.';'.PHP_EOL;
                continue;
            }

            //如果用到userid
            if ($item['name'] == 'user_id'  && config('user_id_translate_the_name')){
                $list.='       $form->text("'.config('user_id_translate_the_name').'", __("用户"))->disable()'.$default_str.$help_str.';'.PHP_EOL;
                continue;
            }


            $enum = !empty($this->enums[$item['name']])?$this->enums[$item['name']]:'';
            if ($enum){
                $list.='       $form->select("'.$item['name'].'", __("'.$enum['key_note'].'"))->options('.$app->className.'::'.$item['name'].')'.$default_str.$help_str.';'.PHP_EOL;
            }else{

                if ($item['type']== 'int'){
                    $list.='       $form->number("'.$item['name'].'", __("'.$item['comment'].'"))'.$default_str.$help_str.';'.PHP_EOL;
                }else{
                    $list.='       $form->text("'.$item['name'].'", __("'.$item['comment'].'"))'.$default_str.$help_str.';'.PHP_EOL;

                }
            }

            //处理枚举


        }
        return $list;
    }

}
