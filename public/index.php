
<!DOCTYPE html>
<html>
<head>
	<title>Login-Register</title>
	
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
							<div class="form-group"><input type="number" name="enrollNo" required class="form-control" placeholder="Enrollment No."></div>
							<div class="form-group"><input type="password" name="passwd" required class="form-control" placeholder="Password"></div>
							
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
							<div class="form-group"><input type="number" name="enrollmentNo" required="" class="form-control" placeholder="Enrollment No"></div>
							<div class="form-group"><input type="email" name="email" required="" class="form-control" placeholder="Email"></div>
							<div class="form-group"><input type="password" name="password" required="" class="form-control" placeholder="Password"></div>
							<div class="form-group"><input type="password" name="cpassword" required="" class="form-control" placeholder="Confirm Password"></div>

							<input type="submit" name="register" class="btn btn-lg btn-danger btn-block" value="Register">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
