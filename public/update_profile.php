<?php 
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Complain Register System</title>
	<?php
		if(!isset($_SESSION['name']) && $_SESSION['name'] == '')
		{
			header('Location:index.php');
			exit();
		}
	?>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../style/css/main.css">
	<script src="../style/bootstrap/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../style/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

	<nav class="navbar navbar-inverse navbar-static-top navig">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand text-hide" href="#">Brand Text
        </a>
      </div>
      <div id="navbar1" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="active"><a href="main.php">Home</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['name']; ?><span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="update_profile.php">Update Profile</a></li>
              <li class="divider"></li>
              <li><a href="#"><form action method="post">
              	<input type="submit" name="logout" value="Logout">
              	<?php
									if (isset($_POST['logout']))
									{
										session_destroy();
										header('Location:index.php');
									}
								?>
              </form></a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
  </nav>

  <div class="container-fluid">
  	<div class="row">
  		<div class="col-lg-3 col-md-3 hidden-sm hidden-xs"></div>
  		<div class="col-lg-6 col-md-6">
  		<?php

  			include '../db/connection.php';
  			$name = $_SESSION['name'];
  			$enrollno = $_SESSION['enrollno'];

  		?>
  			<h3 class="page-header">Update your Details...</h3>
  				<form method="post" action>
  					<div class="form-group">
  					<label for="name">Name:</label>
  					<input type="text" name="name" value="<?php echo $name; ?>" class="form-control">
  					</div> 
  					<div class="form-group">
  					<label for="name">Room No:</label>
  					<input type="text" name="roomno" value="" class="form-control">
  					</div> 
  					<div class="form-group">
  					<label for="name">Bhawan:</label>
  					<input type="text" name="bhawan" value="" class="form-control">
  					</div>  
  					<div class="form-group">
  					<label for="name">Mobile No.:</label>
  					<input type="tel" name="mobileno" value="" class="form-control">
  					</div> 
  					<div class="form-group">
  						<input type="submit" name="update" value="Update" class="btn btn-lg btn-primary">
  					</div>
  				</form>
  				<?php

  					if (isset($_POST['update']))
  					{
  						$name = mysqli_real_escape_string($conn,$_POST['name']);
  						$roomno = mysqli_real_escape_string($conn,$_POST['roomno']);
  						$bhawan = mysqli_real_escape_string($conn,$_POST['bhawan']);
  						$mobileno = mysqli_real_escape_string($conn,$_POST['mobileno']);

  						$sql = "UPDATE users SET name='$name', room_no='$roomno', bhawan='$bhawan', mobile_no='$mobileno' WHERE enrollment_no='$enrollno' ";
  						
  						
  					}

  				?>
  		</div>
  		<div class="col-lg-3 col-md-3 hidden-sm hidden-xs"></div>
  	</div>
  </div>

</body>
</html>