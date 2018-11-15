<?php

namespace Framework;

use Framework\Actor\Actor;
use Symfony\Component\EventDispatcher\EventDispatcher;

class ActorFactory
{
    /**
     * @var EventDispatcher
     */
    private $dispatcher;

    public function __construct(EventDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function create(string $name): Actor
    {
        return new Actor($this->dispatcher, $name);
    }
}