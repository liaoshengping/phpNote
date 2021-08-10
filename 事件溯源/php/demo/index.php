<?php

use Infrastructure\UserRepositoryImpl;
use Model\User;
use Prooph\Common\Event\ActionEvent;
use Prooph\Common\Event\ProophActionEventEmitter;
use Prooph\EventStore\InMemoryEventStore;
use Prooph\EventStore\TransactionalActionEventEmitterEventStore;


require_once __DIR__ . '/../../../vendor/autoload.php';
include('Loder.php');

$eventStore = new TransactionalActionEventEmitterEventStore(
    new InMemoryEventStore(),
    new ProophActionEventEmitter()
);

//Now we set up our user repository and inject the EventStore
//Normally this should be done in an IoC-Container and the receiver of the repository should require My\Model\UserRepository
$userRepository = new UserRepositoryImpl($eventStore);

//Ok lets start a new transaction and create a user
$eventStore->beginTransaction();

$user = User::nameNew('John Doe');

//Before we save let's attach a listener to check that the UserWasCreated event is recorded
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

$userRepository->save($user);

//Let's make sure the transaction is written
$eventStore->attach(
    TransactionalActionEventEmitterEventStore::EVENT_COMMIT,
    function (ActionEvent $event): void {
        echo 'Transaction commited' . PHP_EOL;
    },
    -1000
);

$eventStore->commit();

$userId = $user->userId();

unset($user);

//Ok, great. Now let's see how we can grab the user from the repository and change the name

//First we need to start a new transaction
$eventStore->beginTransaction();

//The repository automatically tracks changes of the user...
$loadedUser = $userRepository->get($userId);


$loadedUser->changeName('Max Mustermann');

//Before we save let's attach a listener again on appendTo to check that the UserWasRenamed event is recorded
$eventStore->attach(
    TransactionalActionEventEmitterEventStore::EVENT_APPEND_TO,
    function (ActionEvent $event): void {
        foreach ($event->getParam('streamEvents') as $streamEvent) {
            echo \sprintf(
                    'Event with name %s was recorded. It occurred on %s UTC /// ',
                    $streamEvent->messageName(),
                    $streamEvent->createdAt()->format('Y-m-d H:i:s')
                ) . PHP_EOL;
        }
    },
    -1000
);

$userRepository->save($loadedUser);

//... so we only need to commit the transaction and the UserWasRenamed event should be recorded
//(check output of the previously attached listener)
$eventStore->commit();
