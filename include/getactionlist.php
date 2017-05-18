<?php
require_once 'connect-db.php';
	$discipline = $_GET['d'];
	$eq_type = $_GET['e'];
	$mysqli=pr_connect();
	$sql= "SELECT * FROM pr_action WHERE DISCIPLINE_ID =(select DISCIPLINE_ID from discipline where DISCIPLINE_NAME='".$discipline."') and EQUIPMENT_TYPE_ID=(select EQUIPMENT_TYPE_ID from equipment_type where EQUIPMENT_TYPE_D ='".$eq_type."')";
	$result = $mysqli->query($sql);
	if ($result->num_rows == 0){
		echo '<div class="container-fluid"><div class="alert alert-warning">No Item</div></div>';		
	} else {
?>
<table class="table table-striped table-responsive w3-small pr-table pr-pointer">
	<thead>
		<tr>
		<th>Item</th>
		<th>Action</th>
		</tr>
	</thead>
	<tbody>
<?php 
		while ($row = $result->fetch_assoc()){
?>
		<tr id='"<?php echo $row["pr_action_id"];?>"' data-dicipline='"<?php echo $row["DISCIPLINE_ID"]; ?>"' data-eqtype='"<?php echo $row["eq_type"]; ?>"'>
			
			<td><strong><i><?php echo htmlspecialchars($row['ROW_ID']);?></i></strong></td>
			<td><?php echo htmlspecialchars($row['ACT']);?></td>
		</tr>
<?php
		}
?>		
	</tbody>
</table>
<script>
	$(document).ready(function(){
		$("table tr").click(function(){
				$("tr").removeClass("selected");
				$(this).addClass("selected");
		});
	});
</script>
<?php	} 
$mysqli->close();
?>