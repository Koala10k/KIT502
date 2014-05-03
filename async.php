<?php
$todo = $_GET ['TODO'];

if ($todo == 'validate_username') {
	$validate_name = $_GET ['name'];
	
	include 'db_conn.php';
	
	$sql = "SELECT * FROM `users` where `Username` = '$validate_name'";
	$result = $mysqli->query($sql);
	
	header ( "content-type:application/json" );
	$rst = array (
			'rst' => $result->num_rows == 0 ? true: false,
			'name' => $validate_name 
	);
	
	include 'db_disconn.php';
	echo json_encode ( $rst );
}

?>