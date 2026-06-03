<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/req_cure.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Req_Cure($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->cure_MCH = $data->cure_MCH;
    $item->IPCode = $data->IPCode;
    $item->status = $data->status;
    $item->req_added = date('Y-m-d H:i:s');
    $item->req_done = '';
    
    if($item->createEmployee()){
        echo 'Employee created successfully.';
    } else{
        echo 'Employee could not be created.';
    }
?>