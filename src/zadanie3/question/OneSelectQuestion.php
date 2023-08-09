<?php

require_once __DIR__.'/Question.php';
require_once __DIR__.'/QuestionInterface.php';

/**
 * Reprezentacja pytania jednokrotnego wyboru gdzie odpowiedź udzielana jest przez pole typu radio
 */
class OneSelectQuestion extends Question
{
    public function __construct(string $question, private array $options)
    {
        if ($options === []) {
            throw new Exception('Nie podano opcji wyboru');
        }
        parent::__construct($question);
    }

    public function getResponseMethod(): string
    {
        return 'RADIO';
    }

    public function getResponseOptions(): array
    {
        return $this->options;
    }
}
