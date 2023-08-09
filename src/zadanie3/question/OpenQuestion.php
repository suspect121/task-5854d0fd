<?php

require_once __DIR__.'/Question.php';
require_once __DIR__.'/QuestionInterface.php';

/**
 * Reprezentacja pytania otwartego gdzie odpowiedź udzielana jest przez pole typu text
 */
class OpenQuestion extends Question
{
    public function __construct(string $question)
    {
        $this->setQuestion($question);
    }

    public function getResponseMethod(): string
    {
        return 'TEXT';
    }

    public function getResponseOptions(): array
    {
        return [];
    }
}
