<?php

require __DIR__.'/question/OneSelectQuestion.php';
require __DIR__.'/question/OpenQuestion.php';
require __DIR__.'/question/RatingQuestion.php';

$question_1 = new OpenQuestion('Pytanie testowe 1');

$question_2 = new RatingQuestion('Pytanie testowe 2', 1, 10);

$question_3 = new OneSelectQuestion('Pytanie testowe 3', ['Tak', 'Nie']);

$question_4 = new OneSelectQuestion('Pytanie testowe 4', ['Tak', 'Nie', 'Nie wiem']);
