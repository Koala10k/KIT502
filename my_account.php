<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
        <?php include 'common_refer.php'; ?>
        <title>My Account</title>
<script>
function isLeapYear(input) {
    if (input % 4 === 0) {
        if (input % 100 !== 0) {
            return true;
        } else {
            if (input % 400 === 0) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
}

            $(function (){
            	$("#msg").delay(1500).slideUp();
            	$( "form#edit" ).submit(function( event ) {
                	var validated = false;
            		if($("select[name='year']").val()=="" || $("select[name='month']").val()==""  || $("select[name='day']").val()==""){
            			$("#notifier_date").html('birthday is required').css("color","red");
            			validated = false;
            			}else{
            				$("#notifier_date").html('');
            				validated = true;
            				}
            		if(!validated){ event.preventDefault(); return false;}
            		return true;
            	});
            	
                $('select[name="month"]').change(function(){
                	  if($(this).val()!=""){
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
                	  }else{
                		  $('select[name="day"]').val("");
                		  $("#day").hide();
                    	  }
                    });
                $('select[name="year"]').change(function(){
                    if($(this).val()!=""){
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
                    }else{
                    	$('select[name="month"]').val("");
                    	$('select[name="month"]').change();
                    	$("#month").hide();
                        }
                    });
});
        </script>
</head>
<body>
<?php include './header.php';	?>
	<h1>My Account</h1>
        <?php include 'menu.php'; ?>
<?php 
$validate = false;
if($session_access == 1 || $session_access == 2){
	if(isset($_POST['validate_sm'])){
	include 'db_conn.php';
	$username = $mysqli -> real_escape_string($_SESSION['username']);
	$hash_pwd = MD5($mysqli -> real_escape_string($_POST['password']));
	
	$sql = "SELECT * FROM `users` WHERE `Username` = '$username' and `Password` = '$hash_pwd'";
	$result = $mysqli -> query($sql);
	include 'db_disconn.php';
	if($result->num_rows == 1){
		$rows = $result->fetch_array(MYSQLI_NUM);
		$username = $rows[1];
		$name = $rows[3];
		$email = $rows[5];
		$DOB = $rows[4];
		
		list($namef,$namel) = explode(" ",$name);
		list($year,$month,$day) = explode("-",$DOB); 
	$validate = true;
	}else{
	$msg = 'You have entered wrong password. Please try again';
		echo "<div id='msg'>".$msg."</div>";
	}	
}

if(isset($_POST['edit_sm'])){
	include 'db_conn.php';
	$username = $_SESSION['username'];
	$namef = $mysqli -> real_escape_string($_POST['namef']);
	$namel = $mysqli -> real_escape_string($_POST['namel']);
	$year = $mysqli -> real_escape_string($_POST['year']);
	$month = $mysqli -> real_escape_string($_POST['month']);
	$day = $mysqli -> real_escape_string($_POST['day']);
	$email = $mysqli -> real_escape_string($_POST['email']);
	
	$name = implode(" ",array($namef, $namel));
	$DOB = implode("-",array($year,$month,$day));
	
	$sql = "UPDATE `users` SET `Name` = '$name', `DOB` = '$DOB', `Email` = '$email' WHERE `Username` = '$username'";
	$result = $mysqli->query($sql);
	include 'db_disconn.php';
	if($result){
		$msg = "Update successfully";
	}else{
		$msg = "error ".$mysqli->error;	
	}
	$validate = true;
	echo "<div id='msg'>".$msg."</div>";
}

if(!$validate){
	?>
<form method="post">
Username:<input type="text" name="username" readonly disabled="disabled" value='<?php echo $_SESSION['username']?>'/><br />
Password:<input type="password" name="password" />
<input type="submit" name="validate_sm" value="Submit" />
</form>
<?php 
}else{
?>
<form id="edit" method="post">
Username: <input type="text" name="username" readonly disabled="disabled" value='<?php echo $username ?>'/><br />
Name: <input type="text" name="namef" placeholder="first name" required value='<?php echo $namef?>' />
<input type="text" name="namel" placeholder="last name" required value='<?php echo $namel?>'/><br />
Date of Birth:<span id="year">Year:
<select name="year">
<?php
// 		$year = date('Y');
echo "<option value=''>please select an option</option>";
for($i=1100;$i<=2014;$i++){
	if($year == $i)
		echo "<option selected value=".$i.">".$i."</option>";
	else
		echo "<option value=".$i.">".$i."</option>";
}
?>
		</select></span>
		<span id="month">Month:
		<select name="month">
		<?php 
// 		$month = date('n');
		echo "<option value=''>please select an option</option>";
		for($i=1;$i<=12;$i++){
			if($month == $i)
				echo "<option selected value=".$i.">".$i."</option>";
			else
				echo "<option value=".$i.">".$i."</option>";
		}
		?>
		</select></span>
		<span id="day">Day:
		<select name="day">
		<?php 
		//!(y % 4) && (y % 100) || !(y % 400)
		echo "<option value=''>please select an option</option>";
		if($month == 2){
		if( !($year % 4) && ($year % 100) || !($year % 400))
			$end_day_of_month = 29;
		else
			$end_day_of_month = 28;
		}elseif($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12)
			$end_day_of_month = 31;
		else
			$end_day_of_month = 30;
// 		$day = date('j');
		for($i=1;$i<=$end_day_of_month;$i++){
			if($day == $i)
				echo "<option selected value=".$i.">".$i."</option>";
			else
				echo "<option value=".$i.">".$i."</option>";
		}
		?>
		</select></span>
		<span id="notifier_date"></span><br /> 
		Email: <input type="email" name="email" value='<?php echo $email?>' /><br />
		<input type="submit" name="edit_sm" value="Edit" />
	</form>
<?php 
}
}?>

	<?php include 'footer.php'; ?>
</body>
</html>