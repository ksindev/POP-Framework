<?php 
require_once '../config.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$district_list = get_district_list();
	
echo json_encode($district_list, JSON_NUMERIC_CHECK);

exit;
