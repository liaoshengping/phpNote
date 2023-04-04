<?php

namespace container\functions\php\laravel;

use Inhere\Console\Util\Show;

trait RelationBuildByTable
{
    /**
     * 生成
     */
    public function generateRelation(){

        $relationResult = '';
        foreach ($this->app->struct->struct as $item){

            if (empty($item['relation'])){
                continue;
            }

            foreach ($item['relation'] as $ormRelationStr => $tableRelationArr){

                foreach ($tableRelationArr as $tableRelation) {

                    $tableName = $tableRelation['table_name'];

                    $str = ucwords(str_replace("_", " ", $tableName));
                    $ModelClass = str_replace(" ", "",$str);
                    $relationName = camel_case($tableName);
                    $function = $ormRelationStr.'Relation';

                    if (!method_exists($this,$function)){
                        throw new \Exception('不存在'.$ormRelationStr);
                    }

                    //判断关联的模型存不存在

                    $frame_mode_path =config('frame_mode_path').$ModelClass.'.php';

                    if (!is_file($frame_mode_path)){
                        Show::error('搞什么，关联的模型不存在，先去生成模型去吧'.$frame_mode_path, 'error', 'error');
                    }

                    $relationResult.= $this->$function($ModelClass,$relationName,$tableRelation);

                }

            }

//            $this->app->phpcommon->getPergByRule('')

        }

        return $relationResult;
    }

    public function hasManyRelation($ModelClass,$relationName,$structInfo){
        $foreignKey = $structInfo['table_name'].'_id';
        $ownerKey = 'id';

        if (!empty($structInfo['params'][1])){
            $foreignKey = $structInfo['params'][1];
        }
        if (!empty($structInfo['params'][0])){
            $ownerKey = $structInfo['params'][0];
        }


        $temp = '
            public function '.$relationName.'(){
                return $this->hasMany(\\'.config('model_namespace_path').'\\'.$ModelClass.'::class,"'.$foreignKey.'","'.$ownerKey.'");
            }
        ';

        return $temp;
    }
    public function hasOneRelation($ModelClass,$relationName,$structInfo){
        $foreignKey = $structInfo['table_name'].'_id';
        $ownerKey = 'id';

        if (!empty($structInfo['params'][1])){
            $foreignKey = $structInfo['params'][1];
        }
        if (!empty($structInfo['params'][0])){
            $ownerKey = $structInfo['params'][0];
        }


        $temp = '
            public function '.$relationName.'(){
                return $this->hasOne(\\'.config('model_namespace_path').'\\'.$ModelClass.'::class,"'.$foreignKey.'","'.$ownerKey.'");
            }
        ';

        return $temp;
    }
    public function belongsToRelation($ModelClass,$relationName,$structInfo){

        $foreignKey = $structInfo['table_name'].'_id';
        $ownerKey = 'id';

        if (!empty($structInfo['params'][0])){
            $foreignKey = $structInfo['params'][0];
        }
        if (!empty($structInfo['params'][1])){
            $ownerKey = $structInfo['params'][1];
        }


        $temp = '
            public function '.$relationName.'(){
                return $this->belongsTo(\\'.config('model_namespace_path').'\\'.$ModelClass.'::class,"'.$foreignKey.'","'.$ownerKey.'");
            }
        ';

        return $temp;

    }
}