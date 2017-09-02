<?php 
	session_start();
  $_SESSION['url'] = 1;
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
    
  <?php include '../db/userdetails.php'; ?>

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
                <h4><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;<strong><?php echo $user_name; ?></strong></h4>
                <hr>
                <h4><i class="fa  fa-mortar-board"></i>&nbsp;&nbsp;&nbsp;<strong><?php echo $user_enrollno; ?></strong></h4>
                <hr>
                <h4><i class="fa  fa-building"></i>&nbsp;&nbsp;&nbsp;<strong><?php echo $user_roomno; ?></strong></h4>
                <hr>
                <h4><i class="fa  fa-phone"></i>&nbsp;&nbsp;&nbsp;<strong><?php echo $user_mobileno; ?></strong></h4>
                <hr>
                <h4><i class="fa  fa-bank"></i>&nbsp;&nbsp;&nbsp;<strong><?php echo $user_bhawan; ?></strong></h4>
                <hr>
                <h4><i class="fa fa-envelope"></i>&nbsp;&nbsp;&nbsp;<strong><?php echo $user_email; ?></strong></h4>
              </center>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include '../db/complain_display.php'; ?>
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <span>
            <h3><b><?php echo $user_name; ?> </b></h3>
            <h3><b><?php echo $user_enrollno; ?> </b></h3>
          </span>
          <hr>
          <span class="pull-left">
            <a href="#" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-fw fa-user-circle" aria-hidden="true"></i> Complaints <span class="badge"><?php echo $noOfComp; ?></span></a>
          </span>
        </div>
      </div>
      
      <div class="panel panel-primary">
        <div class="panel-heading"><h4><b>Post your complain...</b></h4></div>
        <div class="panel-body">
          <form action method="post">
            <div class="form-group">
              <label for="type">Complain Type</label>
              <select class="form-control" name="comp_type" required>
                <option value="">Select type.....</option>
                <option value="Carpenter">Carpenter</option>
                <option value="Electrician">Electrician</option>
              </select>
            </div>
            <div class="form-group">
              <label for="comp_type">Complain</label>
              <textarea rows="3" name="comp_text" class="form-control" required></textarea>
            </div>
            <div class="form-group"><input type="submit" name="post_complain" class="btn btn-lg btn-primary"></div>
            <?php include '../db/complain_register.php'; ?>
          </form>
        </div>
      </div>

      <?php 
      
      while ($rowcomp = mysqli_fetch_array($result)){
      echo '
      <div class="panel'; if($rowcomp['comp_status'] == 0){echo ' panel-danger';} if($rowcomp['comp_status'] == 1){echo ' panel-success';} echo '" style="margin-top:2%;">
        <div class="panel-heading">
          <h4 style="color:black;"><strong>Complaint-ID: '.$rowcomp["comp_id"].'</strong>&nbsp;&nbsp;&nbsp;Type: '. $rowcomp["comp_type"].'<i style="float:right"> <i class="fa fa-clock-o"> </i>  '. calc_time((strtotime($cur_time) - strtotime($rowcomp["comp_time"]))) . show_time($type). '</i></h4>
        </div>
        <div class="panel-body">
          <p>'.htmlspecialchars($rowcomp["comp_text"]).'</p>
        </div>
        <div class="panel-footer">
        <h5><b>Room No: '. $row['room_no']. '&nbsp;&nbsp;&nbsp; Mobile No: '. $row['mobile_no'].'
        </b><span style="float:right;">'; if($rowcomp['comp_status'] == 0){echo '<form method="post"><button type="submit" class="btn btn-md btn-primary" name="'.$rowcomp["comp_id"].'">Mark as complete</button></form>';} if($rowcomp['comp_status'] == 1){echo '<i class="fa fa-check" aria-hidden="true" style="color:green; font-size:28px;"></i>';} echo '</span></h5></div>
      </div>';
      $complain_id = $rowcomp['comp_id'];
      if(isset($_POST[$complain_id]))
      {
        $c_id = $complain_id; 
        $sql12 = "UPDATE complain SET comp_status = 1 WHERE comp_id = '$c_id' ";
        if (mysqli_query($conn,$sql12) === TRUE){ }
      }
    }
      ?>
    
    </div>
  </div>
  </div>

</body>
</html>