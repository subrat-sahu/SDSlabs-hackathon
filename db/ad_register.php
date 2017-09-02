<?php 
	
	include 'connection.php';

	if (isset($_POST['register']))
	{ 
		$name = mysqli_real_escape_string($conn,$_POST['name']);
		$username = mysqli_real_escape_string($conn,$_POST['username']);
		$ad_type = $_POST['ad_type'];
		$password = mysqli_real_escape_string($conn,$_POST['password']);
		$cpassword = mysqli_real_escape_string($conn,$_POST['cpassword']);
		$ad_flag = mysqli_real_escape_string($conn,$_POST['ad_flag']);
		if ($ad_flag === 'BCRS{w0w_y0u_4r3_4dm1n_n0w_w3lc0m3_4nd_d0n7_f0r637_70_53rv3}' && $password === $cpassword)
		{
			$hashed_password = hash('sha256',$password);
			$sql = "INSERT INTO admin_users (name,username,admin_type,password) VALUES ('$name', '$username', '$ad_type','$hashed_password')";
			if (mysqli_query($conn,$sql) === TRUE)
			{
				$_SESSION['ad_name'] = $name;
				$_SESSION['ad_username'] = $username;
				$_SESSION['ad_type'] = $ad_type;
				header('Location:../admin/ad_main.php');
			}
			else
				echo "<p style='color:red;'>User already registered</p>\n";
		}
		else
			echo "<p style='color:red'>Password not matched</p>";
	}

 ?>