<header class="container-fluid">
	<h1><i class="fa fa-dashboard"></i>  Overview</h1>
</header>
<div class="w3-row-padding w3-margin-bottom">
	<div class="container-fluid w3-left"><h2><span id="day_label">Today Plan</span></h2></div>
	<div class="container-fluid w3-right">
		<div class="btn-group">
			<button id="today"  class="btn btn-primary">Today</button>
			<button id="tomorrow" class="btn btn-primary">Tomorrow</button>
		  	<input type="text" class="btn btn-primary" id="startday" name="startday" placeholder="Pick a Date">
		</div>
	</div>
</div>
<div class="w3-clear"></div> <!-- to clear grid -->
<!-- ajax call result	 -->
<div class="w3-row-padding" id="dailysummary"></div>

<div class="w3-row-padding hidden">
	<div class="container-fluid">
		<h2>Inspection Progress</h2>
		<i>Today</i>
		<div class="w3-progress-container w3-round w3-border w3-gray">
			<div class="w3-progressbar w3-blue w3-round" id="thisPeriod" style="width:59%;">
				<div class="w3-center w3-text-withe">59%</div>
			</div>
		</div>
		<i>This Period</i>
		<div class="w3-progress-container w3-round w3-border w3-gray">
			<div class="w3-progressbar w3-green w3-round" id="thisPeriod" style="width:25%;">
				<div class="w3-center w3-text-withe">25%</div>
			</div>
		</div>
		<i>Total</i>
		<div class="w3-progress-container w3-round w3-border w3-gray">
			<div class="w3-progressbar w3-teal w3-round" id="thisPeriod" style="width:10%;">
				<div class="w3-center w3-text-withe">10%</div>
			</div>
		</div>
	</div>
</div>
<script>
	function getSummary(aDay) {
		var $targetElement = $('#dailysummary');
		$targetElement.empty();
		$.get('include/dailyplansummary.php?day='+aDay ,function (gdata, status) {
			$targetElement.append(gdata);
			$('[data-toggle="tooltip"]').tooltip();
			$("#seeall").click(function(){
				window.location.href='./?page=plan&day='+$(this).data("date")});
           	}
		);
	}
	$(document).ready(function(){
		var date_input=$("#startday"); //our date input has the name "date"
		var options={
			format: 'yyyy/mm/dd',
			orientation: "bottom auto",
			todayHighlight: true,
			autoclose: true	};
		date_input.datepicker(options);
			
		getSummary('today');

		$("#today").click(function(){
			getSummary('today');
			$("#day_label").text("Today Plan");
			date_input.val("");}
			);
		$("#tomorrow").click(function(){
			getSummary('tomorrow');
			$("#day_label").text("Tomorrow Plan");
			date_input.val("");}
			);
		date_input.change(function(){
			getSummary(this.value);
			$("#day_label").text("Plan for: " + this.value)
		});
	});
</script>