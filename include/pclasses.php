<?php
require_once('connect-db.php');
/**
Creates an eSearch Object witch gets search parameters, searches the data base and returns the results
*/
class eSearch
{
	
	var $sQuery; // the search query
	var $rowCount = 0; // Number of returned result
	public function set_sQuery($q)
	{
		$this->sQuery = $q;
	}
	private function searchQuery(){
		$sql = 'Select * From eq_extended_list
				where
				(PACKAGE_CODE like "%'.$this->sQuery.'%") OR 
				(DISCIPLINE_NAME like "%'.$this->sQuery.'%") OR 
				(EQUIPMENT_TYPE_D like "%'.$this->sQuery.'%") OR 
				(TAG_NO like "%'.$this->sQuery.'%") OR 
				(DESCRIPTION like "%'.$this->sQuery.'%") OR 
				(EQ_LOCATION_D like "%'.$this->sQuery.'%") OR 
				(EQ_STATUS_D like "%'.$this->sQuery.'%") OR 
				(QTY like "%'.$this->sQuery.'%") OR 
				(VENDOR_NAME like "%'.$this->sQuery.'%")';
 	return $sql;
	}


	public function execute(){
		$mysqli = pr_connect();
		$results = $mysqli->query($this->searchQuery());
		$sResult = $results->fetch_all(MYSQLI_ASSOC);
		$this->rowCount = $results->num_rows;
		return $sResult;

	}
	// function __destruct(){
	// 	// $mysqli->close();
	// }
}