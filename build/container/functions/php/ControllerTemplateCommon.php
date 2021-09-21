<?php


namespace container\functions\php;


use container\Application;
use container\functions\Struct;

trait ControllerTemplateCommon
{

    /**
     * 查询需要的字段
     * @var
     */
    public $requestFieldsTemplate='';


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

        $content = '
        $validate = Validator::make($request->all(), $this->model->rule);

        if (!$validate->passes()) {
            return $this->failure($validate->errors()->first());
        }
        
        $res = $this->model->create($validate->getData());

        if ($res) {
            return $this->successData($res);
        } else {
            return $this->failure();
        }
        ';

        return [
            'document' => '文档',
            'template' => str_replace('{{content}}', $content, $template),
        ];


    }

    public function buildDelController()
    {
        $template = '
    /**
     * 删除
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
     public function del(Request $request){
      {{content}}
      }
              ';

        $content = '
        $keyName = $this->model->getKeyName();

        $id = $request->get($keyName);

        $res = $this->model->find((int)$id);

        if ($res) {
            $res->delete();
            return $this->successData($res);
        } else {
            return $this->failure(\'不存在id为：\' . $id);
        }
        ';

        return [
            'document' => '删除文档',
            'template' => str_replace('{{content}}', $content, $template),
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
         *  新增
        **/   
        public function lists(Request $request){
         {{content}}
         }';
        }

        $config = $this->getCurrentSetting();

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
            $with = '->with([' . implode(",", $with) . '])'.PHP_EOL;
        } else {
            $with = '';
        }
        $auth = '';
        if (!empty($config['is_auth'])){
            $auth = '->where("user_id",'.config('auth_user_id').')'.PHP_EOL;
        }
        $getRequestQuery = $this->getRequestQuery();

        $content = '
        
        {{getRequestQuery}}
        
        $data = $this->model'.$with.$auth.$getRequestQuery.'
        ->orderBy("created_at","desc")
        ->simplePaginate();
        return $this->successData($data);
        ';

        $content =str_replace('{{getRequestQuery}}',$this->requestFieldsTemplate,$content);
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
     *      summary="' . $this->app->table->table_format_name . '详情",
     *      description="' . $this->app->table->table_format_name . '详情信息",
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
    public function getRequestQuery(){

        $query = '';
        /**
         * @var Application $app
         */
        $app = $this->app;

        foreach ($app->struct->struct as $item) {
            if (strstr($item['name'],'name')  || strstr($item['name'],'_no') || !empty($item['enum'])){
                $this->requestFieldsTemplate.= '
       $'.$item['name'].' = $request->input("'.$item['name'].'","");';
                $query.='
                ->when($'.$item['name'].',function ($query)use($'.$item['name'].'){
                $query->where("'.$item['name'].'",$'.$item['name'].');
            })';
            }
        }

        return $query;

    }


}
