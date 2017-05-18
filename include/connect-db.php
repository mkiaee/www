<?php 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'preservation');

function pr_connect(){
	$dbconnection =  mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
   if (mysqli_connect_errno()) {
   		die("connection Failed: " . mysqli_connect_error());
   }
   return $dbconnection;
}

function pdo_connect(){
	try {
	    $conn = new PDO("mysql:host=".DB_SERVER."dbname=".DB_DATABASE, DB_USERNAME, DB_PASSWORD);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    echo "pdo connection success!";
	    return $conn;
	    }
	catch(PDOException $e)
	    {
	    die("Connection failed: " . $e->getMessage());
	    }

}
