<?php include('db_conn.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<?php include 'common_refer.php'; ?>
<title>Online Survey</title>
</head>
<body>
	<h1 id="survey">Online Survey</h1>
	<?php include 'menu.php'; ?>
	<form method="post" action="">
		Name:
		<input type="text" name="name" autofocus="autofocus" pattern="[a-zA-Z_0-9]+" title="[a-zA-Z_0-9]+"/><br />
		Email:
		<input type="email" name="email" /><br />
		Gender:
		<input type="radio" name="gender" value="Male" />Male
		<input type="radio" name="gender" value="Female" />Female
		<br />
		State:
		<select name="state">
			<option value="-1">--please select an item--</option>
			<option value="VIC">VIC</option>
			<option value="NSW">NSW</option>
			<option value="SA">SA</option>
			<option value="WA">WA</option>
			<option value="ACT">ACT</option>
			<option value="NT">NT</option>
			<option value="QLD">QLD</option>
			<option value="TAS">TAS</option>
		</select>
		<br />
		<input type="reset" />
		<input type="submit" name="sm" value="Submit" />
	</form>
<?php
	if(isset($_POST['sm'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$gender = $_POST['gender'];
		$state = $_POST['state'];
		
		echo $name." ".$email." ".$gender." ".$state."\n";
		
		echo "submitted at".date(" g:i:sa l j-n-Y");
	}

?>
</body>
</html>