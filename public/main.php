

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
    


    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="media">
            <div align="center">
              <img class="thumbnail img-responsive" src="https://lut.im/7JCpw12uUT/mY0Mb78SvSIcjvkf.png" width="300px" height="300px">
            </div>
            <div class="media-body">
              <center>
                <hr>
                <h4><strong></strong></h4>
                <hr>
                <h4><strong></strong></h4>
                <hr>
                <h4><strong></strong></h4>
                <hr>
                <h4><strong></strong></h4>
                <hr>
                <h4><strong></strong></h4>
                <hr>
                <h4><strong></strong></h4>
              </center>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <span>
            <h3><b> </b></h3>
            <h3><b> </b></h3>
          </span>
          <hr>
          <span class="pull-left">
            <a href="#" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-fw fa-users" aria-hidden="true"></i> Complaints <span class="badge">2</span></a>
          </span>
        </div>
      </div>
      <hr>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="pull-left">
            <a href="#">
              <img class="media-object img-circle" src="https://lut.im/7JCpw12uUT/mY0Mb78SvSIcjvkf.png" width="50px" height="50px" style="margin-right:8px; margin-top:-5px;">
            </a>
          </div>
          <h4><a href="#" style="text-decoration:none;"><strong></strong></a>  <small><small><a href="#" style="text-decoration:none; color:grey;"><i><i class="fa fa-clock-o" aria-hidden="true"></i> 42 minutes ago</i></a></small></small></h4>
          <hr>
          <div class="post-content">
          </div>
          <hr>
          <div>
            <div class="pull-right btn-group-xs">
              <a class="btn btn-default btn-xs">Completed</a>
            </div>
            <div class="pull-left">
              <p class="text-muted" style="margin-left:5px;"><i class="fa fa-globe" aria-hidden="true"></i> {{user.compType}}</p>
            </div>
            <br>
          </div>
        </div>
      </div>
    </div>

  </div>
  </div>

</body>
</html>
