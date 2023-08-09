<?php

require_once __DIR__.'/QuestionInterface.php';

abstract class Question implements QuestionInterface
{
    private string $question;

    protected function __construct(string $question)
    {
        $this->question = $question;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }
}
