<?php


namespace container\functions\php;


trait ControllerTemplateCommon
{

    public function buildStoreController()
    {
        $template = '
             public function store(Request $request, Response $response){
              {{content}}
              }';

        $content = '
            $this->model->save($request->get());
        ';

        return [
            'document' => '����',
            'template' => str_replace('{{content}}', $content, $template),
        ];


    }

    public function buildDelController()
    {

    }

    public function buildListsController()
    {

    }

    public function buildEditController()
    {

    }

    public function buildShowController()
    {

    }

//��׼ģ��
//    public function buildStoreController()
//    {
//        $template = '
//             public function store(Request $request, Response $response){
//              {{content}}
//              }';
//
//        $content = '';
//
//        return str_replace('{{content}}',$content,$template);
//
//
//    }

}
