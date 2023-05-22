<?php


namespace container\functions\php\laravel;


use container\Application;
use container\functions\php\laravel\project\Cid;
use functions\Log;
use Inhere\Console\Util\Show;
use Predis\Pipeline\Pipeline;


trait DcatAdmin
{

    private $AdminTemplate;
    private $AdminEmptyTemplate;

    private $ControllerPath;
    private $ControllerEmptyPath;

    private $filterTemplate;

    /**
     * 生成laravel控制器
     */
    public function buildDcatAdminController()
    {
        //检查admin 控制器是否存在
        /**
         * @var Application $app
         */
        $app = $this->app;

        //生成路由
        $frame_path = config('frame_path');

        if (!$this->checkDcatPath()) {
            return false;
        }

        $this->AdminTemplate = file_get_contents(APP_PATH . "/studs/" . $this->app->frame . '/dcat/base_controller');

        //基础
        $this->AdminTemplate = str_replace('{{name}}', $this->getThisTags(), $this->AdminTemplate);

        $this->AdminTemplate = str_replace('{{ClassName}}', $app->className, $this->AdminTemplate);


        //生成子类
        $sunControllerClass = file_get_contents(APP_PATH . "/studs/" . $this->app->frame . '/dcat/sun_controller');
        $sunPath = $frame_path . 'app/Admin/Controllers/' . $app->className . 'Controller.php';
        $sunControllerClass = str_replace('{{class}}', $app->className, $sunControllerClass);

        if (is_file($sunPath)) {
            Show::warning('已经有了Dcat控制器模板了：' . $sunPath);
        } else {
            file_put_contents($sunPath, $sunControllerClass);
        }

        //列表
        $column = $this->dcatColumn();
        $columnRelation = $this->dcatColumnRelation();

        $this->AdminTemplate = str_replace('{{column}}', $column, $this->AdminTemplate);
        $this->AdminTemplate = str_replace('{{relation}}', $columnRelation, $this->AdminTemplate);
        //详情
        $field = $this->dcatField();
        $this->AdminTemplate = str_replace('{{field}}', $field, $this->AdminTemplate);

        //表单编辑
        $form = $this->dcatForm();
        $this->AdminTemplate = str_replace('{{form}}', $form, $this->AdminTemplate);


        //保存位置
        file_put_contents($this->ControllerPath, $this->AdminTemplate);

        Show::block('表单成功保存：' . $this->ControllerPath);


        $route = $frame_path . 'app/Admin/routes.php';
        $routesFile = file_get_contents($route);


        $controllerName = $app->className . 'Controller';
        $remark = '//@router请勿修改和删除这个';
        $name = '$router->resource("' . camel_case($app->className) . '", "' . $controllerName . '");';


        $res_name = $name . PHP_EOL;
        $res_name = $res_name . $remark;
        do {
            if (strstr($routesFile, $name)) {
                Show::warning('路由已存在' . $name);
                return false;
            }
            if (!strstr($routesFile, $remark)) {
                Show::error('请在routes.php添加' . $remark);
                return false;
            }

        } while (false);

        //数据库添加 菜单名称
        $routesFile = str_replace($remark, $res_name, $routesFile);

        file_put_contents($route, $routesFile);


        //数据库添加菜单路径
        $dir = APP_PATH . "/studs/" . $this->app->frame . '/dcat/migration';

        //读取模板
        $routeFile = file_get_contents($dir);

        $routeFile = str_replace('{{title}}', $this->getThisTags(), $routeFile);
        $routeFile = str_replace('{{uri}}', camel_case($app->table->table_name), $routeFile);

        $frameRoute = $frame_path . 'database/migrations/' . date('ymdhis') . rand(1000, 9999) . 'add_admin_menu_' . camel_case($app->table->table_name) . '.php';


        file_put_contents($frameRoute, $routeFile);

        //添加菜单成功
        Show::block('路由migrate配置成功' . $route);


    }

    /**
     * 检查路径
     * @return bool
     */
    public function checkDcatPath()
    {
        /**
         * @var Application $app
         */

        $app = $this->app;
        //model name
        $ControllerName = $app->className . 'Controller';
        $frame_path = config('frame_path');

        $dir = $frame_path . 'app/Admin/Controllers/base';
        //目录
        if (!is_dir($dir)) {
            mkdir($dir, 0777);
        }

       if (!is_file($dir.'/BaseAdminController.php')){
           file_put_contents($dir.'/BaseAdminController.php', file_get_contents(APP_PATH . "/studs/" . $this->app->frame . '/dcat/base_admin_controller'));
       }



        $Controller = $frame_path . 'app/Admin/Controllers/' . $ControllerName . '.php';
        $exsit = is_file($Controller);

        $this->ControllerEmptyPath = $Controller;
        $this->ControllerPath = $frame_path . 'app/Admin/Controllers/base/' . $app->className . 'BaseController' . '.php';


//        if (is_file($this->ControllerPath) && $this->getCurrentSetting('no_cover_admin')) {
//            Show::block('错误已经设置不可以强制覆盖2：' . $this->ControllerPath, 'error', 'error');
//            return false;
//        }


        return true;
    }

