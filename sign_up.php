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
	$("input[name='DOB']").datepicker({ changeYear: true, changeMonth: true, yearRange: "1900:2050",dateFormat: "dd-mm-yy" });
	$( "form#sign_up" ).submit(function( event ) {
		if($("input[name='DOB']").val()==""){
			$("#notifier_date").html('birthday is required!').css("color","red");
			event.preventDefault();
			return false;
		}
		if(!validated){ event.preventDefault(); return false;}
		return true;
	});
	$("input[name='pawd']").focusout(function(){
		var reg = /^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*(\d).*(\d))(?=.*[!#$%&? "]).*$/gi;
		var match = $(this).val().match(reg);
		if(match==null)
			$("#notifier_pass").html('password must contain at least<ul><li> 2 digits</li><li> 1 letter</li><li>1 character in the range of !#$%&? "</li><li>and 8 characters in total</li></ul>').css("color","red");
		else
			$("#notifier_pass").html('');
	});
	$("input[name='repassword']").focusout(function(){
		if( $("input[name='pawd']").val() === $(this).val()){
			$("#notifier_pass_match").html("");
			validated = true;
			return;
		}
		validated = false;
		$("#notifier_pass_match").html("passwords are not matched!").css("color","red");
	});
	
	$("input:reset").click(function(){
		$("#notifier_pass_match").html("");
		$("#notifier_pass").html("");
		$("#notifier_date").html("");
		$("#notifier_username").html("");
	});

	$("input[name='username']").focusout(function(){
		if($(this).val()=="") return;
		$.ajax({
				url: './async.php',
				type: 'GET',
				dateType: 'json',
				data: {'TODO':'validate_username', 'name': $(this).val()},
				beforeSend: function(jqXHR, settings ){
					$("#notifier_username").html("validating...").css("color","blue");
					},
			success: function(data){//, textStatus, jqXHR
					var rst = data['msg'];
					if(rst==null){
						$("#notifier_username").html("db error").css("color","red");
					validated = false;
				}else if(rst){
						$("#notifier_username").html("this username is available :-)").css("color","green");
						validated = true;
					}else{
							$("#notifier_username").html("this username has been used :-(, please try another one").css("color","red");
						validated = false;
					}
				},
				error:function(jqXHR, textStatus, errorThrown){
					$("#notifier_username").html(textStatus).css("color","gray");
				}
		});
		
	});
});

</script>
</head>
<body>
<?php include 'header.php'; ?>
	<h1 id="sign_up">Sign Up</h1>
	<?php include 'menu.php'; ?>
	<form method="post" id="sign_up">
		Username: <input type="text" name="username" required autofocus /><span id="notifier_username"></span><br />
		Password: <input type="password" name="pawd" required /><div id="notifier_pass"></div>
		Comfirm Password: <input type="password" name="repassword" required /><span id="notifier_pass_match"></span><br />
		Nick Name: <input type="text" name="name" required /><br /> 
		Date of Birth: <input type="date" name="DOB" required readonly /><span id="notifier_date"></span><br /> 
		Email: <input type="email" name="email" /><br /> 
		<input type="reset"	name="reset" value="reset" />
		<input type="submit" name="sm" value="Sign Up" />
	</form>

<?php 
	if(isset($_POST['sm'])){
	include 'db_conn.php';
	$username = $mysqli -> real_escape_string($_POST['username']);
	$password = $mysqli -> real_escape_string($_POST['pawd']);
	$name = $mysqli -> real_escape_string($_POST['name']);
	$DOB = $mysqli -> real_escape_string($_POST['DOB']);
	$email = $mysqli -> real_escape_string($_POST['email']);
	
	//TODO server side validation
	
	$hash_pwd  = MD5($password);
	$access = 0;
// 	$created = (new Datetime())-> getTimestamp(); Mysql: data truncated for column 'Created' 
	$created = date('Y-m-d H:i:s');
	$DOB = DateTime::createFromFormat('m-d-Y', $DOB) -> format('Y-m-d');
	
	$sql = "INSERT INTO `users` (`Username`, `Password`, `Name`, `DOB`, `Email`, `Access`, `Created`) VALUES ('$username', '$hash_pwd', '$name', '$DOB', '$email', '$access', '$created')";
	if(!$mysqli->query($sql)){
		echo "step1";
		die('Error: ' . $mysqli -> error."<br />");
	}else{
// 		$_SESSION['username']= $username;
// 		$_SESSION['name']= $name;
// 		header("refresh:0; ./index.php");
//	TODO: curl doesn't automatically redirect to target url???
// 		$url = 'http://localhost/kit502/login.php';
// 		$myvars = 'username=' . $username . '&password=' . $password;
		
// 		$ch = curl_init( $url );
// 		curl_setopt( $ch, CURLOPT_POST, 1);
// 		curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
// 		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true);
// 		curl_setopt( $ch, CURLOPT_HEADER, 0);
// 		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 0);
// 		curl_setopt( $ch, CURLOPT_AUTOREFERER, true);
		
// 		$response = curl_exec( $ch );

		$sql = "SELECT * FROM `users` WHERE `Username` = '$username' and `Password` = '$hash_pwd'";
		$result = $mysqli -> query($sql);

			$rows = $result->fetch_array(MYSQLI_NUM);
			$_SESSION['username'] = $rows[1];
			$_SESSION['id'] = $rows[0];
			$_SESSION['name'] = $rows[3];
			$_SESSION['access'] = $rows[6];
			header("location: ./index.php");
	}
	include 'db_disconn.php';
}

?>
<?php include 'footer.php'; ?>
</body>
</html>