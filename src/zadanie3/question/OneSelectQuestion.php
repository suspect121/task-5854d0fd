<?php

/**
 * Reprezentacja pytania jednokrotnego wyboru gdzie odpowiedź udzielana jest przez pole typu radio
 */
class OneSelectQuestion extends Question
{
    public function __construct(string $uuid, string $question, array $options)
    {
        if ($options === []) {
            throw new Exception('Nie podano opcji wyboru');
        }
        parent::__construct($uuid, $question, 'RADIO', $options);
    }
}
