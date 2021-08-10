<?php


namespace repository;


use aggregate\Order;
use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Prooph\EventSourcing\Aggregate\AggregateType;
use Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator;
use Prooph\EventStore\EventStore;

class OrderRepository extends AggregateRepository
{
    public function __construct(EventStore $eventStore)
    {
        //We inject a Prooph\EventSourcing\EventStoreIntegration\AggregateTranslator that can handle our AggregateRoots
        parent::__construct(
            $eventStore,
            AggregateType::fromAggregateRootClass('aggregate\Order'),
            new AggregateTranslator(),
            null, //We don't use a snapshot store in the example
            null, //Also a custom stream name is not required
            true //But we enable the "one-stream-per-aggregate" mode
        );
    }

    public function save(Order $order){
        $this->saveAggregateRoot($order);
    }

}
