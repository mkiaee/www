<?php



?>
<link rel="stylesheet" href="vendor/dropzone/dropzone.css">
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
			<button  type="button" class="btn btn-default" onclick="planNextBaseOnDate(this)">Submit <span class="fa fa-arrow-right"></span></button>
		</div>
	</div>
</div>
<script>
	function planprevios(b) {
		$("input, select, button").prop("disabled",true);
		processButton(b);
		$.ajax({
			type: "POST",
			url: "include/ajaxfunc.php",
			dataType: "JSON",
			data: {functionname:"plan_next_period",
					arguments: {
						// $("#base-period").val(),4
					},
			success:function(){},
			fail: function(){}
		}

		});
	}

	function planNextBaseOnDate(b){
		$("input, select, button").prop("disabled",true);
		var fday = $('#first-day').val();
		processButton(b);
		$.ajax({
			type: "POST",
			url: "include/ajaxfunc.php",
			dataType: "JSON",
			data: {functionname:"plan_next_period_d",
					arguments: [1,fday]},
			success:function(obj,textstatus,xhr){
				if (!('error' in obj)) {
					$(b).removeClass('btn-default');
					$(b).addClass('btn-success');
					$(b).html(obj.result+' Inspection Planed <span class="fa fa-check"></span>');
				} else {
					var w = window.open();
					$(w.document.body).html(obj.error);
					console.log(obj.error);
				}
			},
			fail: function(){},
			error: function(xhr, ajaxOptions, te) {
				console.log(xhr.status),
				console.log(xhr.responseText)
				}
		

		});
	}
	$(document).ready(function(){
		datePickerInitialize();
	})
</script>
