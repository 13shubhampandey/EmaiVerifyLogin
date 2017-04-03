<?php
session_start();
include_once 'database_connection.php';

if(!isset($_SESSION['user']))
{
	header("Location: login.php");
}
$res=mysqli_query($dbc,"SELECT * FROM users WHERE userid=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
?>
<html>
<head>
<title>Successful</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

  <h2>hello <?php echo $userRow['username']; ?>&nbsp;<a href="logout.php?logout">Log Out</a>
</h2>

</body>
</html>
