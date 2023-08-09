<?php

/**
 * Interfejs który powinny implementować wszystkie klasy reprezentujące pytanie
 */
interface QuestionInterface
{
    /**
     * Zwraca treść pytania
     *
     * @return string
     */
    public function getQuestion(): string;

    /**
     * Zwraca typ pola który ma zostać użyty do odpowiedzi na pytanie
     *
     * @return string
     *         TEXT - brak opcji wyboru, odpowiedź przez pole typu text
     *         SELECT - wybór odpowiedzi przez pole typu select
     *         RADIO - wybór odpowiedzi przez pole typu radio
     */
    public function getResponseMethod(): string;

    /**
     * Zwraca możliwe opcje wyboru (jedynie dla pytań zamkniętych)
     *
     * Jeżeli pytanie jest otwarte, zwracana jest pusta tablica.
     *
     * @return array
     */
    public function getResponseOptions(): array;
}
