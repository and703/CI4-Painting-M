<?php
//SQLSERVER CON
$serverName = "172.21.202.240"; // "172.21.202.142"; 
$uid = "Traceability";   
$pwd = "ability";  
$databaseName = "PCS"; 

//MYSQL CON
$server = "localhost";
$username = "root";
$password = "";
$dbname = "SQL_PCS";

$connectionInfo = array( "UID"=>$uid,                            
                         "PWD"=>$pwd,                            
                         "Database"=>$databaseName); 

//include 'dc_containment_units.php';
//include 'dc_production_data.php';
include 'his_dc_production_data.php';
//include 'DC_CONTAINMENT_UNIT.php';
//include 'DC_CONTAINMENT_UNIT.php';
//include 'DC_CONTAINMENT_UNIT.php';

$stmt = sqlsrv_query( $conn, $tsql );
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}

$con = new mysqli($server, $username, $password, $dbname);

while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
    // Check connection
    if ($con->connect_error) {
      die("Connection failed: " . $con->connect_error);
    }
    $columns = implode(", ",array_keys($row));
    foreach ($row as $idx=>$data) $row[$idx] = "'".$data."'";
    $values  = implode(", ", $row);
    $query = "INSERT IGNORE INTO $tableName ($columns) VALUES ($values)";
    if ($con->query($query) === TRUE) {
    } else {
      echo "Error: " . $query . "<br>" . $con->error;
    }
}
echo 'Added : ' . mysqli_affected_rows($con);
$con->close();
?>