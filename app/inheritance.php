<?php
// String -> Functie -> String
function test($string, $test) {
    if($test()){echo " [x] ";}else{echo " [ ] ";}
    echo $string;
    echo "\n";
}

test('Een gesloten deur is gesloten', function() {
    $deur = new Deur();

    return $deur->isGesloten() && ! $deur->isOpen();
});

test('Een gesloten deur kan worden geopend', function() {
    $deur = new Deur();

    $deur->open();

    return $deur->isOpen();
});

test('Een gesloten deur kan niet worden gesloten', function() {
    $deur = new Deur();

    try {
        $deur->sluit();
    } catch (DeurIsReedsGesloten $e) {
        return true;
    }

    return false;
});

test('Een open deur kan worden gesloten', function() {
    $deur = new Deur();

    $deur->open();
    $deur->sluit();

    return $deur->isGesloten();
});

test('Een open deur kan niet worden geopend', function() {
    $deur = new Deur();
    $deur->open();

    try {
        $deur->open();
    } catch (DeurIsReedsOpen $e) {
        return true;
    }

    return false;
});

class Deur
{
    // 0 is gesloten & 1 is open
    private $state = 0;

    public function open() {
        if($this->isOpen())  throw new DeurIsReedsOpen();
        $this->state = 1;
    }
    public function isOpen() { return $this->state === 1; }
    public function isGesloten() { return $this->state === 0; }
    public function sluit()
    {
        if($this->isGesloten()) throw new DeurIsReedsGesloten();
        $this->state = 0;
    }
}

class DeurIsReedsGesloten extends  \Exception {}
class DeurIsReedsOpen extends \Exception{}

class Car {
    private $isRunning = 0;
    public function start() { $this->isRunning = 1; }
    public function stop() { $this->isRunning = 0; }

    public function maxSpeed() { return 50; }
    public function isRunning() { return $this->isRunning > 0; }
}

class Ferrari extends Car {
    public function maxSpeed() { return 100; }
}

test('Je kan een Ferrari starten en stoppen net zoals elke Car', function() {
    $f = new Ferrari();

    $f->start();

    return $f->isRunning();
});

test('Je kan je Ferrari in mn Garage parkeren', function() {
    $g = new Garage();

    $f = new Ferrari();

    $g->parkeer($f);

    return true;
});

test('Maar met uwen bucht moet ge thuis blijven', function() {
    $g = new Garage();

    $c = new Car();

    $g->parkeer($c);

    return true;
});

class Garage {
    private $ferraris = [];

    public function parkeer(Car $f)
    {
        $this->ferraris[] = $f;
    }
}

abstract class Door {
    protected $secret = 'vinni';

    public function open() { throw new \Exception('Door kan niet worden gesloten'); }
    public function sluit() { throw new \Exception('Door kan niet worden geopend'); }
}

final class OpenDoor extends Door {
    public function sluit() { return new ClosedDoor(); }

    public function getSecret() { return $this->secret; }
}

final class ClosedDoor extends Door {
    public function open() { return new OpenDoor(); }
}

test('Een open deur kan je niet openen', function() {
    $d = new ClosedDoor();

    $closed = new ClosedDoor();
    $open = $closed->open();

    return ($open instanceof OpenDoor);
});

test('Een open deur kan je sluiten', function() {
    $openDoor = new OpenDoor();

    $openDoor->sluit();

    return true;
});

test('Open de deur and get the secret!', function() {
    $closed = new ClosedDoor();
    $open = $closed->open();
    return 'vinni' === $open->getSecret();
});