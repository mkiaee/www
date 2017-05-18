<?php 
include("../include/connect-db.php");
$conn   = pr_connect();
$sql    = "SELECT i.idIns_plan, i.Ins_planEQID, i.Ins_plandate, i.Ins_planperiod, e.PACKAGE_CODE, e.DISCIPLINE_NAME, e.EQUIPMENT_TYPE_D, e.TAG_NO, e.DESCRIPTION, e.EQ_LOCATION_D, e.EQ_STATUS_D, e.QTY, e.VENDOR_NAME FROM ins_plan i join eq_extended_list e on i.Ins_planEQID = e.EQUIPMENT_ID ";
// where Ins_plandate = '' and DISCIPLINE_NAME = '';;

if (isset($_GET['day'])) {
	$day= strtotime($_GET['day']);
	} else { $day = strtotime('today'); };
$sql   .= " where Ins_plandate = '".date('Y/m/d',$day)."'";

if (isset($_GET['dis'])) {
	$sql.= " and DISCIPLINE_NAME = '".mysqli_real_escape_string($_GET['dis'])."' ";
}

$result = mysqli_query($conn,$sql);

// $colname = array_keys($row); 			////////for header automation ;)
?>
<div class="w3-row">
	<div class="w3-card w3-white">
		<div class="container-fluid">
			<div class="col-sm-1 no-padding" style="margin-top: 12px;"><a id="PreviousDay" class="btn btn-default" href="index.php?page=plan&day=<?php echo date('Y/m/d',strtotime("yesterday",$day));  ?>" >Previous day</a></div>
			<div class="col-sm-10 text-center">
				<h1><i class="fa fa-flag">  </i><span>  <?php echo date('l d F Y',$day); ?></span></h1>
			</div>	
			<div class="col-sm-1 no-padding" style="margin-top: 12px;"><a id="NextDay" class="btn btn-default" href="index.php?page=plan&day=<?php echo date('Y/m/d',strtotime("tomorrow",$day)); ?>" >Next day</a></div>	
			
		</div>
	</div>
</div>
<div class="w3-row">
	<div class="w3-card w3-white pr-sq-padding">
		<table id="dailyplan" class="pr-table table table-striped w3-hoverable w3-small">
			<thead>
				<tr>
					<th class="filter-header">Package</th>
					<th class="filter-header">Discipline</th>
					<th class="filter-header">Equipment Type</th>
					<th class="filter-header">Tag No</th>
					<th class="filter-header">Description</th>
					<th class="filter-header">Location</th>
					<th class="filter-header">Status</th>
					<th class="filter-header">Qty</th>
					<th class="filter-header">Vendor</th> 
				</tr>
			</thead>
			<tbody>
			<?php 
				while ($row = $result->fetch_assoc()) {
					echo '<tr class="clickable-row pr-pointer" data-planid="',$row['idIns_plan'],'" data-eqid="',$row['Ins_planEQID'],'" data-period="',$row['Ins_planperiod'],'" >';
						echo '<td>',$row['PACKAGE_CODE'],'</td>';
						echo '<td>',$row['DISCIPLINE_NAME'],'</td>';
						echo '<td>',$row['EQUIPMENT_TYPE_D'],'</td>';
						echo '<td>',$row['TAG_NO'],'</td>';
						echo '<td class="pr-truncate">',$row['DESCRIPTION'],'</td>';
						echo '<td>',$row['EQ_LOCATION_D'],'</td>';
						echo '<td>',$row['EQ_STATUS_D'],'</td>';
						echo '<td>',$row['QTY'],'</td>';
						echo '<td>',$row['VENDOR_NAME'],'</td>';
					echo "</tr>";
				}

			?>
			</tbody>
		</table>
	</div>
</div>

<div id="insResModal" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:75%;">
		<div class="modal-content">
			<div class="loader"></div>
		</div>
	</div>
</div>


<script>
	function inspectionResultModal(eqID,Period){
		$.ajax({
			type : "GET",
			url : "include/inspectionresult.php",
			data : {eqid: eqID, period: Period},
			beforeSend : function(){
				$("#insResModal").modal();},
			// call back functtion
			success: function(gdata,status){
				$(".modal-content").empty();
				$(".modal-content").append(gdata);}
			});
	}
	// function filterResult(aHeader){
	// 	var colIndex = $("th").index(aHeader);
	// 	// var aTable = $(aHeader).parentsUntil("table").not("table");
	// 	var aList = [];
	// 	var $aTR = $("tr");
	// 	for (var i = 0; i < $aTR.length; i++) {
	// 		var aTD = $aTR.eq(i).children("td").eq(colIndex).text();
	// 		if ( jQuery.inArray(aTD,aList) < 0 ){
	// 			aList.push(aTD);
	// 		}
	// 	}
	// 	// if (aList.length > 1) { aList.splice(0);} 	
	// 	var $aFilterDropDownlist = $("#filterlist").append("<ul class='menu'></ul>");
	// 	for (i=0; i<aList.length; i++) {

	// 		$($aFilterDropDownlist).children("ul").append("<li>"+aList[i]+"</li>");
	// 	}
	// 	$(".filterpane > loader").hide();
	// }

	// function createFilterDropDown(aElement){
	// 	aFilterDropDown = $(".filterpane")
	// 	$(aElement).append(aFilterDropDown);

	// 	aFilterDropDown.show();
	// 	$(".filterpane > loader").show();
	// }

	$(document).ready(function(){
		$(".clickable-row").click(function(){
			inspectionResultModal($(this).data("eqid"),$(this).data("period"));});
		// $(".filter-header").click(function(){
			// createFilterDropDown(this);
			// filterResult(this)
		
		// });
	});

</script>
</body>
</html>