<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
        <?php include 'common_refer.php'; ?>
        <title>Index</title>
<script>
            $(document).ready(function (){
            $("#cur_time").text(new Date().toLocaleString());
            setInterval(function(){$("#cur_time").text(new Date().toLocaleString())}, 1000);
            $('#cssmenu li:eq(0)').addClass('active');
});
        </script>
</head>
<body>
<?php include 'header.php';	?>
	<h1 id="index">Home</h1>
        <?php include 'menu.php'; ?>
        <div class="container">
		<p class="marquee">
		<b>What Panda does in a cafe</b><br />
			A panda walks into a cafe. He orders a sandwich, eats it, then draws a gun and fires two shots in the air. 
"Why?" asks the confused waiter, as the panda makes towards the exit. 
The panda produces a badly punctuated wildlife manual and tosses it over his shoulder. "I'm a panda," he says, at the door. 
"Look it up." The waiter turns to the relevant entry and, sure enough, finds an explanation... 
"Panda. Large black-and-white bear-like mammal, native to China. Eats, shoots and leaves."
		<br /><b>Saving method</b><br />
An uncle has been waiting for the bus at the bus stops. After few minutes, the bus arrives but did not stop at the bus stop. The uncle thought it will stop a bit further so he start running after the bus.
Unfortunately, the bus never stop. It keeps running. The uncle keeps following the bus until he realizes that he arrives home already. 
The uncle is very happy that he can save a bit of money today. He happily told his wife "Honey, you know, today I ran after the bus until arriving home. I don't have to pay the bus fee"
"Stupid" instead of compliment, the wife surprisingly blames her husband. "Do you know how much you can save, if you ran after taxi!!" 
		</p>
	</div>
	<div id="cur_time"></div>
	<?php include 'footer.php'; ?>
</body>
</html>
