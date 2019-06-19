<?php
/*

 * yield 异步操作结合同步业务代码例子

 * @author Corz*/

//业务同步代码

function syncCode()

{

    var_dump((yield ['dns', 'www.baidu.com']));

    var_dump((yield ['lag', 200]));

    var_dump((yield ['dns', 'www.taobao.com']));

    var_dump((yield ['sql', 'show tables']));

}

//异步调用器

function asyncCaller(Generator $gen)

{

    $r = $gen->current();

    if (isset($r)) {

        switch ($r[0]) {

            case 'sql':

                AsyncMysql::getInstance()->query($r[1],

                    function ($retval) use($gen) {

                        $gen->send($retval);

                        asyncCaller($gen);

                    });

                break;

            case 'dns':

                swoole_async_dns_lookup($r[1],

                    function ($host, $ip) use($gen) {

                        $gen->send([$host, $ip]);

                        asyncCaller($gen);

                    });

                break;

            case 'lag':

                swoole_timer_after($r[1],

                    function () use($gen, $r) {

                        $gen->send('lag ' . $r[1] . 'ms');

                        asyncCaller($gen);

                    });

                break;

            default:

                $gen->send('no method');

                asyncCaller($gen);

                break;

        }

    }

}



asyncCaller(syncCode());



/**

 * 异步mysql类

 */

class AsyncMysql

{



    /**

     * @var mysqli

     */

    protected $db = null;



    /**

     * @var callable

     */

    protected $callable = null;



    public static function getInstance()

    {

        static $instance = null;

        return isset($instance) ? $instance : ($instance = new self());

    }



    public function __construct()

    {

        $this->db = new mysqli('127.0.0.1', 'root', '123456', 'mysql');

        swoole_event_add(swoole_get_mysqli_sock($this->db), [$this, 'onQuery']);

    }



    public function onQuery($db_sock)

    {

        $res = $this->db->reap_async_query();

        call_user_func($this->callable, $res->fetch_all(MYSQLI_ASSOC));

    }



    /**

     * @param string    $sql

     * @param callable  $callable

     */

    public function query($sql, callable $callable)

    {

        $this->callable = $callable;

        $this->db->query($sql, MYSQLI_ASYNC);

    }

}