    /**
     * 列表
     */
    private function dcatColumn()
    {
        $list = '';
        /**
         * @var Application $app
         */
        $app = $this->app;

        //过滤信息

        $template = '';
        $filter = '';

        foreach ($app->struct->struct as $item) {

//            if ($item['name'] == 'platform_type'){
//                var_dump($item);exit;
//            }

            if (strstr($item['origin_comment'],'fieldHide')) continue;
            if (strstr($item['origin_comment'],'listHide')) continue;

            if ($item['name']  == 'id') continue;

            //枚举筛选
            if (!empty($item['enum'])) {
                $enumsClass = $app->className . '::' . $item['name'];
                $filter .= '       $filter->in("' . $item["name"] . '","' . $this->getMsgPreg($item["enum_name"]). '")->checkbox(' . $enumsClass . ');' . PHP_EOL;
                continue;
            }

            if (strstr($item['origin_comment'],'search')){
                $filter .= '$filter->equal("'.$item["name"].'", "'.$this->getMsgPreg($item["origin_comment"]).'");';
                continue;
            }

            if (strstr($item['name'], 'name')) {
                $filter .= '       $filter->like("' . $item['name'] . '", "' . $this->getMsgPreg( $item["origin_comment"]) . '");' . PHP_EOL;
                continue;
            }
//            if ($item['name'] == 'platform_type'){
//                var_dump($item);exit;
//            }

            //时间筛选
            if ($item['name'] == 'created_at') {
                $filter .= '     $filter->between("created_at", "创建时间")->datetime();';

            }




        }


        $gridInit = '
         if (method_exists($then,"gridInit")){
              $then->gridInit($grid);
            }
        ';


        //默认倒叙
        $this->AdminTemplate = str_replace("{{gridInit}}", $gridInit, $this->AdminTemplate);

        if ($filter) {
            $template = '
        $grid->batchActions(function (Grid\Tools\BatchActions $batch) {
            $batch->disableDelete();
         });
        
            $grid->filter(function($filter)use($then){
            
            if (method_exists($then,"gridFilter")){
                $then->gridFilter($filter);
                return;
            }
                
                $filter->expand(false);
    {{filter}}
});';
            $template = str_replace('{{filter}}', $filter, $template);

        }
        $this->AdminTemplate = str_replace("{{filter}}", $template, $this->AdminTemplate);

        $orderBy = '';



        $orderBy = '
         if (method_exists($then,"orderBy")){
              $then->orderBy($grid);
            }else{
              $grid->model()->orderBy(\'created_at\',\'desc\');
            }
        
        ';


        //默认倒叙
        $this->AdminTemplate = str_replace("{{orderBy}}", $orderBy, $this->AdminTemplate);


        $disableDelete = '//$actions->disableDelete();';

        if (strstr($this->app->table->table_comment,'disableDelete') || strstr($this->app->table->table_comment,'notDelete')){
            $disableDelete = '$actions->disableDelete();';
        }

        $disableEdit = '//$actions->disableEdit();';

        if (strstr($this->app->table->table_comment,'disableEdit')){
            $disableEdit = '$actions->disableEdit();';
        }

        //操作
        $action = '$grid->actions(function ($actions)use($then) {

            if (method_exists($then,"addGridAction")){
                $actions = $then->addGridAction($actions);
            }

            // 去掉删除
            '.$disableDelete.'
            // 去掉编辑
            '.$disableEdit.'
        
            // 去掉查看
            $actions->disableView();
});';

        $disableAdd = '';
        if (strstr($app->table->table_comment,'disableAdd')){
            $disableAdd = '$grid->disableCreateButton();';
        }


        if (strstr($this->app->table->table_comment,'disableEdit')){
            $disableEdit = '$grid->disableQuickEditButton();';
        }


        $this->AdminTemplate = str_replace("{{action}}", $action, $this->AdminTemplate);
        $this->AdminTemplate = str_replace("{{disableEdit}}", $disableEdit, $this->AdminTemplate);
        $this->AdminTemplate = str_replace("{{disableAdd}}", $disableAdd, $this->AdminTemplate);


