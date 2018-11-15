<?php

namespace Framework\Actor;

use Framework\Ability\AbilityInterface;
use Framework\Assert\AssertInterface;
use Framework\Question\QuestionInterface;

interface ActorInterface
{
    public function attemptsToTaks(...$tasks): void;

    public function attemptsToActions(...$actions): void;

    public function can(AbilityInterface $ability): void;

    public function assertThat(AssertInterface $assert): void;

    public function asksFor(QuestionInterface $question);

    public function ableTo(string $abilityName): AbilityInterface;
}