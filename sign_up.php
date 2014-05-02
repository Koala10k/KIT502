<?php
include 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<?php include 'common_refer.php'; ?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  
<title>Contact Us</title>
<script>
var validated = true;
$( function(){
	$("input[name='DOB']" ).datepicker({ changeYear: true, changeMonth: true, yearRange: "1900:2050",dateFormat: "dd-mm-yy" });
	$( "form" ).submit(function( event ) {
		if($("input[name='DOB']").val()==""){
			$("#notifier_date").html('birthday is required!').css("color","red");
			event.preventDefault();
		}
		if(!validated) event.preventDefault();
	});
	$("input[name='password']").focusout(function(){
		var reg = /^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*(\d).*(\d))(?=.*[!#$%&? "]).*$/gi;
		if($(this).val().match(reg)==null)
			$("#notifier_pass").html('password must contain at least<ul><li> 2 digits</li><li> 1 letter</li><li>1 character in the range of !#$%&? "</li><li>and 8 characters in total</li></ul>').css("color","red");
		else
			$("#notifier_pass").html('');
	});
	$("input[name='repassword']").focusout(function(){
		if( $("input[name='password']").val() === $("input[name='repassword']").val()){
			$("#notifier_pass_match").html("");
			validated = true;
			return;
		}
		validated = false;
		$("#notifier_pass_match").html("passwords are not matched!").css("color","red");
	});
	
	$("input:reset").click(function(){
		$("#notifier_pass_match").html("");
	});

	//TODO ajax validate duplicate username;
});

</script>
</head>
<body>
<?php include 'header.php'; ?>
	<h1 id="sign_up">Sign Up</h1>
	<?php include 'menu.php'; ?>
	<form method="post">
		Username: <input type="text" name="username" required autofocus /><br />
		Password: <input type="password" name="password" required /><br /><div id="notifier_pass"></div>
		Retype Password: <input type="password" name="repassword" required /><span id="notifier_pass_match"></span><br />
		Nick Name: <input type="name" name="name" required /><br /> 
		Date of Birth: <input type="date" name="DOB" required readonly /><span id="notifier_date"></span><br /> 
		Email: <input type="email" name="email" required /><br /> 
		<input type="reset"	name="reset" value="reset" />
		<input type="submit" name="sm" value="Sign Up" />
		<div id="datepicker"></div>
	</form>

<?php 
	if(isset($_POST['sm'])){
	include 'db_conn.php';
	$username = $mysqli -> real_escape_string($_POST['username']);
	$password = $mysqli -> real_escape_string($_POST['password']);
	$name = $mysqli -> real_escape_string($_POST['name']);
	$DOB = $mysqli -> real_escape_string($_POST['DOB']);
	$email = $mysqli -> real_escape_string($_POST['email']);
	
	//TODO server side validation
	
	$password  = MD5($passwrod); 
	$access = 0;
// 	$created = (new Datetime())-> getTimestamp(); Mysql: data truncated for column 'Created' 
	$created = (new Datetime())-> format('Y-m-d H:i:s');
	$DOB = DateTime::createFromFormat('m-d-Y', $DOB)-> format('Y-m-d');
	
	echo $DOB." ".$created;
	$sql = "INSERT INTO `users` (`Username`, `Password`, `Name`, `DOB`, `Email`, `Access`, `Created`) VALUES 
  		('$username', '$password', '$name', '$DOB', '$email', '$access', '$created')";
	echo $sql;
	if(!$mysqli->query($sql)){
		die('Error: ' . $mysqli -> error."<br />");
	}else{
		$_SESSION['username']= $username;
		header("Location: ./index.php");
	}
	include 'db_disconn.php';
}

?>
<script>
</script>
</body>
</html>