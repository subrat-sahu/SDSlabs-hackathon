<?php 
  session_name('admin');
  ini_set('session.cookie_path','/admin');
  session_set_cookie_params(60*60*24*5,'admin');
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Complain Register System</title>
	<?php
    if(!isset($_SESSION['ad_name']) && $_SESSION['ad_name'] == '')
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
        <a class="navbar-brand text-hide" href="ad_main.php">Brand Text
        </a>
      </div>
      <div id="navbar1" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="active"><a href="ad_main.php">Home</a></li>
          <li class="active"><a href="#"><?php echo $_SESSION['ad_name']; ?></a></li>
          <li class="active"><a href="#"><form method="post"><input type="submit" name="logout" value="Logout" class="btn btn-default">
            <?php 
              if (isset($_POST['logout']))
                {
                  session_destroy();
                  header('Location:index.php');
                }
            ?>
          </form></a></li>
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
                <h4><strong><?php echo $_SESSION['ad_name']; ?></strong></h4>
                <hr>
                <h4><strong><?php echo $_SESSION['ad_username']; ?></strong></h4>
                <hr>
                <h4><strong><?php echo $_SESSION['ad_type']; ?></strong></h4>
              </center>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include '../db/ad_complain_display.php'; ?>
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <span>
            <h3><b> <?php echo $_SESSION['ad_name']; ?></b></h3>
            <h3><b> <?php echo $_SESSION['ad_type']; ?></b></h3>
          </span>
          <hr>
          <span class="pull-left">
            <a href="#" class="btn btn-link" style="text-decoration:none;"><i class="fa fa-fw fa-users" aria-hidden="true"></i> Complaints <span class="badge"><?php echo $noOfComp ?></span></a>
          </span>
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
        <h5><b>Room No: '. $rowcomp["room_no"] . '&nbsp;&nbsp;&nbsp; Mobile No: '. $rowcomp['mobile_no'].'
        </b><span style="float:right;">'; if($rowcomp['comp_status'] == 1){echo '<i class="fa fa-check" aria-hidden="true" style="color:green; font-size:28px;"></i>';} echo '</span></h5></div>
      </div>';
    }
      ?>
    
    </div>

  </div>
  </div>

</body>
</html>