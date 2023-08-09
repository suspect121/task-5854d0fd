<?php
/*
Poniżej znajduje się krótki fragment kodu. Definiuje on klasy z pracownikami pewnej firmy oraz tworzy obiekty. Gdy zostanie uruchomiony zobaczmy output:

Stworzono pracownika: 1	Jan Kowalski	 | Warszawa, ul. Pierwsza 11, pok. 876	 tel: 22 555 666
Stworzono pracownika: 2	Tomasz Nowak	 | Kraków, ul. Ostatnia 42C, pok. 315B	 tel: 12 222 333
Stworzono pracownika: 3	Karol Kowal	 | Kraków, ul. Ostatnia 42C, pok. 210	 tel: 12 333 444
Stworzono pracownika: 4	Łukasz Mak	 | Kraków, ul. Ostatnia 42C, pok. 12A	 tel: 12 000 001

Lista pracowników:
1	Jan Kowalski	 | Warszawa, ul. Pierwsza 11, pok. 876	 tel: 22 555 666
2	Tomasz Nowak	 | Kraków, ul. Ostatnia 42C, pok. 12A	 tel: 12 000 001
3	Karol Kowal	 | Kraków, ul. Ostatnia 42C, pok. 12A	 tel: 12 000 001
4	Łukasz Mak	 | Kraków, ul. Ostatnia 42C, pok. 12A	 tel: 12 000 001

Jak widać podczas tworzenia pracowników wszstko wygląda dobrze, jednak gdy wyświetlamy listę okazuje się, że część pracowników ma taki sam numer pokoju oraz numer telefonu.
Lista pracowników powinna zawierać informacje takie same jak informacje podane podczas tworzenia pracowników.
Proszę napisać jaki jest błąd logiczny w poniższym kodzie oraz zaproponować rozwiązanie tak, aby program zadziałał poprawnie.

UWAGA: oczekiwane rozwiązanie jest takie aby wprowadzić zmiany tylko i wyłącznie w klasie Employee. Reszta kodu ma pozostać niezmieniona.
Bardzo proszę stworzyć najprostsze rozwiązanie, które poprawi kod.


Opis:
Błąd logiczny w tym rozwiązaniu polega na tym, że numer telefonu i pokój przypisywany bezpośrednio do miejsca pracy a przecież jest ono wspólne dla wielu pracowników.
W związku z powyższym, nie mogą one przechować więcej niż dwa różne numery pokojów i dwa numery telefonów (istnieją dwie instancje WorkplaceInfo).
Każdy pracownik powinien mieć swój własny pokój i numer telefonu, więc należy wprowadzić te dane do instancji klasy Employee.

Moje rozwiązanie to utworzenie oddzielnej instancji WorkplaceInfo dla każdego pracownika z użyciem klonowania.
Dzięki temu, zmianie uległa jedynie sama klasa Employee i nic poza nią.
*/

class WorkplaceInfo {
    public string $room;
    public string $telNumber;
    function __construct(
        public string $city,
        public string $postalCode,
        public string $street,
        public string $number,
    ){}
}

class Employee {
    public int $ID;
    public WorkplaceInfo $workplace;
    function __construct(
        public string $firstName,
        public string $lastName,
        WorkplaceInfo $workplace,
    ) {
        $this->workplace = clone $workplace;
    }

    function printEmployee():string {
        return $this->ID . "\t" . $this->firstName . " " . $this->lastName . "\t | " . $this->workplace->city . ", ul. " . $this->workplace->street . " " . $this->workplace->number . ", pok. " . $this->workplace->room . "\t tel: ". $this->workplace->telNumber . "\n";
    }
}

$office_Krakow = new WorkplaceInfo("Kraków","12-345", "Ostatnia", "42C");
$office_Warszawa = new WorkplaceInfo("Warszawa","23-456", "Pierwsza", "11");

$person1 = new Employee("Jan","Kowalski", $office_Warszawa);
$person1->ID = 1;
$person1->workplace->room = "876";
$person1->workplace->telNumber = "22 555 666";
print "Stworzono pracownika: " . $person1->printEmployee();

$person2 = new Employee("Tomasz","Nowak", $office_Krakow);
$person2->ID = 2;
$person2->workplace->room = "315B";
$person2->workplace->telNumber = "12 222 333";
print "Stworzono pracownika: " . $person2->printEmployee();

$person3 = new Employee("Karol","Kowal", $office_Krakow);
$person3->ID = 3;
$person3->workplace->room = "210";
$person3->workplace->telNumber = "12 333 444";
print "Stworzono pracownika: " . $person3->printEmployee();

$person4 = new Employee("Łukasz","Mak", $office_Krakow);
$person4->ID = 4;
$person4->workplace->room = "12A";
$person4->workplace->telNumber = "12 000 001";
print "Stworzono pracownika: " . $person4->printEmployee();

$people = [$person1, $person2, $person3, $person4];

print "\nLista pracowników:\n";
foreach ($people as $person) {
    print $person->printEmployee();
}
