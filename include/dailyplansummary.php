<?php
require_once("connect-db.php");
$Day = strtotime($_GET['day']);
$colorArray  = array("Bulk Material"=>"w3-red",
					 "Electrical"=>"w3-deep-purple",
					 "Instrument"=>"w3-blue",
					 "Mechanical"=>"w3-teal",
					 "Mechanical (Fix)"=>"w3-green",
					 "Mechanical (Rotary)"=>"w3-amber",
					 "Multidiscipline"=>"w3-cyan",
					 "Piping & support & Valve"=>"w3-sand");
$sql 	= "select count(idIns_plan) as eqnum,  e.DISCIPLINE_NAME as discipline from ins_plan i join eq_extended_list e on i.Ins_planEQID = e.EQUIPMENT_ID where i.Ins_plandate = '".date('Y/m/d',$Day)."' group by e.DISCIPLINE_NAME";
$db 	= pr_connect();
if(!($result = mysqli_query($db,$sql))|| ($numrow = mysqli_num_rows($result))== 0){
	echo "<div class='alert alert-danger'> No Plan for this day </div>";		
} else {
	$colw	  = intval(12 / $numrow);
	$totalnum = 0;
	foreach ($result as $key => $value) {
		echo '<div class="w3-col s'.$colw.'">'; 
			echo '<div class="w3-container '.$colorArray[$value['discipline']].' w3-padding-16" data-toggle="tooltip" data-placement="bottom" title="'.htmlspecialchars($value['eqnum']).' '.htmlspecialchars($value['discipline']).' Equipment" >';
				echo '<div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>';
				echo '<div class="w3-right"><h3>'.htmlspecialchars($value['eqnum']).'</h3></div>';
				echo '<div class="w3-clear"></div><h4 class="pr-truncate">'.htmlspecialchars($value['discipline']).'</h4>';
			echo "</div>";
		echo "</div>";
		$totalnum += $value['eqnum'];
	}
	echo "<div class='w3-clear'></div> <button id='seeall' data-date='".htmlspecialchars($_GET['day'])."' class='w3-btn'>See All  <span class='badge'>".$totalnum."</span> <i class='fa fa-arrow-right'></i></button>";
}
$db->close();	
?>