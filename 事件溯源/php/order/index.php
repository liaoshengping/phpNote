<?php

use Prooph\Common\Event\ActionEvent;
use Prooph\Common\Event\ProophActionEventEmitter;
use Prooph\EventStore\InMemoryEventStore;
use Prooph\EventStore\TransactionalActionEventEmitterEventStore;
use repository\OrderRepository;


require_once __DIR__ . '/../../../vendor/autoload.php';
include('Loder.php');

$eventStore = new TransactionalActionEventEmitterEventStore(
    new InMemoryEventStore(),
    new ProophActionEventEmitter()
);

//Now we set up our user repository and inject the EventStore
//Normally this should be done in an IoC-Container and the receiver of the repository should require My\Model\UserRepository
$orderRepository = new OrderRepository($eventStore);

//Ok lets start a new transaction and create a user
$eventStore->beginTransaction();

$order = \aggregate\Order::createOrder();

$eventStore->attach(
    TransactionalActionEventEmitterEventStore::EVENT_CREATE,
    function (ActionEvent $event): void {
        foreach ($event->getParam('stream')->streamEvents() as $streamEvent) {
            echo \sprintf(
                    'Event with name %s was recorded. It occurred on %s UTC /// ',
                    $streamEvent->messageName(),
                    $streamEvent->createdAt()->format('Y-m-d H:i:s')
                ) . PHP_EOL;
        }
    },
    -1000
);

$orderRepository->save($order);
//
//$eventStore->commit();
