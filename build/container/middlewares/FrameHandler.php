<?php


namespace container\middlewares;


use container\Application;
use container\interfaces\Middlewares;
use Inhere\Console\Util\Show;

class FrameHandler implements Middlewares
{

    public function handle(Application $app)
    {
        //生成BaseModel
        switch (config('frame')) {
            case THINKPHP:
                break;
            case GOLANG;
                break;
            case LARAVEL:
                break;
            case HTMLV1:
                break;
            case HUAFEI:
                break;
            default:
                throw new \Exception('没有配置 该框架的配置' . config('frame'));
                break;
        }

        Show::block("加载框架配置成功");

        $app->frame = config('frame');


    }
}
