<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<?php include 'common_refer.php'; ?>
<title>Online Survey</title>
<script>
	$(document).ready(function(){
		$('#cssmenu li:eq(2)').addClass('active');
		// $('form').submit(function(){
			// var info = "<ul>";
			// if($("input[name='name']").val() == "") info+="<li>name can not be empty</li>";
			// if($("input[name='email']").val() == "") info+="<li>email is required</li>";
			// if($("input[name='gender']"))
			 // $('#notice').html();
			// return false;
		// });
		// $('#surveyForm').validate({ // plugin
			// rule:{
				// name: {
					// required: true
				// },
				// email: {
					// required: true
				// }
			// }
		// });
	});
	
</script>
</head>
<body>
	<h1 id="survey">Online Survey</h1>
	<?php include 'menu.php'; ?>
	<div id="notice"></div>
	<form id="surveyForm" method="post" action="">
		Name:
		<input type="text" name="name" autofocus="autofocus" pattern="[a-zA-Z_0-9]+" title="[a-zA-Z_0-9]+" required="true"/><br />
		Email:
		<input type="email" name="email" required="true"/><br />
		Gender:
		<input type="radio" name="gender" value="Male" required="true" />Male
		<input type="radio" name="gender" value="Female" />Female
		<br />
		State:
		<select name="state" required="true">
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
<?php
if (isset($_POST['sm'])) {
	// TODO validate from HTTP Header
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
</body>
</html>