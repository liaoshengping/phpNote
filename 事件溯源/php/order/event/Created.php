<?php

namespace event;

use Prooph\EventSourcing\AggregateChanged;

class Created extends AggregateChanged
{
    public function getObj(){

       return $this->payload['order'];

    }
}
