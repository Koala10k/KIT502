<?php

echo "
<link rel='stylesheet' type='text/css' href='./menu.css' />
<div id='cssmenu'>
<ul>
   <li><a href='./index.php'><span>Home</span></a></li>
   <li><a href='./people.php'><span>People</span></a></li>
   <li><a href='./survey.php'><span>Online Survey</span></a></li>
   <li><a href='./contact.php'><span>Contact</span></a></li>
</ul>
</div>
<script>
$('#cssmenu').prepend('<div id=\"menu-button\">Menu</div>');
	$('#cssmenu #menu-button').on('click', function(){
		var menu = $(this).next('ul');
		if (menu.hasClass('open')) {
			menu.removeClass('open');
		}
		else {
			menu.addClass('open');
		}
	});
</script>
";

?>