<?php
	$todo = $_GET ['TODO'];

if ($todo == 'validate_username') {
	
	include 'db_conn.php';
	$validate_name = $mysqli->real_escape_string($_GET ['name']);
	
	$sql = "SELECT * FROM `users` where `Username` = '$validate_name'";
	$result = $mysqli->query($sql);
	header ( "content-type:application/json" );
	$rst = array (
			'msg' => $result->num_rows == 0 ? true: false
	);
	
	include 'db_disconn.php';
	echo json_encode ( $rst );
}else if($todo == 'query_info') {
	include 'db_conn.php';
	$id = $mysqli->real_escape_string($_GET ['id']);
	
	$sql = "SELECT `DOB`, `Email` FROM `users` WHERE `ID` = '$id'";
	$result = $mysqli->query($sql);
	header ( "content-type:application/json" );
	$rst = array();
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		$rst[] = array (
				'dob' => $row['DOB'],
				'email' => $row['Email']
		);
	}
	include 'db_disconn.php';
	echo json_encode ($rst);
}

?>