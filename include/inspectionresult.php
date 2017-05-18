<?php 
session_start();
// lodas by EQID, shws the detail of equipment, action, gets the result and submits them
require_once('connect-db.php');
require_once('functions.php');
if ($_SERVER['REQUEST_METHOD'] == "GET") {  /*show the form*/
	if (empty($_GET["eqid"])) {
		$errr = "eqid is not passed";
		exit('<div class="alert alert-danger">'.$errr.'</div>');
	} else {

		$conn = pr_connect();
		$eqid = $_GET['eqid'];
		$period = $_GET['period'];
		$eqid = mysqli_real_escape_string($conn,$eqid);
		$sql = "SELECT e.EQUIPMENT_ID,e.PACKAGE_CODE,e.DISCIPLINE_ID,e.EQUIPMENT_TYPE_ID,e.TAG_NO,e.DESCRIPTION, a.pr_action_id,a.ACT,a.ROW_ID, a.ACCTO FROM equipment_list e JOIN pr_action a on (e.DISCIPLINE_ID = a.DISCIPLINE_ID AND e.EQUIPMENT_TYPE_ID = a.EQUIPMENT_TYPE_ID) WHERE e.EQUIPMENT_ID = ".$eqid." ORDER BY a.ROW_ID";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$row =  $result->fetch_assoc();}
		// check if the logsheet is already entered
		$logsheet = getlogsheet($period,$eqid);

		}
} elseif ($_SERVER['REQUEST_METHOD']=="POST"){   /*post the result*/

	
	
}

?>

<div class="loader-container" id="loader">
<div class="loader">
loading...
</div>
</div>
<div class="finished-container" id="inserted">
	<div><i class="opdone fa fa-check-square-o"></i></div>
	<div>Submitted</div>
</div>
	
<div class="modal-header">
	<button class="close" type="button" data-dismiss="modal" style="font-size: 20px;">&times;</button>
	<div class="container-fluid">
		<div class="col-sm-4">
			<p><strong>ID: </strong><a href="eqidcard.php?eqid=<?php echo $row['EQUIPMENT_ID'] ?>" target="_blank"><?php echo $row['EQUIPMENT_ID'] ?></a></p>
			<p><strong>Tag No: </strong><?php echo $row['TAG_NO'] ?></p>
		</div>
		<div class="col-sm-8">
			<h3 class="text-center"><?php echo $row['DESCRIPTION'] ?></h3>
		</div>
	</div>
	<hr>
	<div class="container-fluid">
		<div class="col-sm-1"><a href=""></a></div>
		<div class="col-sm-5">
			<div class="container-fluid"><label for="period">Inspection Period:  <input id="period" type="text" value="<?php echo htmlspecialchars($period);?>" disabled style="max-width: 50px; text-align: center;"></label></div>
		</div>
		<div class="container-fluid col-sm-5" id="errormsg" style="text-align: right;"></div>
		<div class="col-sm-1"><a href=""></a></div>
	</div>
		
</div>
<div class="modal-body">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" role="form">
		<table class="table table-striped table-responsive w3-small">
			<thead>
				<th>Item</th>
				<th>Action</th>
				<th>Procedure</th>
				<th style="max-width: 65px;">No Need to Action</th>
				<th style="max-width: 65px;">Need To Action</th>
				<th style="max-width: 65px;">Not Applicable</th>
			</thead>
			<tbody>
		<?php foreach ($result as $key => $value) { ?>
				<tr class="logsheetitem">
					<td><i><strong><?php echo $value['ROW_ID'];?></strong></i></td>
					<td><?php echo $value['ACT']; ?></td>
					<td class="text-center"><a href="#" target="_blank"><?php echo $value['ACCTO']; ?></a></td>
					<td class="text-center"><input class="radiocheck" type="radio" name="<?php echo $value['ROW_ID'];?>" value="Yes" id="<?php echo $value['pr_action_id'];?>Yes"><label for="<?php echo $value['pr_action_id'];?>Yes"><i class="fa fa-check"></i></label></td>
					<td class="text-center"><input class="radiocheck" type="radio" name="<?php echo $value['ROW_ID'];?>" value="NO" id="<?php echo $value['pr_action_id'];?>No"><label for="<?php echo $value['pr_action_id'];?>No"><i class="fa fa-check"></i></label></td>
					<td class="text-center"><input class="radiocheck" type="radio" name="<?php echo $value['ROW_ID'];?>" value="NA" id="<?php echo $value['pr_action_id'];?>NA"><label for="<?php echo $value['pr_action_id'];?>NA"><i class="fa fa-check"></i></label></td>
				</tr>
		<?php	} ?>
			</tbody>
		</table>
		<label for="detail">Detail: </label><textarea class="form-control" rows="3" id="detail"></textarea>
	</form>
</div>
<div class="modal-footer">
		<button class="btn btn-success pull-right" id="submit" action="postlogsheet();"><span class="glyphicon glyphicon-ok"></span> Submit</button>
		<button class="btn btn-default pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>	
	
