<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<?php include 'common_refer.php'; 
?>
<title>Online Survey</title>
<script>
	var usa_states = [
			{'value':'Florida','text':'Florida'},
			{'value':'California','text':'California'},
			{'value':'Hawaii','text':'Hawaii'}
	];
	
	var au_states = [
			{'value':'SA','text':'SA'},
			{'value':'WA','text':'WA'},
			{'value':'TAS','text':'TAS'}
	];

	var florida_city = [
			{'value':'Miami','text':'Miami'},
			{'value':'Orlando','text':'Orlando'},
			{'value':'Cape Coral','text':'Cape Coral'}
	];

	var california_city = [
			{'value':'San Francisco','text':'San Francisco'},
			{'value':'Santa Rosa','text':'Santa Rosa'},
			{'value':'Santa Ana','text':'Santa Ana'}		
	];

	var hawaii_city = [
			{'value':'Honolulu','text':'Honolulu'},
			{'value':'Kahului','text':'Kahului'},
			{'value':'Kapaa','text':'Kapaa'}
	];

	var sa_city = [
			{'value':'Adelaide','text':'Adelaide'},
			{'value':'Koppio','text':'Koppio'},
			{'value':'Whyalla','text':'Whyalla'}
	];

	var wa_city = [
			{'value':'Perth','text':'Perth'},
			{'value':'Albany','text':'Albany'},
			{'value':'Geraldton','text':'Geraldton'}
	];

	var tas_city = [
            {'value':'Hobart','text':'Hobart'},
    		{'value':'Launceston','text':'Launceston'},
    		{'value':'Devonport','text':'Devonport'}
	];

	var non_selected_html ='<option value="" style="display:none">--please select an item--</option>';
	
	
	$(document).ready(function(){
		$('#cssmenu li:eq(2)').addClass('active');
		$("select[name='country']").change(function(){
			var selected = $("select[name='country'] option:selected").val();
			$("select[name='state'] option").remove();
			$("select[name='state']").html(non_selected_html);
			if(selected == 'USA'){
				$.each(usa_states, function(i){
				$("select[name='state']").append($("<option></option>").attr("value", usa_states[i]['value']).text(usa_states[i]['value']));
				});
			}else if(selected == 'Australia'){
				$.each(au_states, function(i){
					$("select[name='state']").append($("<option></option>").attr("value", au_states[i]['value']).text(au_states[i]['text']));
					});
			}
		});

		$("select[name='state']").change(function(){
			var selected = $("select[name='state'] option:selected").val();
			$("select[name='city']").empty();
			$("select[name='city']").html(non_selected_html);
			if(selected == 'Florida'){
				$.each(florida_city, function(i){
				$("select[name='city']").append($("<option></option>").attr("value", florida_city[i]['value']).text(florida_city[i]['value']));
				});
			}else if(selected == 'California'){
				$.each(california_city, function(i){
					$("select[name='city']").append($("<option></option>").attr("value", california_city[i]['value']).text(california_city[i]['text']));
					});
			}else if(selected == 'Hawaii'){
				$.each(hawaii_city, function(i){
					$("select[name='city']").append($("<option></option>").attr("value", hawaii_city[i]['value']).text(hawaii_city[i]['text']));
					});
			}else if(selected == 'SA'){
				$.each(sa_city, function(i){
					$("select[name='city']").append($("<option></option>").attr("value", sa_city[i]['value']).text(sa_city[i]['text']));
					});
			}else if(selected == 'WA'){
				$.each(wa_city, function(i){
					$("select[name='city']").append($("<option></option>").attr("value", wa_city[i]['value']).text(wa_city[i]['text']));
					});
			}else if(selected == 'TAS'){
				$.each(tas_city, function(i){
					$("select[name='city']").append($("<option></option>").attr("value", tas_city[i]['value']).text(tas_city[i]['text']));
					});
			}
		});
	});
	
</script>
</head>
<body>
<?php include 'header.php' ?>
	<h1 id="survey">Online Survey</h1>
	<?php include 'menu.php'; ?>
	<div id="form">
	<form id="surveyForm" method="post" action="">
		<span style="color:red">*</span>Gender:
		<input type="radio" name="gender" value="Male" required />Male
		<input type="radio" name="gender" value="Female" />Female
		<br />
		<span style="color:red">*</span>Country:
		<select name="country" required>
			<option value="" style="display: none">--please select an item--</option>
			<option value="Australia">Australia</option>
			<option value="USA">USA</option>
		</select>
		<br />
		<span style="color:red">*</span>State:
		<select name="state" required>
		</select>
		<br />
		<span style="color:red">*</span>City:
		<select name="city" required>
		</select>
		<br />
		<span style="color:red">*</span>Satisfaction:
		<input type="radio" name="satisfaction" value="Yes" required />Yes
		<input type="radio" name="satisfaction" value="No" />No
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
	echo "<tr><th>ID</th><th>Gender</th><th>State</th><th>Country</th><th>City</th><th>Satisfaction</th><th>Created</th></tr>";
	while($row=$result->fetch_array(MYSQLI_ASSOC)){
		$id = $row['ID'];
		$gender = $row['Gender'];
		$state = $row['State'];
		$country = $row['Country'];
		$city = $row['City'];
		$satisfaction = $row['Satisfaction'];
		$created = $row['Created'];
		echo "<tr>";
		echo "<td>$id</td>";
		echo "<td>$gender</td>";
		echo "<td>$state</td>";
		echo "<td>$country</td>";
		echo "<td>$city</td>";
		echo "<td>$satisfaction</td>";
		echo "<td>$created</td>";
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
	
	$gender = $mysqli->real_escape_string($_POST['gender']);
	$state = $mysqli->real_escape_string($_POST['state']);
	$country = $mysqli->real_escape_string($_POST['country']);
	$city = $mysqli->real_escape_string($_POST['city']);
	$satisfaction = $mysqli->real_escape_string($_POST['satisfaction']);
	$created = date('Y-m-d H:i:s');

	$sql = "INSERT INTO `survey` (`Gender`, `State`, `Country`, `City`, `Satisfaction`, `Created`) VALUES ('$gender', '$state', '$country', '$city', '$satisfaction', '$created')";
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