<?php

namespace Framework\Event;

use Framework\PerformableInterface;
use Symfony\Component\EventDispatcher\Event;

class BeforeActionEvent extends Event
{
    const NAME = 'testwork.actor.action.before';

    /**
     * @var PerformableInterface
     */
    private $action;

    public function __construct(PerformableInterface $action)
    {
        $this->action = $action;
    }

    public function getAction(): PerformableInterface
    {
        return $this->action;
    }
}