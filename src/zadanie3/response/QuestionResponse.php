<?php

/**
 * Reprezentuje odpowiedź użytkownika
 */
class QuestionResponse
{
    public function __construct(
        private string $survey_uuid,
        private string $question_uuid,
        private int|float|string $response_content
    ) {

    }

    public function getSurveyUuid(): Survey
    {
        return $this->survey_uuid;
    }

    public function getQuestionUuid(): Question
    {
        return $this->question_uuid;
    }

    public function getResponseContent(): int|float|string
    {
        return $this->response_content;
    }
}
