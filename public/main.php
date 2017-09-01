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

</body>
</html>