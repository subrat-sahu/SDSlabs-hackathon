<?php 
	
	include 'connection.php';

	if (isset($_POST['register']))
	{ 
		$name = $_POST['name'];
		$enrollmentNo = $_POST['enrollmentNo'];
		$email = $_POST['email'];
		$password = mysqli_real_escape_string($conn,$_POST['password']);
		$cpassword = mysqli_real_escape_string($conn,$_POST['cpassword']);
		if ($password === $cpassword)
		{
			$hashed_password = hash('sha256',$password);
			$sql = "INSERT INTO users (name,enrollment_no,email,password) VALUES ('$name', '$enrollmentNo', '$email', '$hashed_password')";
			if (mysqli_query($conn,$sql) === TRUE)
			{
				$_SESSION['name'] = $name;
				$_SESSION['enrollno'] = $enrollmentNo;
				$_SESSION['url'] = 0;
				header('Location:../public/update_profile.php');
			}
			else
				echo "<p style='color:red;'>User already registered</p>\n";
		}
		else
			echo "<p style='color:red'>Password not matched</p>";
	}

 ?>