
<!DOCTYPE html>
<html>
<head>
	<title>Complain Register System</title>
	
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
        <a class="navbar-brand text-hide" href="main.php">Brand Text
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
  		
  			<h3 class="page-header">Update your Details...</h3>
  				<form method="post" action>
  					<div class="form-group">
  					<label for="name">Name:</label>
  					<input type="text" name="name" value="" class="form-control" required>
  					</div> 
  					<div class="form-group">
  					<label for="name">Room No:</label>
  					<input type="text" name="roomno" value="" class="form-control" required>
  					</div> 
  					<div class="form-group">
  					<label for="name">Bhawan:</label>
  					<input type="text" name="bhawan" value="" class="form-control" required>
  					</div>  
  					<div class="form-group">
  					<label for="name">Mobile No.:</label>
  					<input type="tel" name="mobileno" value="" class="form-control" required>
  					</div> 
  					<div class="form-group">
  						<input type="submit" name="update" value="Update" class="btn btn-lg btn-primary">
  					</div>
  				</form>
  				

          
          <div class="jumbotron">
            <h2 class="page-header">Change password</h2>
            <form action method="post">
              <div class="form-group"><input type="password" name="curpassword" class="form-control" required placeholder="Current Password"></div>
              <div class="form-group"><input type="password" name="newpassword" class="form-control" required placeholder="New Password"></div>
              <div class="form-group"><input type="password" name="confpassword" class="form-control" required placeholder="Confirm new Password"></div>
              <input type="submit" name="change" class="btn btn-lg btn-danger" value="Change">
            </form>

          </div>
          
  		</div>

  		<div class="col-lg-3 col-md-3 hidden-sm hidden-xs"></div>
  	</div>
  </div>

</body>
</html>
