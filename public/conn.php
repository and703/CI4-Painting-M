<?php
date_default_timezone_set('Asia/Jakarta');

<<<<<<< HEAD
//MYSQL CON1
=======
>>>>>>> ebb5504 (Add parking management features with dynamic updates and manual tag confirmation)
define('HOST','localhost');
define('USER','root');
define('PASS','');
define('DB1', 'pcs');

//MYSQL CON2
define('HOST1','localhost');
define('USER1','root');
define('PASS1','');
define('DB2', 'pcs');

//SQLSERVER CON
$serverName = "172.21.202.142"; 
$uid = "Traceability";   
$pwd = "ability";  
$databaseName = "PCS"; 
$connectionInfo = array( "UID"=>$uid,                            
						"PWD"=>$pwd,                            
						"Database"=>$databaseName);  

$db1 = new mysqli(HOST, USER, PASS, DB1);
$conn = new mysqli(HOST, USER, PASS, DB1);
<<<<<<< HEAD
$conn1 = sqlsrv_connect( $serverName, $connectionInfo); 
$conn2 = new mysqli(HOST1, USER1, PASS1, DB2);
=======
>>>>>>> ebb5504 (Add parking management features with dynamic updates and manual tag confirmation)

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
<<<<<<< HEAD
if ($conn2->connect_error) {
	die("Connection failed: " . $conn2->connect_error);
}

=======
>>>>>>> ebb5504 (Add parking management features with dynamic updates and manual tag confirmation)
?>
