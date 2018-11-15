<?php

namespace Framework\Event;

use Framework\PerformableInterface;
use Symfony\Component\EventDispatcher\Event;

class AfterTaskEvent extends Event
{
    const NAME = 'testwork.actor.task.after';

    /**
     * @var PerformableInterface
     */
    private $task;

    public function __construct(PerformableInterface $task)
    {
        $this->task = $task;
    }

    public function getTask(): PerformableInterface
    {
        return $this->task;
    }
}