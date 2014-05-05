<?php
include 'session.php';
$refer = $_SERVER['HTTP_REFERER'];
$refer_host = parse_url($refer, PHP_URL_HOST);
$refer_path = parse_url($refer, PHP_URL_PATH);
if($refer_host == $_SERVER['SERVER_NAME'] && !empty($refer_path)){
	include 'db_conn.php';
	$username = $mysqli -> real_escape_string($_POST['username']);
	$hash_pwd = MD5($mysqli -> real_escape_string($_POST['password']));

	$sql = "SELECT * FROM `users` WHERE `Username` = '$username' and `Password` = '$hash_pwd'";
	$result = $mysqli -> query($sql);
	if($result->num_rows != 1){
		session_destroy();
		include 'db_disconn.php';
		echo "login failed! <a href='$refer_path'>Go Back</a>";
// 		header("refresh:5;url=$refer_path");
	}else{
		$rows = $result->fetch_array(MYSQLI_NUM);
		$_SESSION['username'] = $rows[1];
		$_SESSION['id'] = $rows[0];
		$_SESSION['name'] = $rows[3];
		$_SESSION['access'] = $rows[6];
		include 'db_disconn.php';
		header("location: $refer_path");
	}
		// TODO how could I notify the previous page login failed???
}else{
	echo "It's not allowed to redirect from your previous page!!!";
}

// echo $_SERVER['SERVER_NAME'];
?>
<script>
	
</script>