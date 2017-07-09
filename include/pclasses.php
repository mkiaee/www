<?php
require_once('connect-db.php');
function str_lreplace($search, $replace, $subject)
{
    $pos = strrpos($subject, $search);

    if($pos !== false)
    {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }

    return $subject;
}


/**
Creates an eSearch Object witch gets search parameters, searches the data base and returns the results
*/
class eSearch
{
	
	var $sQuery; // the search query
	var $rowCount = 0;  // Number of returned result
	var $filters = array(); //Filters
	var $filterOprand = 'AND';
	var $fieldList = array ('EQUIPMENT_ID','PACKAGE_CODE','DISCIPLINE_NAME','EQUIPMENT_TYPE_D','TAG_NO','DESCRIPTION','EQ_LOCATION_D','EQ_STATUS_D','QTY','VENDOR_NAME');
	var $groupBy = array();
	public function set_sQuery($q)
	{
		$this-> sQuery = $q;
	}
	public function set_fields($fields){
		$this-> fieldList = $fields;
	}
	public function set_filters($filter){
		$this-> filters = $filter;
	}
	private function searchQuery(){
		$flist = $q =$f = $g = $sql='';
		foreach ($this->fieldList as $value) {
			$flist .= $value.' , ';
		}
		$flist = str_lreplace(' , ','',$flist);

		if (!($this-> sQuery == '')){
			foreach ($this->fieldList as $value) {
				$q .= '('.$value.' LIKE "%'.$this-> sQuery.'%") OR ';
			}
			$q = str_lreplace('OR ','',$q);
		}

		foreach ($this->filters as $key => $value) {
			$f .= '('.$key.' = '.$value.') '.$this->filterOprand ;
		}
		$f = str_lreplace($this->filterOprand,'',$f);
		if ($q !='' and $f!=''){
			$f = 'AND '.$f;
		}
		foreach ($this->groupBy as $value) {
			$g .= $value.' , ';
		}
		$g = str_lreplace(', ','',$g);
		
		$sql = 'SELECT '.$flist.' FROM eq_extended_list ';

		if (!(empty($this->filters)) || !(is_null($this->sQuery))){
			$sql .= ' WHERE '.$q.' '.$f;
		}  
		if (!empty($this->groupBy)){
			$sql .= ' GROUP BY '.$g;
		}
 	return $sql;
	}


	public function execute(){
		$mysqli = pr_connect();
		if ($results = $mysqli->query($this->searchQuery())) {
			$sResult = $results->fetch_all(MYSQLI_ASSOC);
			$this->rowCount = $results->num_rows;
			return $sResult;
		} else {
			return false;
		}

	}
	// function __destruct(){
	// 	// $mysqli->close();
	// }
}