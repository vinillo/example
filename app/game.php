<?php
// String -> Functie -> String
function test($string, $test) {
    if($test()){echo " [x] ";}else{echo " [ ] ";}
    echo $string;
    echo "\n";
}
class Hero extends Levensvorm {
    protected  $wapen;
    public function bewapen(Wapen $wapen)
    {
     return $this->wapen = $wapen;
    }

    public function attack(Monster $monster)
    {
        $monster->receiveAttack($this->wapen()->ap());
    }

    /**
     * @return Wapen
     */
    private function wapen()
    {
        return $this->wapen;
    }
}
class Monster extends Levensvorm {
    public function receiveAttack($ap)
    {
        $this->hp = $this->hp - $ap;
    }
}

test('A hero starts with 100HP.', function() {
    return (new Hero())->hp() === 100;
});

test('A monster starts with 100HP.', function() {
    return(new Monster())->hp() === 100;
});

test('Levensvormen vallen elkaar aan', function() {
    $hero = new Hero();
    $monster = new Monster();

    $hero->bewapen(new Wapen(10));
    $hero->attack($monster);

    return $monster->hp() === 90;
});

class Levensvorm {
    protected $hp = 100;
    public function hp() { return $this->hp; }
}
class Wapen
{
protected $ap;

    public function ap()
    {
        return $this->ap;
    }
}