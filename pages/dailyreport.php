<?php
require_once('../include/functions.php');
$discipline = disciplineList();
?>
<script src="/vendor/jQuery/jquery-3.1.1.min.js"></script>
<script src="/scripts/prscripts.js"></script>
<div class="header container-fluid">
	<h1>Daily Report</h1>
	<div class="container-fluid" id="selectDate">
		<label for="selectedDate">Select Date</label>
		<input type="text" id="selectedDtae" class="datepicker-input">
		<button class="btn btn-primary" id="newReport"><i class="fa fa-file-text"></i> New report</button>
	</div>
</div>
<br>
<div class="container-fluid w3-card" id="reportContainer">
	<div class="container-fluid form-group">
		<input type="radio" class="radiocheck" name="reportType" value="Execution" id=1EreportType>
		<label for="1EreportType">Execution</label>
		<input type="radio" class="radiocheck" name="reportType" value="Inspection" checked id="1IreportType"><label for="1IreportType">Inspection</label>
		<br>
		<label for="discipline">Discipline: </label>
		<select name="discipline" id="discipline">
			<?php foreach ($discipline = disciplineList() as $key => $value) { ?>
				<option value="<?php echo htmlspecialchars($value['DISCIPLINE_ID']); ?>"> <?php echo htmlspecialchars($value['DISCIPLINE_NAME']); ?> </option>
			<?php } ?>
		</select>
		<label for="packageSelector">Package </label>
		<select name="package" id="packageSelector">
			
		</select>
		<label for="eqTypeSelect">Equipment Type </label>
		<select name="eqTypeSelect" id="eqTypeSelect"></select>
		<label for="tagNo">Tag No: </label><input type="text" id="tagNo">
		<label for="location">Location: </label><select name="location" id="tagNo"></select>
		<label for="detail"></label><textarea name="detail" id="detail" cols="30" rows="5" class="form-control"></textarea>
		<div class="dropzone" id="reportImage" ></div>
		<button class="btn btn-default" id="save"><i class="fa fa-check"></i> Save Report</button>
		<button class="btn btn-default" id="Cancel"><i class="fa fa-remove"></i> Cancel</button>
		<!-- <form action="../include/uploadimage.php" class="dropzone"></form> -->
	</div>
</div>
<!-- <script src= "../vendor/dropzone/dropzone.js"></script>
 --><script>
	$(document).ready(function(){
		// datePickerInitialize();
		// loadScript("/vendor/dropzone/dropzone.js",function(){
		// 	$("#reportImage").dropzone({url:"include/uploadimage.php",
		// 	 							dictDefaultMessage: 'Upload Your Image',
		// 	 							autoDiscover:false,
		// 	 							acceptedFiles:'image/*'});
		// });

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