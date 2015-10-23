<?php
require_once("vendor/autoload.php");
use AppBundle\Classy\Requesty;

if(!file_exists(getcwd()."/test.conf.php")){
	die("test.conf.php file does not exist");
}
exit;

// 1 POST en GET bevatten enkele dingen bv post hello => world
//									       get  yow   => dude		

// Wanneer we een request aanmaken dmv ::createFromGlobals

// En we vragen de post parameter voor hello op, dan krijgen we world te zien
// En we vragen de get parameter voor yow op, dan krijgen we dude te zien

// wanneer we nadien een nieuwe value in POST stoppen bla => bla
// En we vragen de post parameter voor bla op, dan krijgen we NULL

/*
$_POST['hello']  = "world";
$_GET['yow'] = "dude";

$r1 = Requesty::createFromGlobals();

echo 'world === ' . $r1->Post('hello') . "\n";

echo 'dude === ' . $r1->Get('yow') . "\n";

$_POST['bla'] = null;

echo ' === ' . $r1->Post("a");
*/



interface TestSuite {}

function printSuite(TestSuite $suite) {
	$class = new \ReflectionClass($suite);
	
	foreach ($class->getMethods() as $method) {
		if (! $method->isPublic()) continue;

		$boolean = $method->invoke($suite);

		echo ($boolean ? '[x] ' : '[ ] ') . $method->getName() . "\n";
	}
}

/*class RequestyTest implements TestSuite {
	public function requesty_converts_get_and_post_parameters() {
		$_POST['hello']  = "world";
		$_GET['yow'] = "dude";

		$r1 = Requesty::createFromGlobals();

		return $r1->Post('hello') === 'world' &&
			   $r1->Get('yow') === 'dude';	

	}
}*/



//printSuite(new RequestyTest);

/*
	test.php

	foreach ($registeredSuites as $suite) printSuide($suite)
*/

// test.conf.php
// CHECK IF test.conf.php exists?