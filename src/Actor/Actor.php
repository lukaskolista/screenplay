<?php

namespace Framework\Actor;

use Framework\Ability\AbilityInterface;
use Framework\Assert\AssertInterface;
use Framework\Event\AfterAbilityEvent;
use Framework\Event\AfterActionEvent;
use Framework\Event\AfterAssertEvent;
use Framework\Event\AfterQuestionEvent;
use Framework\Event\AfterTaskEvent;
use Framework\Event\BeforeAbilityEvent;
use Framework\Event\BeforeActionEvent;
use Framework\Event\BeforeAssertEvent;
use Framework\Event\BeforeQuestionEvent;
use Framework\Event\BeforeTaskEvent;
use Framework\PerformableInterface;
use Framework\Question\QuestionInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

class Actor implements ActorInterface
{
    /**
     * @var AbilityInterface[]
     */
    private $abilities = [];

    /**
     * @var EventDispatcher
     */
    private $dispatcher;

    /**
     * @var string
     */
    private $name;

    public function __construct(EventDispatcher $dispatcher,string $name)
    {
        $this->dispatcher = $dispatcher;
        $this->name = $name;
    }

    public function attemptsToTaks(...$tasks): void
    {
        /** @var PerformableInterface $task */
        foreach ($tasks as $task) {
            $this->dispatcher->dispatch(BeforeTaskEvent::NAME, new BeforeTaskEvent($task));
            $task->performAs($this);
            $this->dispatcher->dispatch(AfterTaskEvent::NAME, new AfterTaskEvent($task));
        }
    }

    public function attemptsToActions(...$actions): void
    {
        /** @var PerformableInterface $action */
        foreach ($actions as $action) {
            $this->dispatcher->dispatch(BeforeActionEvent::NAME, new BeforeActionEvent($action));
            $action->performAs($this);
            $this->dispatcher->dispatch(AfterActionEvent::NAME, new AfterActionEvent($action));
        }
    }

    public function asksFor(QuestionInterface $question)
    {
        $this->dispatcher->dispatch(BeforeQuestionEvent::NAME, new BeforeQuestionEvent($question));
        $result = $question->answeredBy($this);
        $this->dispatcher->dispatch(AfterQuestionEvent::NAME, new AfterQuestionEvent($question));

        return $result;
    }

    public function can(AbilityInterface $ability): void
    {
        $this->dispatcher->dispatch(BeforeAbilityEvent::NAME, new BeforeAbilityEvent($ability));
        $this->abilities[$ability->getName()] = $ability;
        $this->dispatcher->dispatch(AfterAbilityEvent::NAME, new AfterAbilityEvent($ability));
    }

    public function ableTo(string $abilityName): AbilityInterface
    {
        return $this->abilities[$abilityName];
    }

    public function assertThat(AssertInterface $assert): void
    {
        $this->dispatcher->dispatch(BeforeAssertEvent::NAME, new BeforeAssertEvent($assert));

        try {
            $assert->checkBy($this);

            $this->dispatcher->dispatch(AfterAssertEvent::NAME, new AfterAssertEvent($assert, true));
        } catch (\Exception $e) {
            $this->dispatcher->dispatch(AfterAssertEvent::NAME, new AfterAssertEvent($assert, false));

            throw $e;
        }
    }
}