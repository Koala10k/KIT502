<?php
include 'session.php';
$header="<header>";

if(!isset($_SESSION['username'])){
 	$header .="<form action='./login.php' method='POST'>
<label>Username: </label>
<input type='text' name='username' />
<label>Password: </label>
<input type='password' name='password' />
<input type='submit' name='submit' value='Sign In' />
</form>";
	$header .="<span><a href='./sign_up.php'>Sign Up</a></span>";
}else{
	$header .="Welcome ".$_SESSION['name'].
			"!|<a href='./my_account.php'><span>My Account</span></a>
			|<a href='./sign_out.php'><span>Sign Out</span></a>";
}

if($_SESSION['access']==2){
	$header .= "|<a href='./admin.php'><span>Admin</span></a>";
}
$header .="</header>";

echo $header;
?>

