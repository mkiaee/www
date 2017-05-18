<?php
	require_once("include/connect-db.php");
	require_once("include/loginfunction.php");


	session_start();
	echo "session_id()= ".session_id();
	if (isset($GET['error'])) {
		switch ($e = $GET['error']) {
			case 1:
				$errmsg ='User is Disabled. Please contact Administrator';
				break;
			case 3:
				$errmsg = 'Wrong Password';
				break;
			case 4:
				$errmsg = 'User dosenot exists';
				break;
			
			default:
				$errmsg ='';
				break;
		}
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Plaese Log In</title>
	<meta charset="utf-8">
	<meta name="veiwport" content="width=device-width, initial-scale=1">
	<base href="/">
	<!-- jquery -->
	<script src="vendor/jQuery/jquery-3.1.1.min.js"></script>

	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<script src="vendor/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

	<!-- bootstrap datepicker -->
	<link rel="stylesheet" type="text/css" href="vendor/bsdatepicker/css/bootstrap-datepicker.min.css">
	<script src = "vendor/bsdatepicker/js/bootstrap-datepicker.min.js"></script>

	<!-- font awsome -->
	<link rel="stylesheet" href="vendor/font-awsome/css/font-awesome.min.css">
	<!-- w3 -->
	<link rel="stylesheet" type="text/css" href="vendor/w3/css/w3.css">


	<link rel="stylesheet" type="text/css" href="css/preserve.css">
	
	<script type="text/javascript" src="scripts/prscripts.js"></script>
<!-- 	<script type="text/javascript" src="scripts/sha512.js" ></script>
	<script type="text/javascript" src="scripts/form.js" ></script> -->
</head>
<body class="w3-light-gray">
	<div class="wrapper">
		<div class="header text-center container-fluid">
			<img src="bin/img/oico.png" alt="oico">
		</div>
		<div class="login-box w3-white center-block container-fluid">
			<div class="header text-center container-fluid">
				<h2>PRESERVATION DATABASE</h2>
				<h4>Please Log-in</h4>
			</div>
			<div>
				<form class="form-horizontal" method="post" action="/include/process_login.php">
					<div class="form-group">
						<label class="control-label col-sm-1" for="username"><i class="glyphicon glyphicon-user"> </i></label>
						<div class="col-sm-11">
							<input class="form-control" type="text" name="username" id="username" placeholder="User Name">
						</div>
					</div>
					<div class="form-group">					
						<label class="control-label col-sm-1" for="password"><i class="glyphicon glyphicon-lock"> </i></label>
						<div class="col-sm-11">
							<input class="form-control" type="password" name="password" id="password" placeholder="password">
						</div>
					</div>
					<div class="form-group">

						<div class="container-fluid pull-right">
							<button id="login_btn" class="btn bt-default pr-oico" role="submit"><i class="fa fa-sign-in"></i>  Sign in</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>