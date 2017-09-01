<?php

	session_start();

	include 'connection.php';

	if(isset($_POST['login']))
	{
		$enrollNo = mysqli_real_escape_string($conn,$_POST['enrollNo']);
		$password = mysqli_real_escape_string($conn,$_POST['passwd']);
		$hashed_password = hash('sha256',$password);
		$sql = "SELECT enrollment_no,password FROM users WHERE enrollment_no = '$enrollNo' AND password = '$hashed_password' ";
		$result = mysqli_query($conn,$sql);
		if (mysqli_num_rows($result))
		{
			$sqln = "SELECT name FROM users WHERE enrollment_no = '$enrollNo' ";
			$name = mysqli_query($conn,$sqln);
			$row = mysqli_fetch_assoc($name);
			$_SESSION['name'] = $row['name'];
			$_SESSION['enrollno'] = $enrollNo;
			header('Location: ../public/main.php');
		}
		else
			echo "<p style='color:red'>Invalid enrollment no or password</p>";
	}

?>