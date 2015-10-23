<?php

use Tests\RequestyTest;

require_once("vendor/autoload.php");

$suites = [
    new RequestyTest(),
];

return $suites;