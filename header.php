<?php
include 'session.php';
$header="<header>";

if(!isset($_SESSION['username'])){
// 	$header .="";
	$header .="<a href='./sign_up.php'><span>Sign Up</span></a>";
}else{
	$header .="Welcome ".$_SESSION['username'].
			"!|<a href='./my_account.php'><span>My Account</span></a>
			|<a href='./sign_out.php'><span>Sign Out</span></a>";
}

if($_SESSION['access']==2){
	$header .= "|<a href='./admin.php'><span>Admin</span></a>";
}
$header .="</header>";

echo $header;
?>

