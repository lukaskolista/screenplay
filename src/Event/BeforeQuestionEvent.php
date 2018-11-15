<?php

namespace Framework\Event;

use Framework\Question\QuestionInterface;
use Symfony\Component\EventDispatcher\Event;

class BeforeQuestionEvent extends Event
{
    const NAME = 'testwork.actor.question.before';

    /**
     * @var QuestionInterface
     */
    private $question;

    public function __construct(QuestionInterface $question)
    {
        $this->question = $question;
    }

    public function getQuestion(): QuestionInterface
    {
        return $this->question;
    }
}