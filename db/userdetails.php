<?php
	
	include 'connection.php';

	$enrollno = $_SESSION['enrollno'];
	$sql = "SELECT * FROM users WHERE enrollment_no='$enrollno' ";
	$query = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($query);

	$user_name = $row['name'];
	$user_enrollno = $row['enrollment_no'];
	$user_roomno = $row['room_no'];
	$user_bhawan = $row['bhawan'];
	$user_mobileno = $row['mobile_no'];
	$user_email = $row['email'];

?>