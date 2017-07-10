<?php
require_once('../include/functions.php');
$discipline = disciplineList();
?>
<link rel="stylesheet" href="/vendor/dropzone/dropzone.css">
<div class="header container-fluid">
	<h1>Daily Report</h1>
	<div class="container-fluid" id="selectDate">
		<label class="control-label col-sm-2" for="selectedDate">Select Date: </label>
		<div class="col-sm-10"><input class="form-control datepicker-input" type="text" id="selectedDtae"></div>
		<button class="btn btn-primary" id="newReport"><i class="fa fa-file-text"></i> New report</button>
	</div>
</div>
<br>
<div class="container-fluid w3-card" id="reportContainer">
<form class="form-horizontal">
	<div class="container-fluid form-group">
		<input type="radio" class="radiocheck" name="reportType" value="Execution" id=1EreportType>
		<label  for="1EreportType">Execution</label>
		<input type="radio" class="radiocheck" name="reportType" value="Inspection" checked id="1IreportType"><label  for="1IreportType">Inspection</label>
		<br>
		<div class="row">
			<div class="col-sm-4">
			<label class="control-label" for="discipline">Discipline: </label>
				<select class="form-control" name="discipline" id="discipline">
					<?php foreach ($discipline = disciplineList() as $key => $value) { ?>
						<option value="<?php echo htmlspecialchars($value['DISCIPLINE_ID']); ?>"> <?php echo htmlspecialchars($value['DISCIPLINE_NAME']); ?> </option>
					<?php } ?>
				</select>	
			</div>
			<div class="col-sm-4">
				<label class="control-label" for="packageSelector">Package: </label>
				<select class="form-control" name="package" id="packageSelector">
				</select>
			</div>
			<div class="col-sm-4">
				<label class="control-label" for="eqTypeSelect">Equipment Type: </label>
				<select class="form-control" name="eqTypeSelect" id="eqTypeSelect"></select>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<label class="control-label" for="location">Location: </label><select class="form-control" name="location" id="location"></select>
			</div>
			<div class="col-sm-6">
				<label class="control-label" for="tagNo">Tag No: </label>
				<input class="form-control" type="text" id="tagNo">
			</div>
		</div>	
		<label class="control-label" for="detail">Report Detail: </label>
		<textarea name="detail" id="detail" cols="30" rows="5" class="form-control"></textarea>
		<label for="reportImage" class="control-label">Images: </label>
		<div class="dropzone form-control" id="reportImage" ></div>
		<button class="btn btn-default" id="save"><i class="fa fa-check"></i> Save Report</button>
		<button class="btn btn-default" id="Cancel"><i class="fa fa-remove"></i> Cancel</button>
		<!-- <form action="../include/uploadimage.php" class="dropzone"></form> -->
	</div>
</form>
</div>
<script>
	$(document).ready(function(){
		datePickerInitialize();
		loadScript("/vendor/dropzone/dropzone.js",function(){
			$("#reportImage").dropzone({url:"include/uploadimage.php",
			 							dictDefaultMessage: 'Upload Your Image',
			 							autoDiscover:false,
			 							acceptedFiles:'image/*'});
		});

		function fillpackage(obj,textstatus,xhr){
			$('#packageSelector').empty();
			if (!('error' in obj)) {
				for (var i = obj.result.length - 1; i >= 0; i--) {
						var opt = "<option value='"+obj.result[i].PACKAGE_CODE+"'>"+obj.result[i].PACKAGE_NAME+"</option>";
						$('#packageSelector').append(opt);}
			}	
		}

	    $('#discipline').on('change',function(){
					callFunction('packageList',
					{DISCIPLINE_ID:$(this).val()},
					fillpackage
					);
		});
	});
</script>