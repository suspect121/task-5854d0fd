<?php

require __DIR__.'/auto_loader.php';

/*
 * Tworzenie ankiety
 */

$start_time = new DateTimeImmutable('2023-08-09 11:00');
$end_time = new DateTimeImmutable('2023-08-11 17:00');

$survey = new Survey('00098999-c672-446f-b77c-c73abb3aed85', $start_time, $end_time);

$question_1 = new OpenQuestion('297a54ad-143f-41b8-874b-f3234d357e16', 'Pytanie testowe 1');
$question_2 = new RatingQuestion('09111894-c8fa-4144-9b8c-5fcbccc3aba4', 'Pytanie testowe 2', 1, 10);
$question_3 = new OneSelectQuestion('2d3fdbc6-3c1f-4a4a-9d7a-1893a7067614', 'Pytanie testowe 3', ['Tak', 'Nie']);
$question_4 = new OneSelectQuestion('6a28d01d-ebae-4adb-aebf-7af3735208d4', 'Pytanie testowe 4', ['Tak', 'Nie', 'Nie wiem']);

$survey->addQuestion($question_1);
$survey->addQuestion($question_2);
$survey->addQuestion($question_3);
$survey->addQuestion($question_4);

$data = serialize($survey);

/*
 * Późniejsze wykorzystanie na frontendzie
 */

$survey = unserialize($data);

$start_time = $survey->getStartTime();
$end_time = $survey->getEndTime();
$questions = $survey->getQuestions();

$second_question_data = [
    $questions[1]->getQuestion(),
    $questions[1]->getResponseMethod(),
    $questions[1]->getResponseOptions()
];

/*
 * Tworzenie odpowiedzi która może zostać wysłana z powrotem do backendu
 */

$response = new QuestionResponse('0ec383b1-a363-4b30-8ae7-998fd6647c10', '6b8cd4b2-fea0-4545-b4ad-246d94dc3550', 'Odpowiedź testowa');
