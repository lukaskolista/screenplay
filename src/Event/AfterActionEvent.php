<?php

namespace Framework\Event;

use Framework\PerformableInterface;
use Symfony\Component\EventDispatcher\Event;

class AfterActionEvent extends Event
{
    const NAME = 'testwork.actor.action.after';

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