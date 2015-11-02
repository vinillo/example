<?php
require_once("vendor/autoload.php");
use AppBundle\Classy\Requesty;

if(!file_exists(getcwd()."/test.conf.php")){
	die("test.conf.php file does not exist");
}
exit;





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