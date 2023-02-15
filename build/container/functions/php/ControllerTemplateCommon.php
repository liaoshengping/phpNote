<?php


namespace container\functions\php;


use container\Application;
use container\functions\Struct;
use Inhere\Console\Util\Show;

trait ControllerTemplateCommon
{

    /**
     * 查询需要的字段
     * @var
     */
    public $requestFieldsTemplate = '';


    public function buildInitController()
    {
        $template = '
    public $model;
    public $append;

    public function __construct()
    {
        {{content}}
    }
              ';
        $model = '\\' . config('model_namespace_path') . '\\' . $this->classModelName;
        $content = '
        $this->model = new ' . $model . '();
        ';

        return [
            'document' => '',
            'template' => str_replace('{{content}}', $content, $template),
        ];
    }

    public function buildStoreController()
    {

        $config = $this->getCurrentSetting();

        /**
         * @var Application $this ->app
         */
        $api_doc = config('api_doc');
        if ($api_doc == 'swagger' && !in_array('create', $this->getCurrentSetting('no_swagger_actions', []))) {
            $template = $this->getStoreNote();
        } else {
            $template = '
        /**
         *  新增
        **/   
        public function store(Request $request){
         {{content}}
         }';
        }
        $request_method = $config['request_method'] ?? '';

        //这边无所谓，隐藏不隐藏，搜不到 {{request}} 这边是无效的
        if ($request_method != 'json') {
            $requestForm = $this->getRequestFormByScence('create');
            $template = str_replace('{{request}}', $requestForm, $template);
        } else {
            //json 请求
            $requestJson = '     *     @OA\RequestBody(
     *         description="order placed for purchasing th pet",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/' . $this->app->{$this->app->frame}->classModelName . '")
     *     ),';
            $template = str_replace('{{request}}', $requestJson, $template);
        }

        $auth_store = '';
        $relation_save = '';
        if (!empty($this->getCurrentSetting('is_auth_store'))) {

            $auth_store = '
        $data = array_merge($data, [
             "store_id"=>' . config('auth_store_id') . '
         ]);' . PHP_EOL;

        }
        if ($this->getCurrentSetting('relation_save')) {
            $relation_save = '$res->saveRelation($data);';
        } else {
            //判断是否有  liaosp/laravel-relation-save 这个包
            $composer_path = config('frame_path') . 'composer.json';
            $composer_file = file_get_contents($composer_path);
            if (strstr($composer_file, 'liaosp/laravel-relation-save')) {
                $relation_save = '$res->saveRelation($data);';
            }
        }


        $content = '
        $validate = Validator::make($request->all(), $this->model->rule);

        if (!$validate->passes()) {
            return $this->failure($validate->errors()->first());
        }
        
        $data = $validate->getData();
        

        
        try {
         if (method_exists($this,"handleRequest")){ //处理数据

             $data = $this->handleRequest($data);
         }
        {{auth_store}}
        if (method_exists($this,"saveBefore")){ //保存之前发生的事
           $data =$this->saveBefore($data) ?? $data;
         }
        
        
         DB::beginTransaction();
         
         $res = $this->model->create($data);
        
         {{relation_save}}
         
         if (method_exists($this,"saved")){ //保存之后发生的事

             $res =$this->saved($res,$data) ?? $res;
             
         }
         
         
        
         DB::commit();
         
         }catch (\Exception $e){
         
         DB::rollBack();
         
         return $this->failure($e->getMessage());

         }
        
        if ($res) {
            return $this->successData($res);
        } else {
            return $this->failure();
        }
        ';

        $content = str_replace('{{auth_store}}', $auth_store, $content);
        $content = str_replace('{{relation_save}}', $relation_save, $content);


