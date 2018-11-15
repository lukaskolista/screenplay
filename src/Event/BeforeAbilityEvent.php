<?php

namespace Framework\Event;

use Framework\Ability\AbilityInterface;
use Symfony\Component\EventDispatcher\Event;

class BeforeAbilityEvent extends Event
{
    const NAME = 'testwork.actor.ability.before';

    /**
     * @var AbilityInterface
     */
    private $ability;

    public function __construct(AbilityInterface $ability)
    {
        $this->ability = $ability;
    }

    public function getAbility(): AbilityInterface
    {
        return $this->ability;
    }
}