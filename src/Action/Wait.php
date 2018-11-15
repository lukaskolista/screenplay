<?php

namespace Framework\Action;

use Framework\Ability\BrowseWebsite;
use Framework\Actor\ActorInterface;
use Framework\PerformableInterface;

class Wait implements PerformableInterface
{
    /**
     * @var int
     */
    private $time;

    public function __construct(int $time)
    {
        $this->time = $time;
    }

    public function performAs(ActorInterface $actor): void
    {
        sleep($this->time);
    }
}