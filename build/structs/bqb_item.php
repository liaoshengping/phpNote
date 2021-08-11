<?php
    return [
        'status'=>[
            'struct' => 'enums:0.删除,1.待审核,2.正常;type:int;tpValidate:number',
            'filter' => [
                'type' => 'enums',
                'in' => [0,1,2],
                'input_array' => [1=>'待审核',2=>"正常"],
                'ui'=> [
                    'type'=>''
                ]
            ],

        ]
    ];