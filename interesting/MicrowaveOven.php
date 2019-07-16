<?php
/**
 * Created by PhpStorm.
 * User: arun
 * Date: 2019-04-30
 * Time: 16:10
 */

/**
 * 厨房用具
 * Interface kitchenWare
 */
interface kitchenWare {

    /**
     * 加工食材
     * @param Food $food
     * @return mixed
     */
    public function process(Food $food);

    /**
     * 是否正在加工
     * @return mixed
     */
    public function hasProcess();
}

/**
 * 微波炉
 * Class MicrowaveOven
 */
class MicrowaveOven implements kitchenWare
{
    /**
     * 是否加热中
     * @var bool
     */
    protected $is_heat = false;

    /**
     * @param Food $food
     * @return mixed|string
     */
    public function process(Food $food)
    {
        if ($this->hasProcess()) {
            return '已有食物在加热，无法打开';
        } else {
            if ($food->hasShuck() || $food->hasPericarp()) {
                return '食物带壳或者带皮，无法进行加热';
            } else {
                $this->is_heat = true;
                return '食物加热中，加热完成即可取出';
            }
        }
    }

    /**
     * 是否正在加工
     * @return bool|mixed
     */
    public function hasProcess()
    {
        return $this->is_heat;
    }
}

/**
 * 烤箱
 * Class Oven
 */
class Oven implements kitchenWare
{
    /**
     * 是否烧烤中
     * @var bool
     */
    protected $is_heat = false;

    /**
     * @param Food $food
     * @return mixed|string
     */
    public function process(Food $food)
    {
        if ($this->is_heat) {
            return '已有食物在烤制，无法打开';
        } else {
            if ($food->hasShuck()) {
                return '食物带壳，无法进行烤制';
            } else {
                $this->is_heat = true;
                return '食物烤制中，完成即可取出';
            }
        }
    }

    /**
     * 是否正在加工
     * @return bool|mixed
     */
    public function hasProcess()
    {
        return $this->is_heat;
    }
}

/**
 * 食物
 * Class Food
 */
class Food
{
    /**
     * 是否带壳
     * @var bool
     */
    protected $is_shuck = false;
    /**
     * 是否带皮
     * @var bool
     */
    protected $is_pericarp = false;

    /**
     * Food constructor.
     * @param bool $is_shuck
     * @param bool $is_pericarp
     */
    public function __construct(bool $is_shuck, bool $is_pericarp)
    {
        $this->is_shuck = $is_shuck;
        $this->is_pericarp = $is_pericarp;
    }

    /**
     * 判断是否带壳
     * @return bool
     */
    public function hasShuck()
    {
        return $this->is_shuck;
    }

    /**
     * 判断是否带皮
     * @return bool
     */
    public function hasPericarp()
    {
        return $this->is_pericarp;
    }
}

/**
 * 烹饪
 * Class Cooking
 */
class Cooking
{
    /**
     * @var kitchenWare
     */
    protected $kitchenWare;

    /**
     * Cook constructor.
     * @param kitchenWare $kitchenWare
     */
    public function __construct(kitchenWare $kitchenWare)
    {
        $this->kitchenWare = $kitchenWare;
    }

    /**
     * 烹饪食物
     * @param Food $food
     * @return mixed
     */
    public function cooking(Food $food)
    {
        $data = $this->kitchenWare->process($food);
        return $data;
    }
}

/**
 * 微波炉加热
 * @return mixed
 */
function test()
{
    $cooking = new Cooking(new MicrowaveOven());
    $food = new Food(false, false);
    $result = $cooking->cooking($food);
    $result2 = $cooking->cooking($food);
    var_dump($result, $result2);
}

/**
 * 烤箱烤制
 * @return mixed
 */
function test2()
{
    $cooking = new Cooking(new Oven());
    $food = new Food(false, true);
    $result =  $cooking->cooking($food);
    $result2 =  $cooking->cooking($food);
    var_dump($result, $result2);
}

/**
 * $order = new Order(new 赊账)
 * $order = new Order(new 线上)
 * $order->create();
 */

test();
test2();
