<?php



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
<body>
	
<div class="container-fluid">
	<div class="col-sm-8">Current Period</span></div>
</div>
<div class="col-sm-8 col-sm-offset-1">
	<h1>Plan Next period</h1>
	<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#planasprevios" tooltip="Plan Next Period Base on a Period">Base on a Period</button>
	<div id="planasprevios" class="container-fluid collapse">
		<div class="col-sm-8">
			<label for="select-period">Select Base Period:</label>
			<select id="base-period">
				<option>1</option>
			</select>
		</div>
		<div class="col-sm-4">
			<button  type="button" class="btn btn-default"  onclick="planprevios(this)">Submit <span class="fa fa-arrow-right"></span></button>
		</div>
	</div>
	<h3>OR</h3>
	<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#bydate" tooltip="Plan Next Period Base on a Date">Base on a Date</button>
	<div  id="bydate" class="container-fluid collapse">
		<div class="col-sm-8">
			<label for="first-day">Select Plan First Day:</label>
			<input class="datepicker-input" type="text" id="first-day" placeholder="Pick a Date">
		</div>
		<div class="col-sm-4">
			<button  type="button" class="btn btn-default">Submit <span class="fa fa-arrow-right"></span></button>
		</div>
	</div>
</div>
<script>
	function planprevios(b) {
		$("input, select, button").prop("disabled",true);
		$(b).html("Please Wait   <span class='fa fa-spinner fa-spin'></span>");
	}
</script>
</body>