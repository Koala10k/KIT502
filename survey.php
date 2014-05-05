<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<?php include 'common_refer.php'; ?>
<title>Online Survey</title>
<script>
	$(document).ready(function(){
		$('#cssmenu li:eq(2)').addClass('active');
	});
	
</script>
</head>
<body>
<?php include 'header.php' ?>
	<h1 id="survey">Online Survey</h1>
	<?php include 'menu.php'; ?>
	<div id="form">
	<form id="surveyForm" method="post" action="">
		Name:
		<input type="text" name="name" autofocus="autofocus" pattern="[a-zA-Z_0-9]+" title="[a-zA-Z_0-9]+" required/><br />
		Email:
		<input type="email" name="email" required/><br />
		Gender:
		<input type="radio" name="gender" value="Male" required />Male
		<input type="radio" name="gender" value="Female" />Female
		<br />
		State:
		<select name="state" required>
			<option value="" style="display:none">--please select an item--</option>
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
		<!-- validate form with Regex -->
	</form>
	</div>
	<div id="query">
	<form id="queryDB" method="post" action="">
	<input type="submit" name="query" value="Query DB if you want :)" />
	</form>
<?php 
	if(isset($_POST['query'])){
	include ('db_conn.php');
	$query = "select * from `survey`";
	$result = $mysqli->query($query);
	
	echo "<table id='query' border='1'>";
	echo "<tr><th>Name</th><th>Email</th><th>Gender</th><th>State</th></tr>";
	while($row=$result->fetch_array(MYSQLI_ASSOC)){
		$name = $row['Name'];
		$email = $row['Email'];
		$gender = $row['Gender'];
		$state = $row['State'];
		echo "<tr>";
		echo "<td>$name</td>";
		echo "<td>$email</td>";
		echo "<td>$gender</td>";
		echo "<td>$state</td>";
		echo "</tr>";
	}
	echo "</table>";
	include ('db_disconn.php');
	}
?>
	</div>
<?php
if (isset($_POST['sm'])) {
	include ('db_conn.php');
	$name = $mysqli->real_escape_string($_POST['name']);
	$email = $mysqli->real_escape_string($_POST['email']);
	$gender = $mysqli->real_escape_string($_POST['gender']);
	$state = $mysqli->real_escape_string($_POST['state']);

	$sql = "INSERT INTO survey (Name, Email, Gender, State) VALUES ('$name', '$email', '$gender', '$state')";
	if (!$mysqli -> query($sql)) {
		die('Error: ' . $mysqli -> error."<br />");
	}else{
		echo "Successfully submitted at" . date(" g:i:sa l j-n-Y");
	}
	include ('db_disconn.php');
}
?>
<?php include 'footer.php'; ?>
</body>
</html>