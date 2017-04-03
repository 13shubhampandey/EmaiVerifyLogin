<?php
session_start();
include_once 'database_connection.php';

if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}

if(isset($_POST['activate']))
{
	$email = $_POST['email'];
	$otp = $_POST['otp'];

	$email = trim($email);
	$otp = trim($otp);

	$res=mysqli_query($dbc,"SELECT * FROM users WHERE email='$email'");
	$row=mysqli_fetch_array($res);

	$count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row

	if($count == 1 && $row['otp']==($otp))
	{          $active="yes";
		    $query_activate_account = "UPDATE users SET activation='$active' WHERE email ='$email'";


            $result_activate_account = mysqli_query($dbc, $query_activate_account) ;

                echo 'Your account is active. You can now <a href="login.php">Log in</a></div>';



              mysqli_close($dbc);
	}
	else
	{

        echo 'You entered wrong otp or email !';

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
<td><label>OTP : </label><input  name="otp" placeholder="Your otp" required /></td>
</tr>
<tr>
<td><button type="submit" name="activate">Activate</button></td>
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
