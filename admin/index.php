<?php
	session_name('admin');
	ini_set('session.cookie_path','/admin');
 	session_set_cookie_params(60*60*24*5,'admin'); 
	session_start()	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login-Register</title>
	<?php 
		if(isset($_SESSION['ad_name']) && $_SESSION['ad_name'] != '')
		{
			header('Location:ad_main.php');
			exit();
		}
	?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../style/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato" />
	<link rel="stylesheet" type="text/css" href="../style/css/style.css">
</head>
<body>
	<div class="container">
		<center>
			<div class=head>
				<h1><b>App-Name</b></h1>
				<h3>Some text</h3>
			</div>
		</center>
		
		<div class="row">
			<div class="col-md-5 col-lg-5">
				<div class="logindiv">
					<div class="loginhead"><span>Login to our site </span><i class="fa fa-lock"></i> </div>
					<div class="inputhead">
						<form action method="post">
							<div class="form-group"><input type="text" name="username" required class="form-control" placeholder="Username"></div>
							<div class="form-group"><input type="password" name="passwd" required class="form-control" placeholder="Password"></div>
							<?php include '../db/ad_login.php' ?>
							<input type="submit" name="login" class="btn btn-lg btn-danger btn-block" value="Login" >
						</form>	
					</div>
				</div>
			</div>
			
			<div class="col-md-1 col-lg-1"></div>
			<div class="col-md-1 col-lg-1"></div>
			
			<div class="col-md-5 col-lg-5">
				<div class="registerdiv">
					<div class="loginhead"><span>Sign Up Now</span> <i class="fa fa-pencil"></i></div>
					<div class="inputhead">
						<form action method="post">
							<div class="form-group"><input type="text" name="name" required="" class="form-control" placeholder="Name"></div>
							<div class="form-group"><input type="text" name="username" required="" class="form-control" placeholder="Username"></div>
							<div class="form-group"><select name="ad_type" class="form-control" required>
								<option value="">Select Job</option>
								<option value="Carpenter">Carpenter</option>
								<option value="Electrician">Electrician</option>
							</select></div>
							<div class="form-group"><input type="password" name="password" required="" class="form-control" placeholder="Password"></div>
							<div class="form-group"><input type="password" name="cpassword" required="" class="form-control" placeholder="Confirm Password"></div>
							<div class="form-group"><input type="password" name="ad_flag" required="" class="form-control" placeholder="Admin Flag"></div>
							<?php include '../db/ad_register.php' ?>
							<input type="submit" name="register" class="btn btn-lg btn-danger btn-block" value="Register">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>