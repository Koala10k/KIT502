<?php
session_start();

if(!isset($_SESSION['username'])){
	$session_user="";
}else{
	$session_user=$_SESSION['username'];
}

if(!isset($_SESSION['access'])){
	$session_access="";
}else{
	$session_access=$_SESSION['access'];
}
?>