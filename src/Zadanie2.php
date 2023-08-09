<?php
/*

Poniższy program wyświetla na ekranie wyniki konkursu dla dzieci. Wyniki są w tablicy quizResults. Zmienna thershold to próg punktowy, który należy osiągnąć by znaleźć się wśród zwycięzców.
W pętli usuwane są rekordy, które nie spełniły tego warunku.
Na końcu wyświetlana jest lista. Pomimo, że program dobrze obliczył liczbę zwycięzców, lista jest pokazywana niepoprawnie:

1) Ania - 75 pkt,
2)  -  pkt,
3)  -  pkt,
4) Kasia - 81 pkt,
5)  -  pkt,
6) Kamil - 63 pkt,

Proszę poprawić program tak, aby podawał właściwe wyniki.

Opis:
Błąd w tym zadaniu polega na tym, że nie wzięto faktu usunięcia pewnej części danych z tablicy $quizResult.
W związku z powyższym, część kluczy już nie istnieje a pętla foreach próbuje się do nich odnosić.
Rozwiązałem ten problem dodając jedynie jedną linię kodu która spowoduje, że klucze będą ponownie po kolei.
Drugie rozwiązanie to zamiana pętli for na foreach jednak chciałem to zrobić minimalistycznie :)

Oprócz odnoszenia się do nieprawidłowych kluczy, brakowało jeszcze sortowania.
Funkcja "usort" rozwiązuje obydwa problemy które istnieją w poniższym kodzie.
Zmienia klucze na nowe licząc od 0 i jednocześnie realizuje sortowanie z użyciem wybranej funkcji.
 */
$quizResults = [
    ["Ania",75],
    ["Piotrek",32],
    ["Asia",43],
    ["Kasia",81],
    ["Bartek",11],
    ["Kamil",63],
    ["Ola",76],
    ["Ludmiła",49],
    ["Tosia",92],
    ["Krzyś",89],
];

$thershold = 50;

$contestantsCount = count($quizResults);
for($n=0; $n<$contestantsCount; $n++) {
    if($quizResults[$n][1] < $thershold) {
        unset($quizResults[$n]);
    }
}

usort($quizResults, 'contestantCmp');

$winnersCount = count($quizResults);
print "Oto lista laureatów konkursu dla dzieci. Należało zdobyć przynajmneij $thershold punktów i warunek spełniło $winnersCount osób. A oto zwycięzcy:\n\n";
for($n=0; $n<$winnersCount; $n++) {
    print ($n+1).") ".$quizResults[$n][0]." - ".$quizResults[$n][1]." pkt,\n";
}

function contestantCmp(array $contestant_1, array $contestant_2)
{
    return strcmp($contestant_2[1], $contestant_1[1]);
}
