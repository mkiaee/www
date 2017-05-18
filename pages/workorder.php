<?php
session_start();






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
<div class="container-fluid  w3-card-4 p-padding-5 margin-bottom-10" id="eq-select">
	<div class="col-sm-2">
		<div class="wstep">1</div>
	</div>

	<div class="col-sm-10">
		<div class="container-fluid row" id="searchbox">
			<label class="control-label col-sm-3 input-group input-group-lg" for="searchtext"> Search For Equipment </label>
			<div class="col-sm-8 input-group input-group-lg">
					<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
					<input class="form-control" type="text" id="searchtext"> 
			</div>
			<div class="col-sm-1"></div>
		</div>
		<div class="container-fluid" id="selected_eq" required>
			<ul class="w3-ul w3-card-4 col-sm-10" id="selected_list">
				
			</ul>
			<div class="col-sm-2">
				<button class="btn btn-success" id="1done" style="display: none;"> Next </button>
			</div>
		</div>
		<div class="container-fluid row" id="search-result">
	
		</div>
	</div>
</div>
<div class="container-fluid w3-card-4 p-padding-5 margin-bottom-10" id="insRes" style="display: none;">
	<div class="col-sm-2">
		<div class="wstep">2</div>
	</div>
	<div class="col-sm-10 p-padding-5">
		<form>
			<div class="form-group">
				<label for="da">Detail of Order</label>
				<textarea class="form-control" name="da" id="da" rows="5" required></textarea>
			</div>
			<div class="form-group" id="action-list">
				
			</div>
		<button class="btn btn-primary" id="sttm"> Send to Technical Manager <i class="fa fa-arrow-right"></i></button>
		</form>
	</div>
</div>
<script>
	function addEq(aRow){
		var c = $("<span class='close w3-btn w3-transparent w3-display-right'></span>").html("&times;");
		$(c).click(function()
			{$(c).parent("li").remove();
			if ($("#selected_list").children().length = 0){
				$("#1done").hide();
			}
		});
		var b = $("<span class=w3-large></span><br>").text(" "+$(aRow).children("td:first").text());
		var t = $("<span></span>").append($("<i></i>").text(" ["+$(aRow).children("td:nth-child(4)").text()+"]"));
		var d = $("<span></span>").text(" "+$(aRow).children("td:nth-child(5)").text());
		var a = $("<li class='w3-display-container' id='"+$(aRow).attr("id")+"'></li>").append(c,b,t,d);
		$("#selected_list").append(a);
		$("#1done").fadeIn();
		$("#search-result").fadeOut();

	}

	function getEqList(target,squery){
	    var aurl="include/eqlist.php";
	    var arg ={'q':squery};
	    $.get(aurl,arg,function(gdata,status){
	        $(target).html(gdata);
			$(".clickable-row").click(function(){
				addEq(this);
				actionlist($(this).children("td:nth-child(2)").text(),$(this).children("td:nth-child(3)").text());

			});
	        
	    });
	}
	function actionlist(disc,eqtype){
		$.get({
			url: "include/getactionlist.php",
		    data: {d: disc, e: eqtype },
			success: function (gdata, textstatus, xhr) {
				$("#action-list").html(gdata);
			}
		});

		
	}
	//collects required data and posts New Work order for insert
	function postNWO(){
		var myPostData = {
						  eq_id : $("li").attr("id"),
						  w_date: <?php echo date('Y/m/d'); ?>,
						  w_intitator: <?php echo $_SESSION['user_id']; ?>,
						  w_ins_date : <?php echo date('Y/m/d'); ?>,
						  w_ins_detail : $("da").val(),
						  w_item : $("tr.selected").attr("id")};
		$.ajax({
			type:"POST",
			url: "include/ajaxfunc.php",
			dataType: 'json',
			data: {functionname: 'newWorkOrder', arguments: myPostData},
			success: function (obj, textstatus, xhr) {
				if( !('error' in obj) ) {
					console.log(obj.result);
				} else {
			    	console.log(obj.error);}
				},
			error: function(xhr, ajaxOptions, te) {
				console.log(xhr.status),
				console.log(xhr.responseText)
				}	
			

		});

	}
	function validateWO(){
		if ($("tr.selected").length != 1) { 
			alert("Please Select One item");
			return false;}
		else return true;
	}

	$(document).ready(function(){
		$("#searchtext").keyup(function(){
			getEqList($("#search-result"),$(this).val());
		});
		$("#1done").click(function(){
			$("#insRes").fadeIn("slow");
			$("#searchbox").fadeOut();
			$(this).hide();
		});
		$("#sttm").click(function(){
			if (validateWO()) {
			postNWO();}
		});
	});
</script>