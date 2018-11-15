<?php

namespace Framework\Logger;

use Framework\Ability\AbilityInterface;
use Framework\Assert\AssertInterface;
use Framework\PerformableInterface;
use Framework\Question\QuestionInterface;

class MessageFactory
{
    public function createForTask(PerformableInterface $task): array
    {
        return [
            get_class($task),
            []
        ];
    }

    public function createForAction(PerformableInterface $action): array
    {
        return [
            get_class($action),
            []
        ];
    }

    public function createForQuestion(QuestionInterface $question): array
    {
        return [
            get_class($question),
            []
        ];
    }

    public function createForAbility(AbilityInterface $ability): array
    {
        return [
            get_class($ability),
            []
        ];
    }

    public function createForAssert(AssertInterface $assert): array
    {
        return [
            get_class($assert),
            []
        ];
    }
}
