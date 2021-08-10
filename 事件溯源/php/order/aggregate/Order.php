<?php

namespace aggregate;

use event\Created;
use model\OrderModel;
use Model\UserWasCreated;
use Prooph\EventSourcing\AggregateRoot;

class Order extends AggregateRoot
{

    private $order_id;

    public static function createOrder()
    {

        $order = new OrderModel();
//        $order->order_id = $this->order_id;

        $instance = new self();

        //Use AggregateRoot::recordThat method to apply a new Event
        $instance->recordThat(Created::occur($order->order_id, ['order' => $order]));

        $instance->order_id = $order->order_id;

        return $instance;

    }

    public function paidOrder()
    {

        $this->recordThat(\event\Paid::occur($this->order_id, ['order' => []]));

    }


    protected function aggregateId(): string
    {
        return $this->order_id;
    }

    protected function apply(\Prooph\EventSourcing\AggregateChanged $event): void
    {
        switch (\get_class($event)) {
            case  Created::class:
                var_dump($event->getObj());exit;
                break;
        }
        // TODO: Implement apply() method.
    }
}
