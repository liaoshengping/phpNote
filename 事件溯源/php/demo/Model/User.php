<?php

namespace Model;

use Assert\Assertion;
use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;
use Ramsey\Uuid\Uuid;

class User extends AggregateRoot
{
    /**
     * @var Uuid
     */
    private $uuid;

    /**
     * @var string
     */
    private $name;

    /**
     * ARs should be created via static factory methods
     */
    public static function nameNew(string $username): User
    {
        //Perform assertions before raising a event
        Assertion::notEmpty($username);

        $uuid = Uuid::uuid4();

        //AggregateRoot::__construct is defined as protected so it can be called in a static factory of
        //an extending class
        $instance = new self();

        //Use AggregateRoot::recordThat method to apply a new Event
        $instance->recordThat(UserWasCreated::occur($uuid->toString(), ['name' => $username]));

        return $instance;
    }

    public function userId(): Uuid
    {
        return $this->uuid;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function changeName(string $newName): void
    {
        Assertion::notEmpty($newName);

        if ($newName !== $this->name) {
            $this->recordThat(UserWasRenamed::occur(
                $this->uuid->toString(),
                ['new_name' => $newName, 'old_name' => $this->name]
            ));
        }
    }

    protected function aggregateId(): string
    {
        return $this->uuid->toString();
        // TODO: Implement aggregateId() method.
    }

    protected function apply(AggregateChanged $event): void
    {
        switch (\get_class($event)) {
            case UserWasCreated::class:
                //Simply assign the event payload to the appropriate properties
                $this->uuid = Uuid::fromString($event->aggregateId());
                $this->name = $event->username();
                break;
            case UserWasRenamed::class:
                $this->name = $event->newName();
                break;
        }
    }


}
