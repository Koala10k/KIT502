<?php
	$mysqli = new mysqli("131.217.36.2", "pengd", "207071", "pengd");
	
	if(mysql_connect_errno()){
		printf("Connection failed: %s\n", mysql_connect_error());
	}
?>