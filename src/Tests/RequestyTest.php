<?php

namespace Tests;

use AppBundle\Classy\Requesty;
use VinnyTest\TestSuite;

class RequestyTest implements TestSuite
{
    public function requesty_converts_get_and_post_parameters()
    {
        $_POST['hello'] = "world";
        $_GET['yow'] = "dude";

        $r1 = Requesty::createFromGlobals();

        return $r1->Post('hello') === 'world' &&
        $r1->Get('yow') === 'dude';

    }
}