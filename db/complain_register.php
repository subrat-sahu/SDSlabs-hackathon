<?php

	include 'connection.php';
	include 'userdetails.php';

	if(isset($_POST['post_complain']))
	{
		$comp_type = $_POST['comp_type'];
		$comp_text = mysqli_real_escape_string($conn,$_POST['comp_text']);
		$comp_status = 0;
		$enrollno = $_SESSION['enrollno'];
		$date = date("Y-m-d");
		$timef = date("h:i:sa");
		$time = substr($timef,0,8);
		$comp_meri = substr($timef,8);

		$sql = "INSERT INTO complain (comp_type, comp_text, comp_date, comp_time, meridiem, comp_status, enrollment_no, room_no, mobile_no) VALUES ('$comp_type', '$comp_text', '$date', '$time', '$comp_meri', '$comp_status', '$enrollno', '$user_roomno', '$user_mobileno') ";

		if (mysqli_query($conn,$sql) === TRUE)
		{
			echo "<div style='background-color:lightgreen; padding:1%; margin:2% 0;'>Complain registered successfully</div>";
		}
		else
			{
				echo "<div>Error</div>";
				print($sql);
				echo mysqli_error($conn);
			}
	}

?>