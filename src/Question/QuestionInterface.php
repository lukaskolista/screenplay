<?php

namespace Framework\Question;

use Framework\Actor\ActorInterface;

interface QuestionInterface
{
    public function answeredBy(ActorInterface $actor);
}
