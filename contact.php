<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<?php include 'common_refer.php'; ?>
<title>Contact Us</title>
<script>
	$(document).ready(function(){
		$('#cssmenu li:eq(3)').addClass('active');
		var colors = new Array("red", "blue", "green", "yellow", "purple", "aqua", "lime", "orange");
		var curColor = 0;
		var li = $('.contact').first();
		li.css('border-color',colors[curColor++%colors.length]);
		while(li.next().is("div .contact")){
			li = li.next();
			li.css('border-color',colors[curColor++%colors.length]);
		}
	});
	
</script>
</head>
<body>
<?php include 'header.php'?>
	<h1 id="contact">Contact Us</h1>
	<?php include 'menu.php'; ?>
	<div id="contacts">
	<?php
	$contacts = array(
		"VIC" => array(
		"Phone"=>"1234567890",
		"Fax"=>"0987654321"
		),
		"NSW" => array(
		"Phone"=>"1234567890",
		"Fax"=>"0987654321"
		),
		"SA" => array(
		"Phone"=>"1234567890",
		"Fax"=>"0987654321"
		),
		"WA" => array(
		"Phone"=>"1234567890",
		"Fax"=>"0987654321"
		),
		"ACT" => array(
		"Phone"=>"1234567890",
		"Fax"=>"0987654321"
		),
		"NT" => array(
		"Phone"=>"1234567890",
		"Fax"=>"0987654321"
		),
		"QLD" => array(
		"Phone"=>"1234567890",
		"Fax"=>"0987654321"
		),
		"TAS" => array(
		"Phone"=>"1234567890",
		"Fax"=>"0987654321"
		)
		);

		foreach($contacts as $state => $details){
		echo '
		<div class="contact">
			<h3>'.$state.'</h3>';
			echo '
			<ul type="square">
				';
				foreach($details as $item => $content)	{
				echo '
				<li>
					'.$item.':'.$content.'
				</li>';
				}
				echo '
			</ul>
			';
			echo '
		</div>
		';
		}
		?>
	</div>
	<div id='video'>
	<iframe width="853" height="480" src="//www.youtube-nocookie.com/embed/JSESlex8sSE" frameborder="0" allowfullscreen></iframe>
	</div>
	<?php include 'footer.php'; ?>
</body>
</html>