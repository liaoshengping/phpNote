<?php
namespace App\Services\AliOpen;

use App\Services\AliOpen\core\ContainerBase;
use App\Services\AliOpen\provider\DiningProvider;

/**
 * Class Application
 * @property \App\Services\AliOpen\functions\Dining dining
 */
class Application extends ContainerBase
{
    /**
     * 服务提供者
     * @var array
     */
    public function __construct($params = array())
    {
//        $this->pushMiddlewares(array(\App\Services\AliOpen\functions\Log::class,'addLog'),'log');

        parent::__construct($params);
    }

    protected $provider = [
      DiningProvider::class,
        //...其他服务提供者
    ];
}
