<?php


namespace Model;


use Prooph\EventSourcing\AggregateChanged;

class UserWasRenamed extends AggregateChanged
{

    public function newName(): string
    {
        return $this->payload['new_name'];
    }

    public function oldName(): string
    {
        return $this->payload['old_name'];
    }

}