</div>
<script type="text/javascript">
    function postlogsheet(){
    	$("#loader").fadeIn();
    	var myPostData = [
    			$('#period').val(),
    			<?php 
    			echo $row['EQUIPMENT_ID'].", '".date('Y/m/d')."'"; 
    			?>,
    			$("input:radio[name=A]:checked").val(),
    			$("input:radio[name=B]:checked").val(),
    			$("input:radio[name=C]:checked").val(),
    			$("input:radio[name=D]:checked").val(),
    			$("input:radio[name=E]:checked").val(),
    			$("input:radio[name=F]:checked").val(),
    			$("input:radio[name=G]:checked").val(),
    			$("input:radio[name=H]:checked").val(),
    			$("input:radio[name=I]:checked").val(),
    			$("input:radio[name=J]:checked").val(),
    			$("input:radio[name=K]:checked").val(),
    			$("input:radio[name=L]:checked").val(),
    			$("input:radio[name=M]:checked").val(),
    			$("input:radio[name=N]:checked").val(),
    			$("input:radio[name=O]:checked").val(),
    			$("#detail").val(),
				<?php echo $_SESSION['user_id'] ?>	];
    	$.ajax({
			type: "POST",
			url: "include/ajaxfunc.php",
	    	dataType: 'json',
			data: {functionname: 'newlogsheet', arguments: myPostData },
			success: function (obj, textstatus, xhr) {
				if( !('error' in obj) ) {
					$("#loader").hide();
			    	$("#inserted").show();
			    	$("#submit").hide();
				} else {
			    	console.log(obj.error);}
				},
			error: function(xhr, ajaxOptions, te) {
				console.log(xhr.status),
				console.log(xhr.responseText)
				}
					    });

    }
    function validateLogsheet(){
    	var logsheetrows = $(".logsheetitem");
    	var lall = ["A","B","C","D","E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O"];
    	$(logsheetrows).removeClass("warning");
    	for (var i = 0; i < logsheetrows.length ;  i++) {
   
    		if (typeof $("input:radio[name="+lall[i]+"]:checked").val() == 'undefined') {
    			$(logsheetrows[i]).addClass("warning");
    			$(logsheetrows[i]).tooltip();
    			var r = false;	
    			
    		}
    	}
    	for (var j = logsheetrows.length; j <= lall.length; j++ ){
    		$("form").append("<input type='radio' name='"+ lall[j]+"' class='hidden' value ='0' checked>" );
    	}
    	if (r === false){
    		return false;

    	} else {
    		return true;
    	}

    }
    function fillLogSheet(){
		
		$('#errormsg').text(<?php echo "'Recorded on ",date('Y/m/d', strtotime($logsheet['date'])), " By: ",getUser($logsheet['Userid'],'UserFriedlyName'),"'" ?>);
		<?php echo '$("input:radio[name=A][value=',"'",$logsheet['A'],"'",']").prop("checked",true);',"\n" ; ?>
		<?php echo '$("input:radio[name=B][value=',"'",$logsheet['B'],"'",']").prop("checked",true);',"\n" ; ?>
		<?php echo '$("input:radio[name=C][value=',"'",$logsheet['C'],"'",']").prop("checked",true);',"\n" ; ?>
		<?php echo '$("input:radio[name=D][value=',"'",$logsheet['D'],"'",']").prop("checked",true);',"\n" ; ?>
		<?php echo '$("input:radio[name=E][value=',"'",$logsheet['E'],"'",']").prop("checked",true);',"\n" ; ?>
		<?php echo '$("input:radio[name=F][value=',"'",$logsheet['F'],"'",']").prop("checked",true);',"\n" ; ?>
		<?php echo '$("input:radio[name=G][value=',"'",$logsheet['G'],"'",']").prop("checked",true);',"\n" ; ?>
		<?php echo '$("input:radio[name=H][value=',"'",$logsheet['H'],"'",']").prop("checked",true);',"\n" ; ?>
		<?php echo '$("input:radio[name=I][value=',"'",$logsheet['I'],"'",']").prop("checked",true);',"\n" ; ?>
		<?php echo '$("input:radio[name=J][value=',"'",$logsheet['J'],"'",']").prop("checked",true);',"\n" ; ?>
		<?php echo '$("input:radio[name=K][value=',"'",$logsheet['K'],"'",']").prop("checked",true);',"\n" ; ?>
		<?php echo '$("input:radio[name=L][value=',"'",$logsheet['L'],"'",']").prop("checked",true);',"\n" ; ?>
		<?php echo '$("input:radio[name=M][value=',"'",$logsheet['M'],"'",']").prop("checked",true);',"\n" ; ?>
		<?php echo '$("input:radio[name=N][value=',"'",$logsheet['N'],"'",']").prop("checked",true);',"\n" ; ?>
		<?php echo '$("input:radio[name=O][value=',"'",$logsheet['O'],"'",']").prop("checked",true);',"\n" ; ?>
		$('#detail').val(<?php echo json_encode($logsheet['Detail']); ?>);
		
    }

    
 




	$(document).ready(function(){
	<?php
	if ($logsheet != -1){
		printf ("fillLogSheet();\n");
		echo "$('#submit').hide();"; }  ?>	
	$("#submit").click(function(){
		if (validateLogsheet()){
			postlogsheet();}
	$("#loader").hide();
	$("#inserted").click(function(){$(this).fadeOut();});

	});


	});
</script>