        foreach ($app->struct->struct as $item) {

            if (strstr($item['origin_comment'],'listHide'))continue;
            if (config('admin_hide_id') && $item['name'] == 'id') continue;
            if (strstr($item['origin_comment'], 'fieldHide')) continue;
            if (strstr($item['origin_comment'],'listHide')) continue;
            if (in_array($item['name'], ['updated_at', 'deleted_at'])) continue;


            if ($item['name'] == 'image_url') {
                $list .= '$grid->column("image_url", __("图片"))->image();';
                continue;
            }

            $enum = !empty($this->enums[$item['name']]) ? $this->enums[$item['name']] : '';
            if ($enum) {
                $list .= '
                method_exists($then,"column_'.$item['name'].'")?$then->column_'.$item['name'].'($grid):$grid->column("' . $item['name'] . '", __("' . $enum['key_note'] . '"))->using(' . $app->className . '::' . $item['name'] . ');' . PHP_EOL;
            } else {
                $comment = $this->getMsgPreg($item['comment']);
                if ($item['name'] == $app->table->pk) {
                    $comment = 'id';
                }
                $extend = '';

                if ($this->getPergByRule('help', $item['origin_comment'])) {
                    $extend .= '->help("' . $this->getPergByRule('help', $item['origin_comment']) . '")';
                }

                if ($this->isImage($item['origin_comment'])) {
                    $extend .= "->image('',50,50)";
                }

                $columnName = $item['name'];

                if (!empty($item['belongName'])){
                    $columnName =  $item['belongName'];
                }

                $methodExstsColumnName = str_replace('.','_',$columnName);

                $list.='
                method_exists($then,"column_'.$methodExstsColumnName.'")?$then->column_'.$methodExstsColumnName.'($grid):$grid->column("' . $columnName . '", __("' . $comment . '"))' . $extend . ';'. PHP_EOL;
            }

        }
        return $list;
    }


    /**
     * 详情
     */
    private function dcatField()
    {
        $list = '';
        /**
         * @var Application $app
         */
        $app = $this->app;
        $lng = false;
        foreach ($app->struct->struct as $item) {

            if ($item['name'] == 'lng' || $item['name'] == 'lat') {
                if ($lng == false) {
                    $list .= '       $show->field("经纬度")->latlong("lat", "lng", $height = 400, $zoom = 16);' . PHP_EOL;
                }
                $lng = true;
                continue;
            }

            $enum = !empty($this->enums[$item['name']]) ? $this->enums[$item['name']] : '';
            if ($enum) {
                $list .= '       $show->' . $item['name'] . '("' . $enum['key_note'] . '")->using(' . $app->className . '::' . $item['name'] . ');' . PHP_EOL;
            } else {

                $comment = $item['comment'];
                if ($item['name'] == $app->table->pk) {
                    $comment = 'id';
                }

                $list .= '       $show->field("' . $item['name'] . '", __("' . $comment . '"));' . PHP_EOL;
            }
        }
        return $list;
    }

    /**
     * 编辑
     */
    private function dcatForm()
    {
        /**
         * @var Application $app
         */
        $app = $this->app;
        $list = '';
        /**
         * @var Application $app
         */
        $app = $this->app;
        $lng = false;
        //右上角的操作按钮
        $tools = '$form->tools(function (Form\Tools $tools) {
        


        // 去掉`列表`按钮
        $tools->disableList();
    
        // 去掉`删除`按钮
        $tools->disableDelete();
    
        // 去掉`查看`按钮
        $tools->disableView();
    
        // 添加一个按钮, 参数可以是字符串, 或者实现了Renderable或Htmlable接口的对象实例
       // $tools->add(\'<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>\');
       });';
        $this->AdminTemplate = str_replace('{{tools}}', $tools, $this->AdminTemplate);

        $init = '';
        $this->AdminTemplate = str_replace('{{init}}', $init, $this->AdminTemplate);

        foreach ($app->struct->struct as $item) {
            if (config('admin_hide_id') && $item['name'] == 'id') continue;
            if (strstr($item['origin_comment'], 'fieldHide')) continue;
            if (strstr($item['origin_comment'], 'formHide')) continue;
            if (strstr($item['origin_comment'], 'editHide')) continue;
            if (in_array($item['name'], config('exclude_fillable'))) continue;

            //Cid项目--例外
            if ($this->app->projectName == 'cid' && $item['name']  == 'merchant_id'){

                $list.= '
        if (method_exists($then,"merchant")){
                    $then->merchant($form);
                }else{
                    $form->select("merchant_id", __("商户"))->options(\App\Models\Merchant::query()->pluck("company_name as text","id"))->required()->rules("required");
                }
        ';
                continue;
            }


            $fieldName = $item['name'];

            $list.='               
         method_exists($then,"form_'.$fieldName.'")?$then->form_'.$fieldName.'($form):';


            if ($item['name'] == 'lng' || $item['name'] == 'lat') {
                if ($lng == false) {
                    $list .= '$form->latlong("lat", "lng", "经纬度")->default(["lat" =>23.129102812719083, "lng" =>113.26416495256126]);' . PHP_EOL;
                }
                $lng = true;
                continue;
            }
            $default_str = '';
            if (!empty($item['default'])) {
                $default_str = '->default("' . $item['default'] . '")';
            }

            //帮助
            $help_str = !empty($item['help']) ? $item['help'] : '';
            if ($help_str) {
                $help_str = '->help("' . $item['help'] . '")';
            }
            if ($item['name'] == $app->table->pk) {

                $list .= '$form->text("' . $item['name'] . '", __("' . 'id' . '"))->disable()' . $default_str . $help_str . ';' . PHP_EOL;
                continue;
            }

            //如果用到userid
            if ($item['name'] == 'user_id' && config('user_id_translate_the_name')) {
                $list .= '$form->text("' . config('user_id_translate_the_name') . '", __("用户"))->disable()' . $default_str . $help_str . ';' . PHP_EOL;
                continue;
            }
            //图片判断
            if ($item['name'] == 'image_url') {
                $list .= '$form->image(\'image_url\',\'图片\');';
                continue;
            }

            $enum = !empty($this->enums[$item['name']]) ? $this->enums[$item['name']] : '';
//            var_dump($item);exit;
            //拓展
            $extend = '';
            if (strstr($item['origin_comment'], 'required')) {
                $extend .= '->required()';
            }

            //帮助生成
            if ($this->getPergByRule('help', $item['origin_comment'])) {
                $extend .= '->help("' . $this->getPergByRule('help', $item['origin_comment']) . '")';
            }

            //是否禁用
            if (strstr($item['origin_comment'], 'fieldDisable')) {
                $extend .= '->disable()';
            }

            //默认值
            if ($item['default']) {
                $extend .= '->default("' . $item['default'] . '")';
            }


//             preg_match('/msg\[(.*?)\]/','msg[商户权限] belongsTo[admin_roles] relationField[adminRoles.name]', $matches);
//             var_dump($matches);exit;


            //兼容编辑时唯一性
            if ($this->getRulePreg($item['origin_comment'], true)) {
                $rule = explode('|', $this->getRulePreg($item['origin_comment'], true));
                $resultRule = [];
                foreach ($rule as $validate) {
                    if (strstr($validate, 'unique')) {
                        $resultRule[] = $validate . '{$id}';
                        continue;
                    }
                    $resultRule[] = $validate;
                }

                $resultRule = implode('|', $resultRule);

                $extend .= '->rules("' . $resultRule . '")';
            }

            $msg = $this->getMsgPreg($item['origin_comment']);

            $getEnums = $this->enums($item['name'], $item['origin_comment']);

            if ($getEnums) {
                $msg = $getEnums['key_note'];
            }




            if ($enum) {
                $list .= '$form->select("' . $item['name'] . '", __("' . $msg . '"))->options(' . $app->className . '::' . $item['name'] . ')' . $extend . $default_str . $help_str . ';' . PHP_EOL;
                continue;
            }
            if (!empty($item['belongClass'])){
                $list .= '$form->select("' . $item['name'] . '", __("' . $msg . '"))->options(\App\Models\\'.$item['belongClass'].'::query()->pluck("'.$item["belongNameOne"].' as text","id"))' . $extend . $default_str . $help_str . ';' . PHP_EOL;
                continue;
            }






            if ($item['type'] == 'int') {
                $list .= '$form->number("' . $item['name'] . '", __("' . $msg . '"))' . $extend . $default_str  . ';' . PHP_EOL;
            } else {

                $comment = $this->getMsgPreg($item['origin_comment']);

                if ($item['name'] == 'role_id') {

                }
                if ($item['name'] == $app->table->pk) {
                    $comment = 'id';
                }

                if ($this->isImage($item['origin_comment'])) {


                    $extend .= '->autoUpload()->retainable()';
                    $list .= '$form->image("' . $item['name'] . '", __("' . $msg . '"))' . $extend . $default_str  . ';' . PHP_EOL;
                    continue;
                }
                if (strstr($item['origin_comment'], 'mobile')) {
                    $list .= '$form->mobile("' . $item['name'] . '", __("' . $msg . '"))' . $extend . $default_str  . ';' . PHP_EOL;
                    continue;
                }

                $list .= '$form->text("' . $item['name'] . '", __("' . $msg . '"))' . $extend . $default_str  . ';' . PHP_EOL;


            }




        }
        $list.='
        if (method_exists($then,"customForm")){
             $then->customForm($form);
            
        }
           ';
        return $list;
    }


    /**
     * @return string
     */
    public function dcatColumnRelation()
    {
        $structRelation = $this->app->struct->structRelation;
        if (empty($structRelation['belongsTo'])) return '';

        $temp = implode(',', array_map(function ($item){
            return "'$item'";
        },$structRelation['belongsTo']));
        return '$grid->model()->with([' . $temp . ']);';

    }

}
