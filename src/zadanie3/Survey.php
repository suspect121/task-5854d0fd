<?php

class Survey
{
    private array $questions;

    public function __construct(
        private string $uuid,
        private DateTimeImmutable $start_time,
        private DateTimeImmutable $end_time
    ) {

    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getStartTime(): DateTimeImmutable
    {
        return $this->start_time;
    }

    public function getEndTime(): DateTimeImmutable
    {
        return $this->end_time;
    }

    public function addQuestion(Question $question): void
    {
        $this->questions[] = $question;
    }

    /**
     * @return Question[]
     */
    public function getQuestions(): array
    {
        return $this->questions;
    }
}
