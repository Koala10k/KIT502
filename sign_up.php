<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<?php include 'common_refer.php'; ?>
<title>Sign Up</title>
<script>
var validated = true;
$( function(){
	$("#month").hide();
	$("#day").hide();
	$('select[name="month"]').change(function(){
		if($(this).val()==""){
			$('select[name="day"]').val("");
			$("#day").hide();
			}else{
				$("#day").show();
		var end_day;
		var month = $('select[name="month"]').val();
		var year = $('select[name="year"]').val();
		if(month == 2){
			if(isLeapYear(year))
				end_day = 29;
			else
				end_day = 28;
		}else if(month == 1 || month == 3 || month == 5 || month == 7 || month == 8 || month == 10 || month == 12)
				end_day = 31;
			else
				end_day = 30;
		var day = $('select[name="day"]').val();
		$('select[name="day"]').empty();
		$('select[name="day"]').append($("<option></option>").attr("value", "").text("please select an option"));
		for(var i=1;i<=end_day;i++){
			if(i==day)
				$('select[name="day"]').append($("<option></option>").attr("selected","selected").attr("value", i).text(i));
			else
				$('select[name="day"]').append($("<option></option>").attr("value", i).text(i));
			}
			}
    });
	$('select[name="year"]').change(function(){
		if($(this).val()==""){
			$('select[name="month"]').val("");
			$('select[name="month"]').change();
			$("#month").hide();
			}else{
				$("#month").show();
		var month = $('select[name="month"]').val();
		if(month == 2){
		var end_day;
		var year = $('select[name="year"]').val();
			if(isLeapYear(year))
				end_day = 29;
			else
				end_day = 28;
			var day = $('select[name="day"]').val();
			$('select[name="day"]').empty();
			$('select[name="day"]').append($("<option></option>").attr("value", "").text("please select an option"));
			for(var i=1;i<=end_day;i++){
				if(i==day)
					$('select[name="day"]').append($("<option></option>").attr("selected","selected").attr("value", i).text(i));
				else
					$('select[name="day"]').append($("<option></option>").attr("value", i).text(i));
				}
		}
			}
	});

	
	
	$( "form#sign_up" ).submit(function( event ) {
		if($("select[name='year']").val()=="" || $("select[name='month']").val()==""  || $("select[name='day']").val()==""){
			$("#notifier_date").html('birthday is required').css("color","red");
			validated = false;
			}else{
				$("#notifier_date").html('');
				}
		if(!validated){ event.preventDefault(); return false;}
		return true;
	});
	$("input[name='pawd']").focusout(function(){
		var reg = /^[\S]{5,}$/gi;
// 		var reg = /^.*(?=.{5,})(?=.*[a-zA-Z])(?=.*(\d).*(\d))(?=.*[!#$%&? "]).*$/gi;
		var match = $(this).val().match(reg);
		if(match==null)
// 			$("#notifier_pass").html('password must contain at least<ul><li> 2 digits</li><li> 1 letter</li><li>1 character in the range of !#$%&? "</li><li>and 5 characters in total</li></ul>').css("color","red");
			$("#notifier_pass").html('password must <ul><li>has no space</li><li>contain at least 5 characters</li></ul>').css("color","red");
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
<?php include 'header.php'; 
	if($session_access != 0)
		header('Location: ./index.php');
?>
	<h1 id="sign_up">Sign Up</h1>
	<?php include 'menu.php'; ?>
	<form method="post" id="sign_up">
		Username: <input type="text" name="username" required autofocus pattern="^.*[a-zA-Z].*$" placeholder="at least 1 letter" /><span id="notifier_username"></span><br />
		Password: <input type="password" name="pawd" required placeholder="5 chars, no space" /><div id="notifier_pass"></div>
		Comfirm Password: <input type="password" name="repassword" required /><span id="notifier_pass_match"></span><br />
		Name: <input type="text" name="namef" placeholder="first name" required /><input type="text" name="namel" placeholder="last name" required /><br />
		Date of Birth:
		<span id="year">Year:
		<select name="year">
<?php
echo "<option value=''>please select an option</option>";
for($i=1100;$i<=2014;$i++){
		echo "<option value=".$i.">".$i."</option>";
}
?>
		</select></span><span id="month">Month:
		<select name="month">
		<?php 
		echo "<option value=''>please select an option</option>";
		for($i=1;$i<=12;$i++){
				echo "<option value=".$i.">".$i."</option>";
		}
		?>
		</select></span><span id="day">Day:
		<select name="day">
		echo "<option value=''>please select an option</option>";
		<?php 
		if($month == 2){
		if( !($year % 4) && ($year % 100) || !($year % 400))
			$end_day_of_month = 29;
		else
			$end_day_of_month = 28;
		}elseif($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12)
			$end_day_of_month = 31;
		else
			$end_day_of_month = 30;
		for($i=1;$i<=$end_day_of_month;$i++){
				echo "<option value=".$i.">".$i."</option>";
		}
		?>
		</select></span>
		<span id="notifier_date"></span><br /> 
		Email: <input type="email" name="email" /><br />
		<input type="reset"	name="reset" value="reset" />
		<input type="submit" name="sm" value="Sign Up" />
	</form>

<?php 
	if(isset($_POST['sm'])){
	include 'db_conn.php';
	$username = $mysqli -> real_escape_string($_POST['username']);
	$password = $mysqli -> real_escape_string($_POST['pawd']);
	$namef = $mysqli -> real_escape_string($_POST['namef']);
	$namel = $mysqli -> real_escape_string($_POST['namel']);
	$year = $mysqli -> real_escape_string($_POST['year']);
	$month = $mysqli -> real_escape_string($_POST['month']);
	$day = $mysqli -> real_escape_string($_POST['day']);
	$email = $mysqli -> real_escape_string($_POST['email']);
	
	$name = implode(" ",array($namef, $namel));
	$DOB = implode("-",array($year,$month,$day));;
	//TODO server side validation
	
	$hash_pwd  = MD5($password);
	$access = 2;
	$created = date('Y-m-d H:i:s');
	
	$sql = "INSERT INTO `users` (`Username`, `Password`, `Name`, `DOB`, `Email`, `Access`, `Created`) VALUES 
  		('$username', '$hash_pwd', '$name', '$DOB', '$email', '$access', '$created')";
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
			header("Location: ./index.php");
	}
	include 'db_disconn.php';
}

?>
<?php include 'footer.php'; ?>
</body>
</html>