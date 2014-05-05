<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<?php include 'common_refer.php'; ?>
<title>People</title>
<script>
        	var lastIndex = -1;
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
                var prevId = -1;
				$('.name').on('click', function(){
						var id = $(this).prev().val();
						$.ajax({
							url: './async.php',
							type: 'POST',
							dataType: 'json',
							data: {'TODO':'query_info', 'id':id},
							beforeSend: function(jqXHR, settings){
								alert('beforeSend');
								},
							success: function(data){
								alert('success');
								var dob = data['dob'];
								var email = data['email'];
								$('div.info').html("Name:"+$(this).val() +"</br >"+
	                                    "Birthday: "+dob+"</br >"+
	                                    "Email: "+email);
                                if(prevId == id) $('div.info').toggle();
                                else $('div.info').show();
                                prevId = id;
                                lastIndex = -1;
								},
							error: function(){
								alert('error');
							}
							});
						
					});
                
            });
        </script>
        
<?php 
	include 'db_conn.php';
	$sql = "select * from `users` where `access` = 1";
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
		<tr><th>Name</th><th>Birthday</th><th>Email</th></tr>
		<?php while($row = $result->fetch_array(MYSQLI_ASSOC)){?>
				<tr><td><input type="hidden" value=<?php echo $row['ID']?> /><input type='button' class='name' value=<?php echo $row['Name'];?> /></td>
				<td><?php echo $row['DOB']; ?></td>
				<td><?php echo $row['Email']; ?></td></tr>
		<?php }?>
		</table>
		</div>
		
		
		<div class="info"></div>
		<?php include 'footer.php'; ?>
</body>
</html>
