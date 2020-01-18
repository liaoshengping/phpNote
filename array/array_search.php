<?php
require_once ("../vendor/autoload.php");
use Crasphb\Pagination;
$target = [
    [
        'id'=>1,
        'status'=>3
        ],
    [
        'id'=>2,
        'status'=>1
    ],
    [
        'id'=>3,
        'status'=>2
    ],
    [
        'id'=>4,
        'status'=>1
    ],
    [
        'id'=>5,
        'status'=>1
    ],
    [
        'id'=>6,
        'status'=>1
    ],

];


class ArraySearch{
    public $where=[];
    public $orWhere=[];
    public $page=1;
    public $pageSize=2;
    public $resArray = array();//查询的结果
    public $arrayData;//最开始的数组，二维数组
    public $whereIn = array();

    public function arrayData(array $arrayData){
        $this->arrayData = $arrayData;
        return $this;
    }
    /**
     *
     * @param array $where ['status'=>1,'status'=>2,'id'=>'1']
     * @return $this
     */
    public function where(array $where){
        $this->where = array_merge($where,$this->where);
        return $this;
    }

    public function orWhere(array $where){
        $this->orWhere = array_merge($where,$this->orWhere);
        return $this;
    }

    /**
     * @param array $where ['status'=>[1,2,3]]
     * @return $this
     */
    public function whereIn(array $where){
        $this->whereIn = array_merge($where,$this->whereIn);
        return $this;
    }

    public function get(){
        $this->common();

        return $this->arrayData;
    }

    public function paginate($page=1){
        $this->common();
         $obj =new Pagination($this->arrayData,$this->pageSize,['style' => 1,'simple'=>false,'allCounts'=>true,'nowAllPage'=>true,'toPage'=>true]);
         $obj->pageNow = $page;
         $this->arrayData =$obj->getItem();
        return $this->arrayData;
    }

    protected function common(){
        if(empty($this->arrayData)){
            throw new \Exception('数据为空，请调用arrayData 方法初始化数据');
        }
        if(!empty($this->where)){
            $this->arrayData = array_filter($this->arrayData, function($var){
                $bool = true;
                foreach ($this->where as $key=>$orwehre){
                    if($var[$key] != $orwehre){
                        $bool = false;
                    }
                }
                return $bool;
            });
        }
        if(!empty($this->whereIn)){
            $this->arrayData = array_filter( $this->arrayData, function($var){
                $bool = false;
                foreach ($this->whereIn as $key=>$orwehre){
                    if( in_array($var[$key],$orwehre)){
                        return true;
                        break;
                    }
                }
                return $bool;
            });
        }
        if(!empty($this->orWhere)){
            $this->arrayData = array_filter( $this->arrayData, function($var){
                $bool = false;
                foreach ($this->orWhere as $key=>$orwehre){
                    if($var[$key] == $orwehre){
                        return true;
                        break;
                    }
                }
                return $bool;
            });
        }
//        shuffle($this->arrayData);
    }
}

//$pagination = new Pagination($target,2,['style' => 1,'simple'=>false,'allCounts'=>true,'nowAllPage'=>true,'toPage'=>true]);

$obj = new ArraySearch();

$data = $obj->arrayData($target)->whereIn(['status'=>[1]])->paginate();



var_dump($data);







