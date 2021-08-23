<?php


namespace container\functions\php;


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
        $model  = '\\'.config('model_namespace_path') . '\\' . $this->classModelName;
        $content = '
        $this->model = new '.$model.'();
        ';

        return [
            'document' => '',
            'template' => str_replace('{{content}}', $content, $template),
        ];
    }

    public function buildStoreController()
    {
        $template = '
    /**
     * 获取列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
     public function store(Request $request){
      {{content}}
      }
              ';



        $content = '
        $validate = Validator::make($request->all(), $this->model->rule);

        if (!$validate->passes()) {
            return $this->failure($validate->errors()->first());
        }

        $res = $this->model->save($validate->getData());

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
        $template = '
    /**
     * 获取列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
     public function lists(Request $request){
      {{content}}
      }
              ';

        $with = [];
        $relations = $this->getRelation();
        foreach ($relations as $relation) {

            foreach ($relation['table'] as $item) {
                if (empty($item['list_show'])){
                    continue;
                }
                $with[] = "'".$item['table_name']."'";
            }
        }
        if (!empty($with)) {
            $with = '->with(['.implode(",", $with).'])';
        }


        $content = '
        $data = $this->model{{with}}->simplePaginate();
        return $this->successData($data);
        ';

        $content = str_replace('{{with}}',$with,$content);

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

        $res = $model->update($validate->getData());

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
        $template = '
    /**
     * 获取
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
       {{content}}
    }
              ';


        $with = [];
        $relations = $this->getRelation();
        foreach ($relations as $relation) {

            foreach ($relation['table'] as $item) {
                if (empty($item['one_show'])){
                    continue;
                }
                $with[] = "'".$item['table_name']."'";
            }
        }
        if (!empty($with)) {
            $with = '->with(['.implode(",", $with).'])';
        }
        $content = '
        $keyName = $this->model->getKeyName();

        $id = $request->get($keyName);

        $res = $this->model{{with}}->find((int)$id);

        if ($res) {
            return $this->success($res);
        } else {
            return $this->failure(\'不存在id为：\' . $id);
        }
        ';

        $content = str_replace('{{with}}',$with,$content);



        return [
            'document' => '##获取详情',
            'template' => str_replace('{{content}}', $content, $template),
        ];
    }


}
