<?php

require_once __DIR__.'/Question.php';
require_once __DIR__.'/QuestionInterface.php';

/**
 * Reprezentacja pytania którego oczekiwaną odpowiedzią jest ocena
 */
class RatingQuestion extends Question
{
    public function __construct(string $question, private int $min_rate, private int $max_rate)
    {
        $this->setQuestion($question);
    }

    public function getResponseMethod(): string
    {
        return 'SELECT';
    }

    public function getResponseOptions(): array
    {
        $options = [];
        for ($i = $this->min_rate; $i <= $this->max_rate; $i++) {
            $options[] = $i;
        }
        return $options;
    }
}
