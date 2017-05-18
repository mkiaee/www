<?php  
require_once('include/loginfunction.php');
//session_start();

// Page Control Part. Gets the page name, includes the parts and so on
if ($_SERVER['REQUEST_METHOD'] == "GET") {
	if (!isset($_GET['page'])) {
		$Page = "overview";
		$args = "'home'";
	} else {
		switch ($Page = $_GET['page']) {
			case 'plan':
				$args = array('day'=>$_GET['day']);
				$args = json_encode($args);
				break;
			case 'workorder':
				$args = "'home'";
				break;
			
			default:
				$Page = "overview";
				$args = '""';
				break;
		}
	}
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Preservation Database</title>
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
	
	<script type="text/javascript" src=scripts/prscripts.js></script>
</head>
<body class="w3-light-gray">
	<!-- Top Container -->
	<?php require_once('pages/topbar.php'); ?>
	<!-- sidenav -->
	<?php require_once('pages/sidenav.php'); ?>

    <!-- Overlay effect when opening sidenav on small screens -->
	<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
	<!-- main content,,,,, am i using an iframe? -->
	<div class="pr-main w3-main" id="mainContent">


	</div>
<script type="text/javascript">
	$(document).ready(function(){
		var pageContent ="pages/"+'<?php echo $Page; ?>'+".php";
		var args = <?php echo $args; ?>;
		$.get(pageContent,args,function(gdata,status){
			$('#mainContent').empty();
			$('#mainContent').append(gdata);
		});
		
	})

</script>
</body>
</html>