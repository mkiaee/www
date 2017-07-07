<?php  
// session conrol code
require_once('include/connect-db.php');
require_once('include/loginfunction.php');
session_start();
$mysqli=pr_connect();
	
if (login_check($mysqli)) {
	$username = $_SESSION['username'];
	$user_friendly_name = $_SESSION['user_friendly_name'];
	$user_discipline = $_SESSION['user_discipline'];
	$user_discipline_name = $_SESSION['user_discipline_name'];
	
	//$_SESSION['login_string'] 
} else {
	header('Location: /login.php?error=5');
}
?>
<!-- sidenav -->
	<nav class="pr-side-nav w3-sidenav w3-collapse w3-white w3-animate-left" id="pr-left-nav">
		<div class="w3-container w3-row" id="user-area">
			<span><?php echo $user_friendly_name; ?></span><br />
			<span><i><?php echo $user_discipline_name; ?></i></span><a href="login.php?error=6">  Logout  </a>
		</div>
		<hr> <!-- change in row - no need to close -->
		<!-- Menu items -->

		<a href="/" class="pr-menu-item w3-padding"><i class="fa fa-dashboard"></i> Dashboard</a>
		<a href="#" class="w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
		<a href="/index.php?page=eqlist" class="pr-menu-item w3-padding" ><i class="fa fa-list"></i> List of Equipment</a>
		<a href="/index.php?page=dailyreport" class="pr-menu-item w3-padding"><i class="fa fa-flag"></i> Daily Plan</a>
		<a href="/index.php?page=analyticalreport" class="pr-menu-item w3-padding"><i class="fa fa-book"></i> Analytical Report</a>
		<a href="/index.php?page=workorder" class="pr-menu-item w3-padding"> Work Order</a>
		<!-- <a href="#" class="pr-menu-item w3-padding"> Log Sheet</a> -->
	</nav>