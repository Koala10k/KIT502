<?php
// require_once ('FirePHPCore/FirePHP.class.php');
// ob_start();
// $firephp = FirePHP::getInstance(true);
// $firephp -> log('starting ');
// $session = ssh2_connect('131.217.36.2', 22);
// $firephp -> log('Session ');
// if (ssh2_auth_password($session, 'pengd', 'wAtchmEn')) {
// $firephp -> log('auth_passwd ');
// echo "Authentication Successful!\n";
// } else {
// echo "Authentication Failed!\n";
// $firephp -> log('die ');
// die('Authentication Failed...');
// }
// $tunnel = ssh2_tunnel($session, 'alacritas.cis.utas.edu.au', 3307);
// $firephp -> log('tunnel ');
// $db = new mysqli('127.0.0.1', 'pengd', '207071', 'pengd', 3307, $tunnel);
// $firephp -> log('db ');
$mysqli = new mysqli("127.0.0.1", "root", "", "pengd");
$firephp -> log('get mysqli');
if ($mysqli -> connect_error) {
	die('Connect Error (' . $mysqli -> connect_errno . ') ' . $mysqli -> connect_error);
}

// echo 'Success ... ' . $mysqli -> hostinfo . "<br />";
// echo phpinfo();

// $server = 'DESKTOP1\SQLEXPRESS';
// $db = mssql_connect($server, 'pengd', '207071', false);
// if (! $db) {
// 	die ( 'Failed to connect to MSSQL' );
// }
?>