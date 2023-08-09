<?php

require __DIR__.'/Survey.php';
require __DIR__.'/question/OneSelectQuestion.php';
require __DIR__.'/question/OpenQuestion.php';
require __DIR__.'/question/RatingQuestion.php';

/*
 * Tworzenie ankiety
 */

$start_time = new DateTimeImmutable('2023-08-09 11:00');
$end_time = new DateTimeImmutable('2023-08-11 17:00');

$survey = new Survey($start_time, $end_time);

$question_1 = new OpenQuestion('Pytanie testowe 1');
$question_2 = new RatingQuestion('Pytanie testowe 2', 1, 10);
$question_3 = new OneSelectQuestion('Pytanie testowe 3', ['Tak', 'Nie']);
$question_4 = new OneSelectQuestion('Pytanie testowe 4', ['Tak', 'Nie', 'Nie wiem']);

$survey->addQuestion($question_1);
$survey->addQuestion($question_2);
$survey->addQuestion($question_3);
$survey->addQuestion($question_4);

/*
 * Późniejsze wykorzystanie po przesłaniu przez API
 */

$start_time = $survey->getStartTime();
$end_time = $survey->getEndTime();
$questions = $survey->getQuestions();

$second_question_data = [
    $questions[1]->getQuestion(),
    $questions[1]->getResponseMethod(),
    $questions[1]->getResponseOptions()
];
