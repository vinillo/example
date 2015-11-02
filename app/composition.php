<?php
// String -> Functie -> String
function test($string, $test) {
    if($test()){echo " [x] ";}else{echo " [ ] ";}
    echo $string;
    echo "\n";
}

test('Max snelheid van een auto is het aantal PK * 2', function() {
    $ferrari = new Car(
       new Engine(115)
    );

    return $ferrari->maxSpeed() === 230;
});

test('Autorace', function() {
    $ferrari = new Car(new Engine(300));
    $corsa = new Car(new Engine(80));

    $race = new Race($ferrari, $corsa);

    return $race->determineWinner() === $ferrari;
});

class Race {
    private $car1, $car2;

    public function __construct(Car $car1, Car $car2)
    {
        $this->car1 = $car1;
        $this->car2 = $car2;
    }

    public function determineWinner()
    {
        if ($this->car1->maxSpeed() > $this->car2->maxSpeed()) return $this->car1;
        return $this->car2;
    }

}

class Car {
    private $engine;

    public function __construct(Engine $e)
    {
        $this->engine = $e;
    }

    public function maxSpeed()
    {
        return $this->engine->pk() * 2;
    }
}

class Engine {
    private $aantalPK;
    public function __construct($aantalPK)
    {
        $this->aantalPK = $aantalPK;
    }

    public function pk()
    {
        return $this->aantalPK;
    }
}