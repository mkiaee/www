<?php
	require_once('connect-db.php');
	function getUser($userid,$what_to_return = "" )
	{
		$mysqli = pr_connect();
		$sql = "SELECT * FROM preservationusers WHERE `idPreservationUsers` = ".$userid;
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0){
			$row = $result->fetch_assoc();
			if ($what_to_return === ""){
				return $row;
			} else {
				return $row[$what_to_return];
			}
		} else {
			return -1;
		}
		$mysqli->close();
	}
	
	function getlogsheet($period,$eqid)
	{
		$mysqli = pr_connect();
		$sql = "SELECT * FROM preservation.logsheet where period=".$period." and eqid=".$eqid;
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0){
			$row = $result->fetch_assoc();
		} else
		    $row = -1;

		return $row;
		$mysqli -> close();
	}


	function newlogsheet($alogSheet) {
	
		$mysqli = pr_connect();
		if ($stmt = $mysqli->prepare('INSERT INTO logsheet (period, eqid, date, A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, Detail, Userid) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)')) {
			$stmt -> bind_param('iisssssssssssssssssi', $period, $eqid, $date, $A, $B, $C, $D, $E, $F, $G, $H, $I, $J, $K, $L, $M, $N, $O, $Detail, $Userid);
		
			$period	= $alogSheet[0];
			$eqid	= $alogSheet[1]; 
			$date	= $alogSheet[2]; 
			$A	= $alogSheet[3]; 
			$B	= $alogSheet[4]; 
			$C	= $alogSheet[5]; 
			$D	= $alogSheet[6]; 
			$E	= $alogSheet[7]; 
			$F	= $alogSheet[8]; 
			$G	= $alogSheet[9]; 
			$H	= $alogSheet[10]; 
			$I	= $alogSheet[11]; 
			$J	= $alogSheet[12]; 
			$K	= $alogSheet[13]; 
			$L	= $alogSheet[14]; 
			$M	= $alogSheet[15]; 
			$N	= $alogSheet[16]; 
			$O	= $alogSheet[17]; 
			$Detail	= $alogSheet[18]; 
			$Userid =  $alogSheet[19];
		
			if ($stmt -> execute()) {
			return $stmt->affected_rows;
			} else return $stmt->error;
		}
		else return "prepare fail";
		$stmt -> close();
	
	}

	function newWorkOrder($aWO) {
		$mysqli = pr_connect();
		if ($stmt = $mysqli->prepare("INSERT INTO workorders (eq_id, w_date, w_intitator, w_ins_date, w_ins_detail, w_item
													VALUES   (?,?,?,?,?,?)")){
			$stmt->bind_param('isissi',$eq_id, $w_date, $w_intitator, $w_ins_date, $w_ins_detail, $w_item);

			$eq_id = $aWO['eq_id'];
			$w_date = $aWO['w_date'];
			$w_intitator = $aWO['w_intitator'];
			$w_ins_date = $aWO['w_ins_date'];
			$w_ins_detail = $aWO['w_ins_detail'];
			$w_item = $aWO['w_item'];
		if ($stmt -> execute()) {
			return $stmt->affected_rows;
		} else return $stmt->error;
		} else return "not prepared";
	}


	function add_new_inspection($eq_id,$period,$plan_date){  // adds a new inspection plan
		$mysqli = pr_connect();
		if ($stmt = $mysqli->prepare("INSERT INTO ins_plan (Ins_planEQID, Ins_plandate, Ins_planperiod)	VALUES (?,?,?)")){
			$stmt -> bind_param('isi',$eq_id,$plan_date,$period);
			if ($stmt->execute()){
				return $stmt->affected_rows;
			} else { 
				return $stmt->error;
			}
		}else{
			return -1;
		}
		$stmt->close();

	}



	function plan_next_period ($base_period,$target_period){ //plans next inspection period base on last period
		$r = 0;
		$mysqli = pr_connect();
		$sql = "SELECT i.Ins_planEQID, i.Ins_plandate, i.Ins_planperiod, p.INTERVAL FROM ins_plan i inner join inspection_period p on i.ins_planEQID = p.EQID where i.Ins_planperiod = ".$base_period.";";
		$base_plan = $mysqli->query($sql);

		while ($row = $base_plan->fetch_assoc()) {
/*			Add two date
			Add anamount of time to a date
			link: http://php.net/manual/en/datetime.add.php*/

			$new_plan_date = new DateTime($row['Ins_plandate']);
			$new_plan_date-> add(new DateInterval('P'.$row['INTERVAL'].'D'));

			if (($d = add_new_inspection($row['Ins_planEQID'],$target_period, $new_plan_date->format('Y/m/d'))) > 0) {
				$r += $d; 

			}
			else{
				die($d);
			}	
		}
		return $r;
		$mysqli->close();
	}


	function plan_next_period_d ($target_period,$first_day){  //plans next period base on a given date
		$pdo = pdo_connect();
		$sql = "SELECT EQID, INTERVAL, STARTDAY FROM inspection_period";
		$result = $pdo -> query($sql);
		echo $result->num_rows;
		while ($row = $result->fetch_assoc()){
			$new_plan_date = new DateTime($first_day);
			$new_plan_date-> add(new DateInterval('P'.$row['INTERVAL'].'D'));

			if (($d = add_new_inspection($row['EQID'],$target_period, $new_plan_date->format('Y/m/d'))) > 0) {
				$r += $d; 
			}
			else{
				die($d);
			}
		}

	}