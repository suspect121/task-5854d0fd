<?php

abstract class Question implements QuestionInterface
{
    private string $uuid;
    private string $question;
    private string $response_method;
    private array $options;

    protected function __construct(string $uuid, string $question, string $response_method, array $options)
    {
        $this->uuid = $uuid;
        $this->question = $question;
        $this->response_method = $response_method;
        $this->options = $options;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function getResponseMethod(): string
    {
        return $this->response_method;
    }

    public function getResponseOptions(): array
    {
        return $this->options;
    }
}
