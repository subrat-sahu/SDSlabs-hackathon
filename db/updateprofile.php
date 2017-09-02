<?php
  if (isset($_POST['update']))
  {
  	$name = mysqli_real_escape_string($conn,$_POST['name']);
  	$roomno = mysqli_real_escape_string($conn,$_POST['roomno']);
  	$bhawan = mysqli_real_escape_string($conn,$_POST['bhawan']);
  	$mobileno = mysqli_real_escape_string($conn,$_POST['mobileno']);

  	$sql = "UPDATE users SET name='$name', room_no='$roomno', bhawan='$bhawan', mobile_no='$mobileno' WHERE enrollment_no=$enrollno ";
  	if (mysqli_query($conn,$sql) === TRUE)
    {
      $_SESSION['name'] = $name;
      echo "<div style='background-color:lightgreen; padding:2%; width: 100%; margin:2% 0; '>Information updated successfully</div>";
      if ($_SESSION['url'] === 0)
      header('refresh:2;url=main.php');
    }
    else
      echo "<div style='background-color:red; color:white; padding:2%; width: 100%; margin:2% 0;'>Error updating information</div>";
  }
?>