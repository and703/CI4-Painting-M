<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/parking.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Parking($db);

    $item->slot = isset($_GET['slot']) ? $_GET['slot'] : die();
  
    $item->getSingleParking();

    if($item->slot != null){
        // create array
        $emp_arr = array(
            "id" =>  $item->id,
            "slot" => $item->slot,
            "MAT_IP_CODE" => $item->MAT_IP_CODE,
            "CURE" => $item->CURE
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }else{
        http_response_code(404);
        echo json_encode("Employee not found.");
    }
?>
<p><?=$item->slot?><p>