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
$searchMCH = mysqli_real_escape_string($con,$_POST['searchMCH']);
$searchPark = mysqli_real_escape_string($con,$_POST['searchPark']);

## Search 
$searchQuery = " ";
if($searchValue != ''){
    $searchQuery = " and ( USERNAME like '%".$searchValue."%' or IP_CODE like '%".$searchValue."%' ) ";
}

// Date filter
if($searchByFromdate != '' && $searchByTodate != ''){
    $searchQuery .= " and (PRINT_OUT between '".$searchByFromdate." 00:00:00' and '".$searchByTodate." 23:59:59' ) ";
}

// Shift filter
if($searchShift != ''){
    $searchQuery .= " and (SHIFT = '".$searchShift."' ) ";
}

// MCH filter
if($searchMCH != ''){
    $searchQuery .= " and (MCH like '%".$searchMCH."%' ) ";
}

// SLOT filter
if($searchPark != ''){
    $searchQuery .= " and (SLOT like '%".$searchPark."%' ) ";
}


## Total number of records without filtering
$sel = mysqli_query($con,"select count(*) as allcount from v_tbl_allprint");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($con,"select count(*) as allcount from v_tbl_allprint WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from v_tbl_allprint WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($con, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
    $data[] = array(
    		"MCH"=>$row['MCH'],
    		"IP_CODE"=>$row['IP_CODE'],
    		"MAT_DESC"=>$row['MAT_DESC'],
    		"AMOUNT"=>$row['AMOUNT'],
    		"SLOT"=>$row['SLOT'],
    		"PRINT_OUT"=>$row['PRINT_OUT'],
    		"USERNAME"=>$row['USERNAME'],
    		"GROUP_PAINT"=>$row['GROUP_PAINT'],
    		"SHIFT"=>$row['SHIFT'],
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
