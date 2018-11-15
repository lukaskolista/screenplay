<?php

namespace Framework\Assert;

use Framework\Actor\ActorInterface;

interface AssertInterface
{
    public function checkBy(ActorInterface $actor);
}