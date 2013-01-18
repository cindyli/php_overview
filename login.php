<?php
include("include/config.php");

session_start();

if(isset($_POST["username"]))
{
	// username and password sent from Form
	$myusername=addslashes($_POST['username']);
	
	$sql="SELECT user_id FROM users WHERE username='$myusername'";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	
	// If result matched $myusername and $mypassword, table row must be 1 row
	if(mysql_num_rows($result) == 0)
	{
		$sql = "INSERT INTO users(username) VALUES ('" . $myusername . "')";
		$result=mysql_query($sql);
	}
	$_SESSION['login_user'] = $myusername;
	
	header("location: add_places.php");
	exit;
}

?>

<form action="" method="post">
    <label>UserName :</label>
    <input type="text" name="username" /><br />
    
    <input type="submit" value=" Submit "/><br />
</form>