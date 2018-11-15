<?php

namespace Framework;

use Framework\Ability\AbilityInterface;
use Framework\Assert\AssertInterface;
use Framework\Logger\MessageFactory;
use Framework\Question\QuestionInterface;
use Psr\Log\LoggerInterface;

class Logger
{
    /**
     * @var MessageFactory
     */
    private $messageFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(MessageFactory $messageFactory, LoggerInterface $logger)
    {
        $this->messageFactory = $messageFactory;
        $this->logger = $logger;
    }

    public function logAction(PerformableInterface $action): void
    {
        list($message, $context) = $this->messageFactory->createForAction($action);

        $this->logger->info($message, $context);
    }

    public function logQuestion(QuestionInterface $question): void
    {
        list($message, $context) = $this->messageFactory->createForQuestion($question);

        $this->logger->info($message, $context);
    }

    public function logAbility(AbilityInterface $ability): void
    {
        list($message, $context) = $this->messageFactory->createForAbility($ability);

        $this->logger->info($message, $context);
    }

    public function logAssert(AssertInterface $assert, bool $success): void
    {
        list($message, $context) = $this->messageFactory->createForAssert($assert);

        if ($success) {
            $this->logger->info($message, $context);
        } else {
            $this->logger->error($message, $context);
        }
    }
}