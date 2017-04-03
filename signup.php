<?php
session_start();
if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}
include_once 'database_connection.php';

if(isset($_POST['signup']))
{
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	$username = trim($username);
	$email = trim($email);
	$password = trim($password);

    $otp = substr(md5(uniqid(rand(),true)), 7, 6);
	// email exist or not
	$query = "SELECT email FROM users WHERE email='$email'";
	$result = mysqli_query($dbc,$query);

	$count = mysqli_num_rows($result); // if email not found then register

	if($count == 0){

		if(mysqli_query($dbc,"INSERT INTO users(username,email,password,otp) VALUES('$username','$email','$password','$otp')"))
		{
			$message = " To activate your account, please enter the otp :\n\n";
                $message .=  "$otp";
                mail($email, 'Registration Confirmation', $message, 'From: i.pandeyshubh@gmail.com');

                // Flush the buffered output.


                // Finish the page:
                echo 'Thank you for
                     registering! A confirmation email
                 has been sent to '.$email.' Please enter the otp sent to you to Activate your account ';

		}
		else
		{
			?>
			<script>alert('error while registering you...');</script>
			<?php
		}
	}
	else{
			?>
			<script>alert('Sorry Email ID already taken ...');</script>
			<?php
	}
mysqli_close($dbc);
}
?>

<html >
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
<td><label>USERNAME : </label><input type="text" name="username" placeholder="User Name" required /></td>
</tr>
<tr>
<td><label>EMAIL : </label><input type="email" name="email" placeholder="Your Email" required /></td>
</tr>
<tr>
<td><label>PASSWORD : </label><input type="password" name="password" placeholder="Your Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="signup">YES! SignUp</button></td>
</tr>
<tr>
<td><a href="login.php">Sign In Here</a></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
