<?php


namespace Model;


use Prooph\EventSourcing\AggregateChanged;

class UserWasCreated extends AggregateChanged
{
    public function username(): string
    {
        return $this->payload['name'];
    }

}
