<?php

namespace Framework;

use Framework\Actor\ActorInterface;

interface PerformableInterface
{
    public function performAs(ActorInterface $actor): void;
}