<?php

require_once __DIR__.'/QuestionInterface.php';

abstract class Question implements QuestionInterface
{
    private string $question;

    public function getQuestion(): string
    {
        return $this->question;
    }

    protected function setQuestion(string $question): void
    {
        $this->question = $question;
    }
}
