<?php

namespace Framework\Event;

use Framework\Ability\AbilityInterface;
use Framework\Assert\AssertInterface;
use Symfony\Component\EventDispatcher\Event;

class BeforeAssertEvent extends Event
{
    const NAME = 'testwork.actor.assert.before';

    /**
     * @var AssertInterface
     */
    private $assert;

    public function __construct(AssertInterface $assert)
    {
        $this->assert = $assert;
    }

    public function getAssert(): AssertInterface
    {
        return $this->assert;
    }
}