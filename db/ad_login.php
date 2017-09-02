<?php

	include 'connection.php';

	if(isset($_POST['login']))
	{
		$username = mysqli_real_escape_string($conn,$_POST['username']);
		$password = mysqli_real_escape_string($conn,$_POST['passwd']);
		$hashed_password = hash('sha256',$password);
		$sql = "SELECT username,password FROM admin_users WHERE username = '$username' AND password = '$hashed_password' ";
		$result = mysqli_query($conn,$sql);
		if (mysqli_num_rows($result))
		{
			$sqln = "SELECT * FROM admin_users WHERE username = '$username' ";
			$name = mysqli_query($conn,$sqln);
			$row = mysqli_fetch_array($name);
			$_SESSION['ad_name'] = $row['name'];
			$_SESSION['ad_username'] = $username;
			$_SESSION['ad_type'] = $row['admin_type'];
			header('Location: ../admin/ad_main.php');
		}
		else
			echo "<p style='color:rgb(170,0,0)'><b>Invalid enrollment no or password</b></p>";
	}

?>