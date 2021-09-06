<?php


namespace container\functions\php;


use container\Application;
use container\functions\Struct;

trait ControllerTemplateCommon
{


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
        /**
         * @var Application $this ->app
         */
        $api_prefix = config('api_prefix');

        $template = '
    /**
     * @OA\Post(
     *      path="/' . $api_prefix . '/' . $this->app->table->table_name . '/store",
     *      operationId="' . $api_prefix . '/' . $this->app->table->table_name . '/store",
     *      tags={"' . $this->app->table->table_format_name . '"},
     *      summary="' . $this->app->table->table_format_name . '创建",
     *      description="' . $this->app->table->table_format_name . '提交创建",
{{request}}
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
     public function store(Request $request){
      {{content}}
      }
              ';

        $requestJson = '     *     @OA\RequestBody(
     *         description="order placed for purchasing th pet",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/' . $this->app->{$this->app->frame}->classModelName . '")
     *     ),';
        $requestForm = '';
        $config = $this->getCurrentSetting();
        $request_method = $config['request_method'] ?? '';
        if ($request_method != 'json') {
            /**
             * @var Struct
             */
            foreach ($this->app->struct->struct as $item) {
                if (in_array($item['name'], array_merge($this->hiddenProperties, config('create_exclude_fields') ?? []))) continue;

                $requestForm .= '
     *      @OA\Parameter(
     *          name="' . $item["name"] . '",
     *          description="' . $item["comment"] . '",
     *          required=false,
     *          in="query",
     *      ),';

//     *          @OA\Schema(
//     *             type="array",
//     *             default="available",
//     *             @OA\Items(
//     *                 type="string",
//     *                 enum = {"available", "pending", "sold"},
//     *             )
//     *          )
            }
            $template = str_replace('{{request}}', $requestForm, $template);
        } else {
            $template = str_replace('{{request}}', $requestJson, $template);
        }

        $content = '
        $validate = Validator::make($request->all(), $this->model->rule);

        if (!$validate->passes()) {
            return $this->failure($validate->errors()->first());
        }

        $res = $this->model->create($validate->getData());

        if ($res) {
            return $this->success($res);
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
            return $this->success($res);
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
        $api_prefix = config('api_prefix');
        $template = '
    /**
     * @OA\Get(
     *      path="/' . $api_prefix . '/' . $this->app->table->table_name . '/lists",
     *      operationId="' . $api_prefix . '/' . $this->app->table->table_name . '/lists",
     *      tags={"' . $this->app->table->table_format_name . '"},
     *      summary="' . $this->app->table->table_format_name . '列表",
     *      description="' . $this->app->table->table_format_name . '分页列表",
{{request}}
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/' . $this->app->{$this->app->frame}->classModelName . '"),
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
     public function lists(Request $request){
      {{content}}
      }
              ';
        $requestForm = '
     *      @OA\Parameter(
     *          name="page",
     *          description="分页",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="pageSize",
     *          description="每页数量",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),';
        /**
         * @var Struct
         */
        foreach ($this->app->struct->struct as $item) {
            if (in_array($item['name'], array_merge($this->hiddenProperties, config('create_exclude_fields') ?? []))) continue;

//            判断是否有枚举

            $requestForm .= '
     *      @OA\Parameter(
     *          name="' . $item["name"] . '",
     *          description="' . $item["comment"] . '",
     *          required=false,
     *          in="query",
     *      ),';

//     *          @OA\Schema(
//     *             type="array",
//     *             default="available",
//     *             @OA\Items(
//     *                 type="string",
//     *                 enum = {"available", "pending", "sold"},
//     *             )
//     *          )
        }
        $template = str_replace('{{request}}', $requestForm, $template);

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
            $with = '->with([' . implode(",", $with) . '])';
        } else {
            $with = '';
        }


        $content = '
        $data = $this->model{{with}}->simplePaginate();
        return $this->successData($data);
        ';

        $content = str_replace('{{with}}', $with, $content);

        return [
            'document' => '列表文档',
            'template' => str_replace('{{content}}', $content, $template),
        ];
    }

    public function buildEditController()
    {
        $template = '
     /**
     * 编辑
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
     public function edit(Request $request){
      {{content}}
      }
              ';

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

        $res = $model->update($this->model->fillableFromArray($validate->getData()));

        if ($res) {
            return $this->success($res);
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
        $template = '
    /**
     * @OA\Get(
     *      path="/' . $api_prefix . '/' . $this->app->table->table_name . '/show",
     *      operationId="' . $api_prefix . '/' . $this->app->table->table_name . '/show",
     *      tags={"' . $this->app->table->table_format_name . '"},
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
            return $this->success($res);
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


}