        return [
            'document' => '文档',
            'template' => str_replace('{{content}}', $content, $template),
        ];


    }

    public function buildDelController()
    {

        $status_delete = $this->getCurrentSetting('status_delete'); //状态删除
        $api_prefix = config('api_prefix');
        $tags = $this->getThisTags();
        $template = '
     /**
     * @OA\Post(
     *      path="/' . $api_prefix . '/' . $this->app->table->table_name . '/del",
     *      operationId="' . $api_prefix . '/' . $this->app->table->table_name . '/del",
     *      tags={"' . $tags . '"},
     *      summary="' . $tags . '删除",
     *      description="' . $tags . '删除",
     *      @OA\Parameter(
     *          name="' . $this->app->table->pk . '",
     *          description="",
     *          required=false,
     *          in="query",
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *       
     *     ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=401, description="token错误或为空"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "api_key":{}
     *         }
     *     },
     * )
     */

     public function del(Request $request){
      {{content}}
      }
              ';

        //删除检查表
        $check = '';
        if ($delete_check = $this->getCurrentSetting('delete_check')) {
            $check = '   
             
         if (!$res){
            {{checks}}
          }';

            $check = str_replace('{{checks}}', $this->getCheckModels(), $check);
        }


        $content = '
        $keyName = $this->model->getKeyName();

        $id = $request->get($keyName);

        $res = $this->model->find((int)$id);
         
        {{check}} 
         
        if ($res) {
            $res->delete();
            return $this->successData($res);
        } else {
            return $this->failure(\'不存在id为：\' . $id);
        }
        ';

        if ($status_delete) {
            $content = '
        $keyName = $this->model->getKeyName();

        $id = $request->get($keyName);

        $res = $this->model->find((int)$id);
            
        {{check}} 
        
        if ($res) {
            $res->' . $status_delete["key"] . ' = "' . $status_delete["value"] . '";
            $res->save();
            return $this->successData($res);
        } else {
            return $this->failure(\'不存在id为：\' . $id);
        }
        ';
        }

        $content = str_replace('{{check}}', $check, $content);


        return [
            'document' => '删除文档',
            'template' => str_replace('{{content}}', $content, $template),
        ];
    }

    /**
     * 获取检查的Models
     */
    public function getCheckModels()
    {
        $delete_check = $this->getCurrentSetting('delete_check');
        $datas = '';
        foreach ($delete_check as $item) {
            $data = '$' . $item["table"] . ' = ' . $item["model"] . '::where("' . $item["key"] . '",$id)->exists();
           if ($' . $item["table"] . '){
               return $this->failure(\'系统已存在该数据记录，不能删除\');
           }' . PHP_EOL;
            $datas .= $data;
        }
        return $datas;
    }


    /**
     * 修改状态接口
     */
    public function buildChangeController($name)
    {

        $fieldInfo = $this->app->struct->getFieldByKey($name);

        if (!$fieldInfo) {
            Show::block("没有找到Change 字段的字段,这个信息非常重要!!请检查 config 中表的配置", 'error', 'error');
            return false;
        }

        $api_prefix = config('api_prefix');
        $tags = $this->getThisTags();
        $functionStatus = 'change' . ucfirst($name);


        $content = '  
    /**
     * @OA\Post(
    *       path="/' . $api_prefix . '/' . $this->app->table->table_name . '/' . $functionStatus . '",
     *      operationId="' . $api_prefix . '/' . $this->app->table->table_name . '/' . $functionStatus . '",
     *      tags={"' . $tags . '"},
     *      summary="' . $tags . $name . '修改",
     *      description="' . $tags . $name . '修改值",
     *      @OA\Parameter(
     *          name="' . $this->app->table->pk . '",
     *          description="",
     *          required=true,
     *          in="query",
     *      ),
     *      @OA\Parameter(
     *          name="' . $name . '",
     *          description="' . $fieldInfo['origin_comment'] . '",
     *          required=true,
     *          in="query",
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "api_key":{}
     *         }
     *     },
     * )
     */
      public function ' . $functionStatus . '(Request $request){

          $keyName = $this->model->getKeyName();

          $id = $request->input($keyName);
          $' . $name . ' = $request->input("' . $name . '");

          $res = $this->model->find((int)$id);

          if ($res) {
              $res->' . $name . ' = $' . $name . ';
              $res->save();
              return $this->successData($res);
          } else {
              return $this->failure("不存在id为：" . $id);
          }


      }';

        return [
            'document' => '修改',
            'template' => $content,
        ];


    }

    public function buildListsController()
    {

        /**
         * @var Application $this ->app
         */
        $api_doc = config('api_doc');
        if ($api_doc == 'swagger') {
            $template = $this->getListNote();
        } else {
            $template = '
        /**
         *  列表
        **/   
        public function lists(Request $request){
         {{content}}
         }';
        }

        $config = $this->getCurrentSetting();

        $request_method = $config['request_method'] ?? '';

        //这边无所谓，隐藏不隐藏，搜不到 {{request}} 这边是无效的
//        if ($request_method != 'json') {
        $requestForm = $this->getRequestFormByScence('list');

        $template = str_replace('{{request}}', $requestForm, $template);
//        } else {
//            //json 请求
//            $requestJson = '     *     @OA\RequestBody(
//     *         description="请用标准的json请求，可到json.cn 验证json",
//     *         required=true,
//     *         @OA\JsonContent(ref="#/components/schemas/' . $this->app->{$this->app->frame}->classModelName . '")
//     *     ),';
//            $template = str_replace('{{request}}', $requestJson, $template);
//        }

        $with = [];
        $relations = $this->getRelation();
        foreach ($relations as $relation) {

            foreach ($relation['tables'] as $item) {
                if (empty($item['list_show'])) {
                    continue;
                }

                $relation_name = !empty($item['relation_name']) ? $item['relation_name'] : $item['table_name'];

                $with[] = "'" . $relation_name . "'";
            }
        }
        if (!empty($with)) {
            $with = '->with([' . implode(",", $with) . '])' . PHP_EOL;
        } else {
            $with = '';
        }
        $auth = '';

        $query_join_name = $this->getCurrentSetting('query_join')?$this->app->table->table_name.'.':'';

        if (!empty($config['is_auth'])) {
            $auth = '        ->where("'.$query_join_name.'user_id",' . config('auth_user_id') . ')' . PHP_EOL;
        }

        if (!empty($config['is_auth_store'])) {
            $auth = '        ->where("'.$query_join_name.'store_id",' . config('auth_store_id') . ')' . PHP_EOL;
        }


        $getRequestQuery = $this->getRequestQuery();


        $content = '
        
        {{getRequestQuery}}
        
        $query = $this->model' . $with . $auth . $getRequestQuery;

        $status_delete = $this->getCurrentSetting('status_delete');
        $status_delete_str = '';
        if ($status_delete) {
            $status_delete_str .= '
            $query->where("' . $status_delete['key'] . '","!=", "' . $status_delete['value'] . '");';
        }
        $content .= ' 
        
      ' . $status_delete_str . '
          
        if (method_exists($this,"listQuery")){

          $query = $this->listQuery($query);

       }

        $query->orderBy("'.$query_join_name.'created_at","desc");

       ';


        $content .= '
        
        if ($request->input(\'all\')) {
            $data = $query->get();
        } else {
            $data = $query->paginate();
        }
        
        if (property_exists($this,\'append\') && $this->append || \request()->input(\'append\')) {
            if (empty($this->append)){
                $this->append = \request()->input(\'append\');
            }
            if (is_string($this->append)){
                $this->append = explode(\',\',$this->append);
            }
            $data->transform(function ($item) {
                return $item->append($this->append);
            });
        }     

        return $this->successData($data);
        ';

        $content = str_replace('{{getRequestQuery}}', $this->requestFieldsTemplate, $content);
        return [
            'document' => '文档',
            'template' => str_replace('{{content}}', $content, $template),
        ];

    }

    public function buildEditController()
    {
        $config = $this->getCurrentSetting();
        /**
         * @var Application $this ->app
         */
        $api_doc = config('api_doc');
        if ($api_doc == 'swagger' && !in_array('edit', $this->getCurrentSetting('no_swagger_actions', []))) {
            $template = $this->getEditNote();
        } else {
            $template = '
     /**
     * 编辑
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
     public function edit(Request $request){
      {{content}}
      }';
        }

        $relation_save = '';
        if ($this->getCurrentSetting('relation_save')) {
            $relation_save = '$model->saveRelation($data);';
        } else {
            //判断是否有  liaosp/laravel-relation-save 这个包
            $composer_path = config('frame_path') . 'composer.json';
            $composer_file = file_get_contents($composer_path);
            if (strstr($composer_file, 'liaosp/laravel-relation-save')) {
                $relation_save = '$model->saveRelation($data);';
            }
        }

        $request_method = $config['request_method'] ?? '';

        //这边无所谓，隐藏不隐藏，搜不到 {{request}} 这边是无效的
        if ($request_method != 'json') {
            $requestForm = $this->getRequestFormByScence('edit');
            $template = str_replace('{{request}}', $requestForm, $template);
        } else {
            //json 请求
            $requestJson = '     *     @OA\RequestBody(
     *         description="order placed for purchasing th pet",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/' . $this->app->{$this->app->frame}->classModelName . '")
     *     ),';
            $template = str_replace('{{request}}', $requestJson, $template);
        }


        $content = '
        
        
        
        
        $keyName = $this->model->getKeyName();
        $id = $request->input($keyName);
        $model = $this->model->find((int)$id);
        if (!$model) {
            return $this->failure(\'不存在id为：\' . $id);
        }
        
         $data = $request->all();
        
         if (method_exists($this,"handleRequest")){ //处理数据
             $data = $this->handleRequest($data);
         }
        
        $validate = Validator::make($data,property_exists($this,\'rule\')?$this->rule:$this->model->rule);
        
        if (!$validate->passes()) {
            return $this->failure($validate->errors()->first());
        }
    

        $model->fill($data);

        $res = $model->save();
        
        {{relation_save}}

         if (method_exists($this,"saved")){ //保存之后发生的事

             $res =$this->saved($model,$data) ?? $res;
             
         }

        if ($res) {
            return $this->successData($model);
        } else {
            return $this->failure();
        }
        ';
        $template = str_replace('{{content}}', $content, $template);

        $template = str_replace('{{relation_save}}', $relation_save, $template);

        return [
            'document' => '##修改',
            'template' => $template,
        ];
    }

    public function buildShowController()
    {
        $api_prefix = config('api_prefix');
        $tags = $this->getThisTags();
        $template = '
    /**
     * @OA\Get(
     *      path="/' . $api_prefix . '/' . $this->app->table->table_name . '/show",
     *      operationId="' . $api_prefix . '/' . $this->app->table->table_name . '/show",
     *      tags={"' . $tags . '"},
     *      summary="' . $tags . '详情",
     *      description="' . $tags . '详情信息",
     *      @OA\Parameter(
     *          name="' . $this->app->table->pk . '",
     *          description="' . $this->app->table->table_name . '索引id",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *         ref="#/components/schemas/' . $this->app->{$this->app->frame}->classModelName . '"
     *         )
     *     ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "api_key":{}
     *         }
     *     },
     * )
     */
    public function show(Request $request)
    {
       {{content}}
    }
              ';


        $with = [];
        $relations = $this->getRelation();
        foreach ($relations as $relation) {

            foreach ($relation['tables'] as $item) {
                if (empty($item['one_show'])) {
                    continue;
                }
                $table_name = $item['table_name'];
                if (!empty($item['relation_name'])) {
                    $table_name = $item['relation_name'];
                }
                $with[] = "'" . $table_name . "'";
            }
        }
        if (!empty($with)) {
            $with = '->with([' . implode(",", $with) . '])';
        } else {
            $with = '';
        }
        $content = '
        $keyName = $this->model->getKeyName();

        $id = $request->get($keyName);
        
        $with = property_exists($this,\'with\');
        
        if($with){
          $query = $this->model->with($this->with);
        }else{
          $query = $this->model{{with}};
        }
        $res = $query->find((int)$id);
        
        
        if (method_exists($this,"findOne")){ 

            $res =$this->findOne($res) ?? $res;

        }
        
        if ($res) {
            return $this->successData($res);
        } else {
            return $this->failure(\'不存在\'.$keyName.\'为：\' . $id);
        }
        ';

        $content = str_replace('{{with}}', $with, $content);


        return [
            'document' => '##获取详情',
            'template' => str_replace('{{content}}', $content, $template),
        ];
    }

    /**
     * 获取查询条件
     */
    public function getRequestQuery()
    {
        $query_join_name = $this->getCurrentSetting('query_join')?$this->app->table->table_name.'.':'';
        $query = '';
        /**
         * @var Application $app
         */
        $app = $this->app;
        $status_delete = $this->getCurrentSetting('status_delete');


        if ($this->getCurrentSetting('list_keyword_search')) {
            $this->requestFieldsTemplate .= '
       $' . config('keyword_name', 'keyword') . ' = $request->input("' . config('keyword_name', 'keyword') . '","");';
        }

        //筛选日期
        if (config('data_list_filter_time')) {
//            $created_at = config('data_list_filter_time');
            $this->requestFieldsTemplate .= '
       $start_at = $request->input("start_at","");';
            $this->requestFieldsTemplate .= '
       $end_at = $request->input("end_at","");';
        }

        //是否为必要参数
        foreach ($app->struct->struct as $item) {


            if (in_array($item['name'], $this->listFiltrateParameter())) {
                $this->requestFieldsTemplate .= '
       $' . $item['name'] . ' = $request->input("' . $item['name'] . '","");';

                if (!empty($item['enum'])) {
                    $query .= '
            ->when($' . $item['name'] . ',function ($query)use($' . $item['name'] . '){
                if (strstr($' . $item['name'] . ',\',\')){
                    $' . $item['name'] . ' = explode(\',\',$' . $item['name'] . ');
                    $query->whereIn("' .$query_join_name. $item['name'] . '", $' . $item['name'] . ');
                }else{
                    
                    $query->where("' . $query_join_name.$item['name'] . '", $' . $item['name'] . ');
                    
                }
            })';
                } else {

                    if (strstr($item['name'], 'name') || strstr($item['name'], '_no')) {
                        $query .= '
            ->when($' . $item['name'] . ',function ($query)use($' . $item['name'] . '){
                   $query->where("' .$query_join_name. $item['name'] . '","like", "%$' . $item['name'] . '%");
               
            })';
                    } else {
                        $query .= '
            ->when($' . $item['name'] . ',function ($query)use($' . $item['name'] . '){
                   $query->where("' .$query_join_name.$item['name'] . '", $' . $item['name'] . ');
               
            })';
                    }


                }

            }
        }

        //筛选日期
        if (config('data_list_filter_time')) {
            $created_at = config('data_list_filter_time');

            $query .= '
           ->when($start_at, function ($query) use ($start_at) {
                    $query->where("' .$query_join_name. $created_at . '", \'>=\', $start_at);
                })';

            $end_at_change = '';

            if ($this->getCurrentSetting('list_created_at_add_time')) {
                $day = $this->getCurrentSetting('list_created_at_add_time');
                $end_at_change .= '
                //时间戳
                if(is_numeric($end_at)){
                   $end_at =  strtotime(\'+1 ' . $day . '\',$end_at);
                }else{
                   $end_at = date("Y-m-d H:i:s",strtotime("+1 ' . $day . '",strtotime($end_at)));
                }
                ';
            }
            $query .= '

           ->when($end_at, function ($query) use ($end_at) {
                    ' . $end_at_change . '
                    $query->where("' .$query_join_name. $created_at . '", \'<\', $end_at);
                })';
        }

        if ($this->getCurrentSetting('list_keyword_search')) {
            $query .= '
            ->when($' . config('keyword_name', 'keyword') . ',function ($query)use($' . config('keyword_name', 'keyword') . '){
                   $query->where(function ($query)use($' . config('keyword_name', 'keyword') . '){
                      {{keywordTemplate}}
                   });
               
            })';
            $keywordTemplate = '';


            foreach ($this->getCurrentSetting('list_keyword_search') as $item) {
                if ($item['op'] == 'like') {
                    $keywordTemplate .= '
                       $query->orWhere("' .$query_join_name. $item['key'] . '","' . $item['op'] . '","%$' . config('keyword_name', 'keyword') . '%");';
                } else {
                    $keywordTemplate .= '
                       $query->orWhere("' .$query_join_name. $item['key'] . '","' . $item['op'] . '","$' . config('keyword_name', 'keyword') . '");';
                }

            }


            $query = str_replace('{{keywordTemplate}}', $keywordTemplate, $query);


        }


        $query .= ';';

        if (config('common_query')) {
            $template = config('common_query');
            if ($this->getCurrentSetting('time_between_field')) {
                $template = str_replace('created_at', $this->getCurrentSetting('time_between_field'), $template);
            }
            $query .= $template;
        }


        return $query;


    }


}
