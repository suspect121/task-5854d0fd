<?php
/*
 * Opis:
 *
 * Zadanie można by było podzielić odpowiedzialnościami na oddzielne pliki i jeżeli taki byłby wymóg, zrobiłbym to.
 * Odpowiedzialności są podzielone jedynie na klasy, bez podziału na oddzielne pliki.
 */


/*
 * Przygotowanie instancji
 */
$database = new Database();
$vote_manager = new VoteManager($database);
$validate = new Validate();

/*
 * Dodawanie głosu
 */
if (isset($_GET['kto']) && isset($_GET['godzina'])) {
    if (!$validate->isName($_GET['kto'])) {
        echo 'Wprowadziłeś nieprawidłowe imię';
        exit;
    }
    if (!$validate->isHourWithMinutes($_GET['godzina'])) {
        echo 'Wprowadziłeś nieprawidłową godzinę, prawidłowy format godziny to HH:MM i H:MMM';
        exit;
    }
    $vote = new Vote($_GET['kto'], $_GET['godzina']);
    $vote_manager->addVote($vote);
}

/*
 * Wyświetlanie efektów głosowania
 */

try {
    $data = $vote_manager->getVotedResult();

?><!DOCTYPE html>
<html html>
<head>
    <title>Umówmy się razem na najlepszą godzinę</title>
    <link rel="stylesheet" href="/main.css">
</head>
<body>
    <div class="container">
        <div class="vote_list title">
            <div>Godzina</div>
            <div>Głosujący</div>
        </div>
        <?php
        foreach ($data as $hour => $voters) {
        ?>
        <div class="vote_list vote">
            <div><?php echo $hour; ?></div>
            <div><?php echo $voters; ?></div>
        </div>
        <?php
        }
        ?>
    </div>
</body>
</html>
<?php
} catch (Exception) {
    echo 'Ups, pojawił się jakiś problem. Skontaktuj się z administratorem.';
}

class Validate
{
    public function isName(string $name): bool
    {
        return preg_match('/^[a-zA-Z]+$/', $name);
    }

    public function isHourWithMinutes(string $value): bool
    {
        return preg_match('/^[0-9]{1,2}:[0-9]{2}$/', $value);
    }
}

/**
 * Reprezentuje głos
 */
class Vote
{
    public function __construct(private string $name, private string $hour)
    {
        if(strlen(strtok($hour, ':')) === 1) {
            $this->hour = '0'.$this->hour;
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHour(): string
    {
        return $this->hour;
    }
}

/**
 * Menadżer głosów
 */
class VoteManager
{
    public function __construct(private Database $database)
    {

    }

    /**
     * Dodaje głos do bazy danych
     *
     * @param Vote $vote
     * @throws Exception
     */
    public function addVote(Vote $vote): void
    {
        $database_data = [];
        if($this->database->hasData()) {
            $database_data = $this->database->getData();
        }
        $name = $vote->getName();
        $hour = $vote->getHour();
        $database_data[$name] = $hour;
        $this->database->setData($database_data);
    }

    /**
     * Zwraca rezultat głosowania
     *
     * @return array
     * @throws Exception
     */
    public function getVotedResult(): array
    {
        if(!$this->database->hasData()) {
            return [];
        }
        $data = $this->database->getData();
        $result = [];
        foreach($data as $name => $hour) {
            $result[$hour][] = $name;
        }
        foreach($result as &$names) {
            sort($names);
            $names = implode(', ', $names);
        }
        ksort($result);
        return $result;
    }
}

/**
 * Reprezentuje bazę danych
 */
class Database
{
    private array $cache;

    public function getData(): array
    {
        if (isset($this->cache)) {
            return $this->cache;
        }
        if (!$this->hasData()) {
            throw new Exception('Nie można uzyskać danych ponieważ baza danych nie istnieje');
        }
        $data = file_get_contents(__DIR__.'/database.json');
        if ($data === false) {
            throw new Exception('Nie można odczytać pliku bazy danych');
        }
        $this->cache = json_decode($data, true);
        return $this->cache;
    }

    public function setData(array $data): void
    {
        $path = $this->getDatabasePath();
        $json_data = json_encode($data);
        $status = file_put_contents($path, $json_data);
        if ($status === false) {
            throw new Exception('Nie udało się zapisać pliku z bazą danych');
        }
        $this->cache = $data;
    }

    public function hasData(): bool
    {
        $path = $this->getDatabasePath();
        return is_file($path);
    }

    private function getDatabasePath(): string
    {
        return __DIR__.'/database.json';
    }
}
