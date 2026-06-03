<?php
include 'config.php';

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

## Date search value
$searchByFromdate = mysqli_real_escape_string($con,$_POST['searchByFromdate']);
$searchByTodate = mysqli_real_escape_string($con,$_POST['searchByTodate']);

## Data search value
$searchShift = mysqli_real_escape_string($con,$_POST['searchShift']);
$searchMAT_IP_CODE = mysqli_real_escape_string($con,$_POST['searchMAT_IP_CODE']);
$searchCured_stts = mysqli_real_escape_string($con,$_POST['searchCured_stts']);

## Search 
$searchQuery = " ";
if($searchValue != ''){
    $searchQuery = " and ( MAT_IP_CODE like '%".$searchValue."%' or MAT_DESC like '%".$searchValue."%' ) ";
}

// Date filter
if($searchByFromdate != '' && $searchByTodate != ''){
    $searchQuery .= " and (CURE_TIME between '".$searchByFromdate." 00:00:00' and '".$searchByTodate." 23:59:59' ) ";
}

// Shift filter
if($searchShift != ''){
    $searchQuery .= " and (SHIFT = '".$searchShift."' ) ";
}

// MCH filter
if($searchMAT_IP_CODE != ''){
    $searchQuery .= " and (MAT_IP_CODE like '%".$searchMAT_IP_CODE."%' ) ";
}

// SLOT filter
if($searchCured_stts != ''){
    $searchQuery .= " and (cured_stts like '".$searchCured_stts."' ) ";
}


## Total number of records without filtering
$sel = mysqli_query($con,"select count(*) as allcount from bf_cure");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($con,"select count(*) as allcount from bf_cure WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from bf_cure WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($con, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
    $data[] = array(
    		"MM_CODE"=>$row['MM_CODE'],
    		"WM_NAME_WM_SURNAME"=>$row['WM_NAME_WM_SURNAME'],
    		"MAT_IP_CODE"=>$row['MAT_IP_CODE'],
    		"MAT_DESC"=>$row['MAT_DESC'],
    		"Amount"=>$row['Amount'],
    		"Park"=>$row['Park'],
    		"CURE_TIME"=>$row['CURE_TIME'],
    		"cured_stts"=>$row['cured_stts'],
    		"actual_cure"=>$row['actual_cure'],
    	);
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
die;
