<?php
    return [
        'table' =>[
            'status'=>[
                'enums' =>[
                    0=>"待审核",
                    1=>"正常",
                    2=>"禁用",
                ],
                'tpValidate' =>"number",
            ],
        ],
        'select' => [
            'goods'=>function(){

            },
        ]

    ];
