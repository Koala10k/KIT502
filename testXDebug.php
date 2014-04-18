<?php
$primes = array(2, 3, 5, 7, 11, 13, 17);
var_dump($primes);
 
foo();
 
function foo()
{
	bar(5, 7);
}
 
function bar($param1, $param2)
{
	$local1 = 1;
	$local2 = 2;
 
	wazzup;
}
?>