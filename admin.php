<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
        <?php include 'common_refer.php'; ?>
        <title>Admin</title>
<script>
            $(document).ready(function (){
            	 $("#msg").delay(1500).slideUp();
});
        </script>
</head>
<body>
<?php include './header.php';	?>
	<h1>Admin</h1>
        <?php include 'menu.php'; ?>
<?php
$validate = false;
if($session_access == 1){
	if(isset($_POST['validate_sm'])){
	include 'db_conn.php';
	$username = $mysqli -> real_escape_string($_SESSION['username']);
	$hash_pwd = MD5($mysqli -> real_escape_string($_POST['password']));
	
	$sql = "SELECT * FROM `users` WHERE `Username` = '$username' and `Password` = '$hash_pwd'";
	$result = $mysqli -> query($sql);
	include 'db_disconn.php';
	if($result->num_rows == 1){
		$validate = true;
	}else{
		?>
		<script type="text/javascript">
			alert('You have entered wrong password. Please try again');
		</script>
		<?php
		}
	}
	
	if(isset($_POST['access_sm'])){
		include 'db_conn.php';
		$id = $mysqli->real_escape_string($_POST['id']);
		$access = $mysqli -> real_escape_string($_POST['access']);
		
		$sql = "SELECT `Access` FROM `users` WHERE `ID` = '$id'";
		$result = $mysqli -> query($sql);
		$row = $result -> fetch_array(MYSQLI_ASSOC);
		if($row['Access'] == $access){
			$msg = "No changes, Update cancelled!!!";
		}else{
		$sql = "UPDATE `users` SET `Access` = '$access' WHERE `ID` = '$id'";
		if($result = $mysqli -> query($sql)){
			$msg = "Update succeeded.";
		}else{
			$msg = "Update failed, ".$mysqli->error;
		}
		}
		
		echo "<div id='msg'>".$msg."</div>";
		
		include 'db_disconn.php';
		
		$validate = true;
	}
	
	if(!$validate){
		?>
	<form method="post">
	Username:<input type="text" name="username" disabled="disabled" readonly value='<?php echo $_SESSION['username']?>'/><br />
	Password:<input type="password" name="password" />
	<input type="submit" name="validate_sm" value="Submit" />
	</form>
	<?php 
	}else{
?>
<table id='users' border='1'>
<tr><th>ID</th><th>Username</th><th>Name</th><th>DOB</th><th>Email</th><th>Access</th><th>Manipulation</th></tr>
<?php 
include 'db_conn.php';
$sql = "SELECT * FROM `users`";
$result = $mysqli -> query($sql);
include 'db_disconn.php';
while($row = $result->fetch_array(MYSQLI_ASSOC)){
	$id = $row['ID'];
	$username = $row['Username'];
	$name = $row['Name'];
	$DOB = $row['DOB'];
	$email = $row['Email'];
	$access = $row['Access'];
?>
<form method="post">
<tr>
<td><input type="hidden" name="id" value='<?php echo $id ?>'/><?php echo $id ?></td>
<td><?php echo $username ?></td>
<td><?php echo $name ?></td>
<td><?php echo $DOB ?></td>
<td><?php echo $email ?></td>
<td><select name="access">
<?php 
$roles = array("Admin","General");
for($i=1;$i<=2;$i++){
	echo "<option value=".$i." ";
	echo $access == $i?"selected='selected'":"";
	echo ">".$roles[$i-1]."</option>";
	}
	?>
</select></td>
<td><input type="submit" name="access_sm" value="Update"/>
<input type="reset" />
</tr>
</form>
<?php 
}
?>
</table>
<?php 
}

}?>

<?php include 'footer.php'; ?>
</body>
</html>
