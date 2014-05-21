<?php
include 'session.php';
$header="<header>";

if(!isset($_SESSION['username'])){
 	$header .="<form id='login_form' action='./login.php' method='POST'>
<label>Username: </label>
<input type='text' name='username' />
<label>Password: </label>
<input type='password' name='password' />
<input type='submit' name='submit' value='Sign In' />
</form>";
	$header .="<div id='sign_up'><a href='./sign_up.php'><span>Sign Up</span></a></div>";
}else{
	$header .="Welcome ".$_SESSION['name'].
			"!|<a href='./my_account.php'><span>My Account</span></a>
			|<a href='./sign_out.php'><span>Sign Out</span></a>";
}

if(isset($_SESSION['access']) && $_SESSION['access']==1){
	$header .= "|<a href='./admin.php'><span>Admin</span></a>";
}
$header .="</header>";

echo $header;
?>

