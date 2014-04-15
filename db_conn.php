<?php
// $session = ssh2_connect('alacritas.cis.utas.edu.au', 22);
// if(ssh2_auth_password($session, 'pengd', 'wAtchmEn')){
// echo "Authentication Successful!\n";
// } else {
// echo "Authentication Failed!\n";
// die('Authentication Failed...');
// }
// $tunnel = ssh2_tunnel($session, 'alacritas.cis.utas.edu.au', 3307);
// $db = new mysqli('127.0.0.1', 'pengd', '207071', 'pengd', 3307, $tunnel);
$mysqli = new mysqli("131.217.36.2", "pengd", "207071", "pengd");

if(mysql_connect_errno()){
printf("Connection failed: %s\n", mysql_connect_error());
}


// $server = 'DESKTOP1\SQLEXPRESS';
// $db = mssql_connect($server, 'pengd', '207071', false);
// if (! $db) {
// 	die ( 'Failed to connect to MSSQL' );
// }
?>