<?php


namespace container\functions\php;


use container\Application;
use container\functions\Struct;

/**
 * 生成备注
 * Trait RequestForm
 * @package container\functions\php
 */
trait RequestForm
{

    /**
     * 更具场景获取备注
     * @param $scence
     * create,list,edit
     */
    public function getRequestFormByScence($scence)
    {
        $requestForm = '';

        //如果更新，需要添加id
        if ($scence == 'edit') {
            /**
             * @var Application $app
             */
            $app = $this->app;
            $pk = $app->table->pk;
            $requestForm .= '
     *      @OA\Parameter(
     *          name="' . $pk . '",
     *          description="索引",
     *          required=true,
     *          in="query",
     *      ),';
        }


        $store_input = $this->getInputByScence($scence);
        /**
         * @var Struct
         */

        foreach ($this->app->struct->struct as $item) {

            if (!in_array($item['name'], $store_input) && !empty($store_input)) continue;

            if (in_array($item['name'], array_merge($this->hiddenProperties, config('create_exclude_fields') ?? []))) continue;

            $remark_list = '';

            if ($scence =='list'){
                $remark_list = ';如果要获取多个状态的值可传递用,逗号隔开的字符串传递 比如：1,2';
            }

            if (!empty($item['enum'])) {
                //如果有枚举
                $default = $item['default'];
                $enum_json = json_encode(array_keys($item['enum']));
                $enum_json = str_replace('[', '{', $enum_json);
                $enum_json = str_replace(']', '}', $enum_json);

                $requestForm .= '
     *         @OA\Parameter(
     *         name="' . $item['name'] . '",
     *         in="query",
     *         description="' . $item['origin_comment'] . $remark_list.'",
     *         explode=true,
     *         @OA\Schema(
     *             type="array",
     *             default="' . $default . '",
     *             @OA\Items(
     *                 type="string",
     *                 enum = ' . $enum_json . ',
     *             )
     *         )
     *     ),';

            } else {
                $requestForm .= '
     *      @OA\Parameter(
     *          name="' . $item["name"] . '",
     *          description="' . $item["comment"] . '",
     *          required=false,
     *          in="query",
     *      ),';

            }
        }



        return $requestForm;

    }

    /**
     * 新增接口的备注
     */
    public function getStoreNote()
    {
        $api_prefix = config('api_prefix');
        $tags = $this->getThisTags();

        $template = '
    /**
     * @OA\Post(
     *      path="/' . $api_prefix . '/' . $this->app->table->table_name . '/store",
     *      operationId="' . $api_prefix . '/' . $this->app->table->table_name . '/store",
     *      tags={"' . $tags . '"},
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

        return $template;


    }

    /**
     * 新增接口的备注
     */
    public function getListNote()
    {
        $api_prefix = config('api_prefix');
        $tags = $this->getThisTags();

        $template = '
    /**
     * @OA\GET(
     *      path="/' . $api_prefix . '/' . $this->app->table->table_name . '/lists",
     *      operationId="' . $api_prefix . '/' . $this->app->table->table_name . '/lists",
     *      tags={"' . $tags . '"},
     *      summary="' . $this->app->table->table_format_name . '列表",
     *      description="' . $this->app->table->table_format_name . '列表，数组",
{{request}}
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/' . $this->app->{$this->app->frame}->classModelName . '")
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

        return $template;


    }


    /**
     * 新增接口的备注
     */
    public function getEditNote()
    {
        $api_prefix = config('api_prefix');
        $tags = $this->getThisTags();

        $template = '
    /**
     * @OA\Post(
     *      path="/' . $api_prefix . '/' . $this->app->table->table_name . '/edit",
     *      operationId="' . $api_prefix . '/' . $this->app->table->table_name . '/edit",
     *      tags={"' . $tags . '"},
     *      summary="' . $this->app->table->table_format_name . '更新",
     *      description="' . $this->app->table->table_format_name . '提交更新",
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
     public function edit(Request $request){
      {{content}}
      }
              ';

        return $template;


    }
}
