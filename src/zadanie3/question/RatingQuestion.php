<?php

/**
 * Reprezentacja pytania którego oczekiwaną odpowiedzią jest ocena
 */
class RatingQuestion extends Question
{
    public function __construct(string $uuid, string $question, int $min_rate, int $max_rate)
    {
        if ($max_rate <= $min_rate) {
            throw new Exception('Nieprawidłowy zakres oceny');
        }
        $options = $this->createOptions($min_rate, $max_rate);
        parent::__construct($uuid, $question, 'SELECT', $options);
    }

    private function createOptions(int $min_rate, int $max_rate): array
    {
        $options = [];
        for ($i = $min_rate; $i <= $max_rate; $i++) {
            $options[] = $i;
        }
        return $options;
    }
}
