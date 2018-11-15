<?php

namespace Framework\Event;

use Framework\Ability\AbilityInterface;
use Framework\Assert\AssertInterface;
use Symfony\Component\EventDispatcher\Event;

class AfterAssertEvent extends Event
{
    const NAME = 'testwork.actor.assert.after';

    /**
     * @var AssertInterface
     */
    private $assert;

    /**
     * @var bool
     */
    private $success;

    public function __construct(AssertInterface $assert, bool $success)
    {
        $this->assert = $assert;
        $this->success = $success;
    }

    public function getAssert(): AssertInterface
    {
        return $this->assert;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }
}