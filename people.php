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
                })
            });
        </script>
</head>
<body>
	<h1 id="people">People</h1>
	<?php include 'menu.php'; ?>
		<div class="people">
			<img alt="Bart_Simpson" src="./res/Bart_Simpson.png" />
			<img alt="Marge_Simpson" src="./res/Lisa_Simpson.png" />
			<img alt="Homer_Simpson" src="./res/Homer_Simpson.png" />
		</div>
		<div class="info"></div>
</body>
</html>
