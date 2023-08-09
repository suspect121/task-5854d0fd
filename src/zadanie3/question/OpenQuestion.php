<?php

/**
 * Reprezentacja pytania otwartego gdzie odpowiedź udzielana jest przez pole typu text
 */
class OpenQuestion extends Question
{
    public function __construct(string $uuid, string $question)
    {
        parent::__construct($uuid, $question, 'TEXT', []);
    }
}
