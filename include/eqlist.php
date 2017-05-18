<?php
//This Page generates a list of equipments
include("../include/connect-db.php");
$con = pr_connect();
$sql = "select * from eq_extended_list";
if (isset($_GET['eqid'])) {
	$eqid = intval($_GET['eqid']);
	$sql = $sql." WHERE EQUIPMENT_ID = ".$eqid;
} elseif (isset($_GET['q'])) {
	$q=$_GET['q'];
	$q=mysqli_real_escape_string($con,$q);
	$sql = $sql." WHERE (DISCIPLINE_NAME like '%".$q ."%' ) OR 
						(TAG_NO like '%".$q ."%' ) OR 
						(PACKAGE_CODE  like '%".$q."%') OR 
						(EQUIPMENT_TYPE_D like '%".$q."%') OR 
						(DESCRIPTION like '%".$q."%') OR 
						(VENDOR_NAME like '%".$q."%')";
}


$result = mysqli_query($con,$sql);
$rowcount = mysqli_num_rows($result);

if( $rowcount == 0){
	echo "<div class='w3-conainer w3-rest w3-red'> NO MATCH</div>";
} else { ?>	
<table class="pr-table w3-table-all w3-hoverable w3-card w3-padding-0 w3-small" id="listdata">
	<thead>
		<th>Package</th>
		<th>Discipline</th>
		<th>Equipment Type</th>
		<th>Tag No.</th>
		<th>Description</th>
		<th>Quantity</th>
		<th>Location</th>
		<th>Status</th>
		<th>Vendor</th>
	</thead>
	<tbody>
<?php 
while ($row = $result->fetch_assoc()) { ?>
			<tr id= "<?php echo $row['EQUIPMENT_ID']; ?>" style="cursor: pointer;" class="clickable-row" >
				<td class="pr-table-td"><?php echo htmlspecialchars($row['PACKAGE_CODE']); ?></td>
				<td class="pr-table-td"><?php echo htmlspecialchars($row['DISCIPLINE_NAME']); ?></td>
				<td class="pr-table-td"><?php echo htmlspecialchars($row['EQUIPMENT_TYPE_D']); ?></td>
				<td class="pr-table-td"><?php echo htmlspecialchars($row['TAG_NO']); ?></td>
				<td class="pr-table-td"><?php echo htmlspecialchars($row['DESCRIPTION']); ?></td>
				<td class="pr-table-td"><?php echo htmlspecialchars($row['QTY']); ?></td>
				<td class="pr-table-td"><?php echo htmlspecialchars($row['EQ_LOCATION_D']); ?></td>
				<td class="pr-table-td"><?php echo htmlspecialchars($row['EQ_STATUS_D']); ?></td>
				<td class="pr-table-td"><?php echo htmlspecialchars($row['VENDOR_NAME']); ?></td>
			</tr>
		
<?php
  }
}
$con->close(); ?>
	</tbody>
</table>

