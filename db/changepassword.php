<?php

	if (isset($_POST['change']))
	{
		$original_password = "SELECT password FROM users WHERE enrollment_no = '$enrollno' ";
		$sql1 = mysqli_query($conn,$original_password);
		$row = mysqli_fetch_assoc($sql1);
		$ori_password = $row['password'];
		$curpassword = mysqli_real_escape_string($conn,$_POST['curpassword']);
		$curpassword = hash('sha256',$curpassword);
		if ($curpassword !== $ori_password)
		{
			//echo "<p style='color:red;'>Incorrect current password</p>";
			//exit();
			echo "<p style='color:red;'>Incorrect current password</p>";
		}
		else
		{
			$newpassword = mysqli_real_escape_string($conn,$_POST['newpassword']);
			$confpassword = mysqli_real_escape_string($conn,$_POST['confpassword']);

			if ($newpassword !== $confpassword)
			{
				//echo "<p style='color:red;'>Current password not matched</p>";
				//exit();
				echo "<p style='color:red;'>New password not matched</p>";
			}
			else
			{
				$hashed_password = hash('sha256', $newpassword);
				$sql2 = "UPDATE users SET password='$hashed_password' WHERE enrollment_no='$enrollno' ";
				if (mysqli_query($conn,$sql2) === TRUE)
				{
					echo "<p style='color:green;'>Password updated successfully</p>";
				}
			}	
		}
	}

?>