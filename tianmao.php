<?php
include ("vendor/autoload.php");

$clinet = new \GuzzleHttp\Client();
//cookie :2021Äê4ÔÂ25ÈÕ 14:22:59
//
//$res =$clinet->request('GET','',[
//    'headers' => [
//        'Referer' =>'https://detail.tmall.com/',
//        'Sec-Fetch-Mode' => 'no-cors',
//        'Accept'=>'application/json, text/plain, */*',
//        'Accept-Language' => 'zh-CN,zh;q=0.3',
//        'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36',
//        'Connection' => 'keep-alive',
////        'cookie' => 'enc=IL6ZEismpZ2lJ9e%2BdB%2BBABJ7l97QGAyOZrYt4oOxIgzwgJGxKI1I9p0KuW%2Flmonr4veG21kz7KYE4h5SVcoHPg%3D%3D; miid=196938801029366500; tracknick=%5Cu4FE1%5Cu7528%5Cu7B2C%5Cu4E00%5Cu6B66%5Cu5E73; t=d51daaa242aa582ffec49f3c7dbd0360; lgc=%5Cu4FE1%5Cu7528%5Cu7B2C%5Cu4E00%5Cu6B66%5Cu5E73; sgcookie=E100ufWOojxoSNRxcapDPP6gp4EY0uEJ8NtrsxNEJIcLrn83JjhFUxvaMvJywhuUWGxYW9ldkNWABz%2BYPeWl8D%2Fq0g%3D%3D; uc3=id2=VAmv1GokeHYu&vt3=F8dCuwpicIRioKkdmO0%3D&lg2=U%2BGCWk%2F75gdr5Q%3D%3D&nk2=s02FndleiZJjxtqR; uc4=id4=0%40VhCUR%2FJjObMGSORrIOwVPFSDIM0%3D&nk4=0%40sTKW7aCkbPBZ%2BbQMF9Jm%2BL%2Bnr0c55nA%3D; _cc_=Vq8l%2BKCLiw%3D%3D; mt=ci=-1_0; cookie2=1b9697a8c31c6fe4db712e3e45812eee; _tb_token_=3b65baf05013e; _m_h5_tk=0d6141c70866d6fa588fc7e254569aa3_1619322716194; _m_h5_tk_enc=197a99914446b8290b50ee47d8476cab; xlly_s=1; uc1=cookie14=Uoe1i6xPi7DBBA%3D%3D; hng=CN%7Czh-CN%7CCNY%7C156; _samesite_flag_=true; x5sec=7b226d616c6c64657461696c736b69703b32223a223038303861303334633764663261333063323732363736393130383763326234434a364c6c4951474550372f3537655537635441564367434d50793279593043227d; isg=BH5-hMu_kqwBVsZzYtviKO9cz5TAv0I5t4FfRSiHK0G8yxylkE_ZSUXqQ5cHdzpR'
//    ],
//]);
//
//var_dump($res->getHeaders());exit;
//
//






//https://blog.csdn.net/lipachong/article/details/103841458

$clinet = new \GuzzleHttp\Client();

$res =$clinet->request("GET",'https://mdskip.taobao.com/core/initItemDetail.htm?id=620625588435',[
        'headers' => [
            'Referer' =>'https://detail.tmall.com/',
            'Sec-Fetch-Mode' => 'no-cors',
            'Accept'=>'application/json, text/plain, */*',
            'Accept-Language' => 'zh-CN,zh;q=0.3',
            'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36',
            'Connection' => 'keep-alive',
            'cookie' => '_samesite_flag_=true; cookie2=1043e209b0299ee0b6c6a0b4370ae03d; t=95328ddcd9f4484cdfab82d12412315a; _tb_token_=f3e7b0377340b; sgcookie=E100UUpaPViVuMMinq0YZIT71zqG028iwJywEaVNLqot8D8LPta8hsR%2F5GTp6%2FncGObXC4v%2Bqo5m1l5Ead%2BIsxWlMg%3D%3D; unb=785986666; uc1=cookie16=UtASsssmPlP%2Ff1IHDsDaPRu%2BPw%3D%3D&cookie14=Uoe1i6xNASn59w%3D%3D&cookie21=WqG3DMC9Edo1SB5NB6Qtng%3D%3D&existShop=true&cookie15=VFC%2FuZ9ayeYq2g%3D%3D&pas=0; uc3=nk2=s02FndleiZJjxtqR&id2=VAmv1GokeHYu&vt3=F8dCuwpvQOK7KIqX34w%3D&lg2=UtASsssmOIJ0bQ%3D%3D; csg=006a8f29; lgc=%5Cu4FE1%5Cu7528%5Cu7B2C%5Cu4E00%5Cu6B66%5Cu5E73; cookie17=VAmv1GokeHYu; dnk=%5Cu4FE1%5Cu7528%5Cu7B2C%5Cu4E00%5Cu6B66%5Cu5E73; skt=df6b360caba87a45; existShop=MTYxOTMzMTUwOA%3D%3D; uc4=id4=0%40VhCUR%2FJjObMGSORrIO304cpUPW0%3D&nk4=0%40sTKW7aCkbPBZ%2BbQMF9Jm%2BL4XUy8HHBw%3D; tracknick=%5Cu4FE1%5Cu7528%5Cu7B2C%5Cu4E00%5Cu6B66%5Cu5E73; _cc_=URm48syIZQ%3D%3D; _l_g_=Ug%3D%3D; sg=%E5%B9%B369; _nk_=%5Cu4FE1%5Cu7528%5Cu7B2C%5Cu4E00%5Cu6B66%5Cu5E73; cookie1=W8mGyPXYpT%2BRFf8bHo9M5BcVxjdp92tTJkBM8%2BvG%2FNg%3D; enc=tq5a1Wk69WLtSe4%2BjcO0BaIEg4LPAn7bbqyR00MKSq%2FGKi4B46H8%2FeQG7LRw9gP%2FyzOoSROd1KnEwFo5qAQW%2FA%3D%3D; x5sec=7b226d616c6c64657461696c736b69703b32223a223338336662383866633366373233623331636466353130373338313462356635435043546c495147454b2f71736361306e4e6e484c426f4c4e7a67314f5467324e6a59324f7a456f416a443874736d4e41673d3d227d; isg=BC0t-fTsMQlRbNUe5c4hbaDxPMmnimFciLxsaG8yIkQz5kyYN9o9LKX30LoA4nkU'
        ],
]);

//var_dump($res->getBody()->getContents());exit;
file_put_contents('json.json',$res->getBody()->getContents());
