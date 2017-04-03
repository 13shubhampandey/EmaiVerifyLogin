<?php
session_start();
include_once 'database_connection.php';

if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}

if(isset($_POST['login']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];

	$email = trim($email);
	$password = trim($password);

	$res=mysqli_query($dbc,"SELECT userid, username, password, activation FROM users WHERE email='$email'");
	$row=mysqli_fetch_array($res);

	$count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row

	if($count == 1 && $row['password']== $password && $row['activation']=="yes")
	{
		$_SESSION['user'] = $row['userid'];
		header("Location: home.php");
	}
	else
	{
		echo 'Username / Password Seems Wrong !';
	}

}
?>
<html>
<head>
<title>Email verify login</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<center>
<div id="login-form">
<form method="post">
<table align="center" width="30%" border="0">
<tr>
<td><label>EMAIL : </label><input type="text" name="email" placeholder="Your Email" required /></td>
</tr>
<tr>
<td><label>PASSWORD : </label><input type="password" name="password" placeholder="Your Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="login">Login</button></td>
</tr>
<tr>
<td><a href="signup.php">Sign Up Here</a></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
