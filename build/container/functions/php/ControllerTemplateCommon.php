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
        if ($api_doc == 'swagger') {
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

        if (!empty($this->getCurrentSetting('is_auth_store'))) {

            $auth_store = '
        $data = array_merge($data, [
             "store_id"=>' . config('auth_store_id') . '
         ]);' . PHP_EOL;

        }


        $content = '
        $validate = Validator::make($request->all(), $this->model->rule);

        if (!$validate->passes()) {
            return $this->failure($validate->errors()->first());
        }
        
        $data = $validate->getData();
        {{auth_store}}
        $res = $this->model->create($data);

        if ($res) {
            return $this->successData($res);
        } else {
            return $this->failure();
        }
        ';

        $content = str_replace('{{auth_store}}', $auth_store, $content);


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
     *         @OA\JsonContent(
     *         ref="#/components/schemas/Test"
     *         )
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

            $check =  str_replace('{{checks}}',$this->getCheckModels(),$check);
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

        $content = str_replace('{{check}}',$check,$content);


        return [
            'document' => '删除文档',
            'template' => str_replace('{{content}}', $content, $template),
        ];
    }

    /**
     * 获取检查的Models
     */
    public function getCheckModels(){
        $delete_check = $this->getCurrentSetting('delete_check');
        $datas = '';
        foreach ($delete_check as $item){
            $data ='$'.$item["table"].' = '.$item["model"].'::where("'.$item["key"].'",$id)->exists();
           if ($'.$item["table"].'){
               return $this->failure(\'系统已存在该数据记录，不能删除\');
           }'.PHP_EOL;
            $datas.= $data;
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
     *         @OA\JsonContent(
     *         ref="#/components/schemas/Test"
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
        if ($request_method != 'json') {
            $requestForm = $this->getRequestFormByScence('list');

            $template = str_replace('{{request}}', $requestForm, $template);
        } else {
            //json 请求
            $requestJson = '     *     @OA\RequestBody(
     *         description="请用标准的json请求，可到json.cn 验证json",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/' . $this->app->{$this->app->frame}->classModelName . '")
     *     ),';
            $template = str_replace('{{request}}', $requestJson, $template);
        }

        $with = [];
        $relations = $this->getRelation();
        foreach ($relations as $relation) {

            foreach ($relation['tables'] as $item) {
                if (empty($item['list_show'])) {
                    continue;
                }
                $with[] = "'" . $item['table_name'] . "'";
            }
        }
        if (!empty($with)) {
            $with = '->with([' . implode(",", $with) . '])' . PHP_EOL;
        } else {
            $with = '';
        }
        $auth = '';
        if (!empty($config['is_auth'])) {
            $auth = '        ->where("user_id",' . config('auth_user_id') . ')' . PHP_EOL;
        }

        if (!empty($config['is_auth_store'])) {
            $auth = '        ->where("store_id",' . config('auth_store_id') . ')' . PHP_EOL;
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
        if (method_exists($this,"listQuery")){

          $query = $this->listQuery($query);

       }else{
          ' . $status_delete_str . '
          $query->orderBy("created_at","desc");
       }';


        $content .= '
        
        if ($request->input(\'all\')) {
            $data = $query->get();
        } else {
            $data = $query->paginate();
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
        /**
         * @var Application $this ->app
         */
        $api_doc = config('api_doc');
        if ($api_doc == 'swagger') {
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

        $id = $request->get($keyName);

        $model = $this->model->find((int)$id);

        if (!$model) {
            return $this->failure(\'不存在id为：\' . $id);
        }


        $validate = Validator::make($request->all(), $this->model->rule);

        if (!$validate->passes()) {
            return $this->failure($validate->errors()->first());
        }

        $model->fill($validate->getData());

        $res = $model->save();

        if ($res) {
            return $this->successData($model);
        } else {
            return $this->failure();
        }
        ';

        return [
            'document' => '##修改',
            'template' => str_replace('{{content}}', $content, $template),
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
                $with[] = "'" . $item['table_name'] . "'";
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

        $res = $this->model{{with}}->find((int)$id);

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

        $query = '';
        /**
         * @var Application $app
         */
        $app = $this->app;
        $status_delete = $this->getCurrentSetting('status_delete');

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
                    $query->whereIn("' . $item['name'] . '", $' . $item['name'] . ');
                }else{
                    
                    $query->where("' . $item['name'] . '", $' . $item['name'] . ');
                    
                }
            })';
                } else {

                    if (strstr($item['name'], 'name') || strstr($item['name'], '_no')) {
                        $query .= '
            ->when($' . $item['name'] . ',function ($query)use($' . $item['name'] . '){
                   $query->where("' . $item['name'] . '","like", "%$' . $item['name'] . '%");
               
            })';
                    } else {
                        $query .= '
            ->when($' . $item['name'] . ',function ($query)use($' . $item['name'] . '){
                   $query->where("' . $item['name'] . '", $' . $item['name'] . ');
               
            })';
                    }


                }

            }
        }

        $query .= ';';


        return $query;


    }


}