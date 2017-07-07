<?php 
require_once('pclasses.php');

if ($_SERVER['REQUEST_METHOD'] == "GET") {
	if (isset($_GET['q'])) {
		$aSearch = new eSearch(); // creates a new search object
		$aSearch->set_sQuery($_GET['q']);
		$sResult = $aSearch->execute();
		if ($aSearch->rowCount == 0){
			die("<div class='alert alert-warning'> Nothing Found. </div>");
		}
	}
}
?>
<table class="pr-table table table-striped w3-white w3-small">
	<thead>
		<th>Package</th>
		<th>Discipline</th>
		<th>Equipment Type</th>
		<th>Tag No</th>
		<th>Description</th>
		<th>Location</th>
		<th>Status</th>
		<th>Quantity</th>
		<th>Vendor</th>
	</thead>
	<tbody>
		<?php
		foreach ($sResult as $key => $value) { ?>
		<tr data-eqid="<?php echo $value['EQUIPMENT_ID'] ?>">
			<td><?php echo htmlspecialchars($value['PACKAGE_CODE']) ?></td>
			<td><?php echo htmlspecialchars($value['DISCIPLINE_NAME']) ?></td>
			<td><?php echo htmlspecialchars($value['EQUIPMENT_TYPE_D']) ?></td>
			<td><?php echo htmlspecialchars($value['TAG_NO']) ?></td>
			<td class="pr-truncate"><?php echo htmlspecialchars($value['DESCRIPTION']) ?></td>
			<td><?php echo htmlspecialchars($value['EQ_LOCATION_D']) ?></td>
			<td><?php echo htmlspecialchars($value['EQ_STATUS_D']) ?></td>
			<td><?php echo htmlspecialchars($value['QTY']) ?></td>
			<td><?php echo htmlspecialchars($value['VENDOR_NAME']) ?></td>
		</tr>	
		<?php } ?>
	</tbody>
</table>
