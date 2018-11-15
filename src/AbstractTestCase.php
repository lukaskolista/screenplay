<?php

namespace Framework;

use Framework\Actor\ActorInterface;

abstract class AbstractTestCase
{
    /**
     * @var ActorFactory
     */
    private $actorFactory;

    public function __construct(ActorFactory $actorFactory)
    {
        $this->actorFactory = $actorFactory;
    }

    protected function createActor(string $name): ActorInterface
    {
        return $this->actorFactory->create($name);
    }
}