<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<?php include 'common_refer.php'; ?>
<title>People</title>
<script>
        	var lastIndex = -1;
            var prevId = -1;
            $(document).ready(function () {
				$('div.info').hide();
                $('#cssmenu li:eq(1)').addClass('active');
                $('img').on('click', function () {
                    switch ($(this).index()) {
                        case 0:
                            $('div.info').css({"background-color": "yellow"});
                            $('div.info').html("Name: Bart_Simpson </br >"+
                                    "Role: Do nothing </br >"+
                                    "Introduction: Easter Bunny!");
                            if(lastIndex == 0) $('div.info').toggle();
                            else $('div.info').show();
                            lastIndex = 0;
                            break;
                        case 1:
                            $('div.info').css({"background-color": "aqua"});
                            $('div.info').html("Name: Marge_Simpson </br >"+
                                    "Role: First Mates </br >"+
                                    "Introduction: Nuts Bat!");
                            if(lastIndex == 1) $('div.info').toggle();
                            else $('div.info').show();
                            lastIndex = 1;
                            break;
                        case 2:
                            $('div.info').css({"background-color": "lime"});
                            $('div.info').html("Name: Homer_Simpson </br >"+
                                    "Role: Chief </br >"+
                                    "Introduction: Crazy Chubby!");
                            if(lastIndex == 2) $('div.info').toggle();
                            else $('div.info').show();
                            lastIndex = 2;
                            break;
                    }
                            prevId = -1;
                });
				$('.name').on('click', function(){
						var id = $(this).prev().val();
						if(prevId == id) $('div.info').toggle();
						else{
						var name = $(this).val();
						$.ajax({
							type: 'GET',
							url: './async.php',
							dataType: 'json',
							data: {'TODO':'query_info', 'id':id},
							beforeSend: function(jqXHR, settings){
								},
							success: function(data){
								if(data.length != 1) {
									alert('ajax data error');
									return;
								}
								var dob = data[0]['dob'];
								var email = data[0]['email'];
								$('div.info').html("Name:"+ name +"</br >Birthday: "+dob+"</br >Email: "+email).css("background-color","white"); 
                                $('div.info').show();
                                prevId = id;
                                lastIndex = -1;
								},
							error: function(jqXHR, textStatus, errorThrown ){
								alert('error:'+textStatus+",errorThrown:"+errorThrown);
							}
							});
						}
						
					});
                
            });
        </script>
        
<?php 
	include 'db_conn.php';
<<<<<<< HEAD
	$sql = "SELECT * FROM `users` WHERE `access` = 1  ORDER BY `Name`";
=======
	$sql = "select * from `users` where `access` = 1";
>>>>>>> 7f2b99596b39dfab79339afcfda7384de9c6f067
	$result = $mysqli->query($sql);
	
	include 'db_disconn.php';
?>
</head>
<body>
<?php include 'header.php'?>
	<h1 id="people">People</h1>
	<?php include 'menu.php'; ?>
		<div class="people">
			<img alt="Bart_Simpson" src="./res/Bart_Simpson.png" />
			<img alt="Marge_Simpson" src="./res/Lisa_Simpson.png" />
			<img alt="Homer_Simpson" src="./res/Homer_Simpson.png" />
		</div>
		<div>
		<table border="1">
<<<<<<< HEAD
		<tr><th>Administrators</th></tr>
		<?php while($row = $result->fetch_array(MYSQLI_ASSOC)){?>
				<tr><td><input type="hidden" value=<?php echo $row['ID']?> /><input type='button' class='name' value=<?php echo $row['Name'];?> /></td>
				</tr>
=======
		<tr><th>Name</th><th>Birthday</th><th>Email</th></tr>
		<?php while($row = $result->fetch_array(MYSQLI_ASSOC)){?>
				<tr><td><input type="hidden" value=<?php echo $row['ID']?> /><input type='button' class='name' value=<?php echo $row['Name'];?> /></td>
				<td><?php echo $row['DOB']; ?></td>
				<td><?php echo $row['Email']; ?></td></tr>
>>>>>>> 7f2b99596b39dfab79339afcfda7384de9c6f067
		<?php }?>
		</table>
		</div>
		
		
		<div class="info"></div>
		<?php include 'footer.php'; ?>
</body>
</html>
