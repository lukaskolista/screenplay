<?php

namespace Framework;

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
use Framework\Logger\MessageFactory;
use Psr\Log\LoggerInterface;

class LogListener
{
    public function __construct(MessageFactory $messageFactory, LoggerInterface $logger)
    {
        $this->messageFactory = $messageFactory;
        $this->logger = $logger;
    }

    public function onBeforeTask(BeforeTaskEvent $event): void
    {
        list($message, $context) = $this->messageFactory->createForTask($event->getTask());

        $this->logger->info($message, $context);
    }

    public function onAfterTask(AfterTaskEvent $event): void
    {
        // TODO What to do?
    }

    public function onBeforeAction(BeforeActionEvent $event): void
    {
        list($message, $context) = $this->messageFactory->createForAction($event->getAction());

        $this->logger->info($message, $context);
    }

    public function onAfterAction(AfterActionEvent $event): void
    {
        // TODO What to do?
    }

    public function onBeforeQuestion(BeforeQuestionEvent $event): void
    {
        list($message, $context) = $this->messageFactory->createForQuestion($event->getQuestion());

        $this->logger->info($message, $context);
    }

    public function onAfterQuestion(AfterQuestionEvent $event): void
    {
        $this->logger->info('After question');
    }

    public function onBeforeAbility(BeforeAbilityEvent $event): void
    {
        list($message, $context) = $this->messageFactory->createForAbility($event->getAbility());

        $this->logger->info($message, $context);
    }

    public function onAfterAbility(AfterAbilityEvent $event): void
    {

    }

    public function onBeforeAssert(BeforeAssertEvent $event): void
    {
        list($message, $context) = $this->messageFactory->createForAssert($event->getAssert());

        $this->logger->info($message, $context);
    }

    public function onAfterAssert(AfterAssertEvent $event): void
    {
        $this->logger->info('After assert');
    }
}