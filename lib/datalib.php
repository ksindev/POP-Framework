<?php

function set_service_data($service_data) {

	global $db;
	
	if (NULL == $service_data) {
		// TO DO: HANDLE ERROR
	}
	
	if (isset($service_data['id']) && $service_data['id'] != 0) {
		$service_id = $service_data['id'];
		// update_service_data();		
	} else {
		$service_id = insert_service_data($service_data);
	}

	
	return $service_id;
}

function insert_service_data($service_data) {

	global $db;
	
	$service_id = 0;
	
	$table_name = 'service';

	if (NULL == $service_data) {
		// TO DO: HANDLE ERROR
		return $service_id;
	}
	
	if (
		($service_data['name'] != "" && $service_data['service_category_id'] != "")
			&& ($service_data['district_id'] != "" && $service_data['location_area_id'] != "")
	) {
		
		print_r($service_data); exit;
		
		$service_address_data = array();
		
		$service_id = inset_into_table($table_name, $service_data);
		
		$service_address_id = inset_into_table('service_address', $service_address_data);
		
		//$result = $db->query("SELECT id, name FROM `service_category` WHERE delete_flag = 0");
	} else {
		echo "Service Input Error: Mandatory Fields Missing";
		exit;
	}

	return $service_id;
}


function get_service_category_array($delete_flag =0) {

	global $db;

	$result = $db->query("SELECT id, name FROM `service_category` WHERE delete_flag = 0");

	$category_list = array();

	while ($row = $result->fetch_assoc()) {
		$category_list[$row['id']] = $row['name'];
	}

	return $category_list;
}


function get_service_category_list($delete_flag =0) {

	global $db;

	$result = $db->query("SELECT id, name FROM `service_category` WHERE delete_flag = 0");

	$category_list = array();

	while ($row = $result->fetch_assoc()) {
		$category_list[] = $row;
	}

	return $category_list;
}

function get_district_list($delete_flag =0) {
	
	global $db;
	
	$result = $db->query("SELECT id, name FROM `district` WHERE delete_flag = 0");
	
	$district_list = array();
	
	while ($row = $result->fetch_assoc()) {
		$district_list[] = $row;
	}
	
	return $district_list;	
}

function get_area_list($district_id = 0, $delete_flag = 0) {

	global $db;
	
	$district_filter = '';
	
	if ($district_id > 0 ) {
		
		$district_id = $db->quote($district_id);
		
		$district_filter = " AND district_id =".$district_id;
	}

	$result = $db->query("SELECT id, name, district_id FROM `location_area` WHERE delete_flag = 0".$district_filter);

	$area_list = array();

	while ($row = $result->fetch_assoc()) {
		$area_list[] = $row;
	}

	return $area_list;
}

function insert_area_data($area_data) {

	global $db;
	
	$area_id = 0;
	
	$table_name = 'location_area';

	if (NULL == $area_data) {
		// TO DO: HANDLE ERROR
		return $area_id;
	}
	
	if (($area_data['name'] != "" && $area_data['district_id'] != "")) {
		
		//debug print_r($area_data); exit;
		
		$area_id = $db->inset_into_table($table_name, $area_data);
		
	} else {
		
		echo "Service Input Error: Mandatory Fields Missing";
		
		exit;
	}

	return $area_id;
}

function get_service_list($category_id = 0, $location_id = 0, $district_id = 0, $delete_flag = 0) {

	global $db;

	$service_filter = '';

	if ($location_id > 0 ) {

		$location_id = $db->quote($location_id);

		$service_filter.= " AND location_area_id =".$location_id;
	}
	
	if ($district_id > 0 ) {
	
		$district_id = $db->quote($district_id);
	
		$service_filter.= " AND district_id =".$district_id;
	}

	if ($category_id > 0 ) {

		$category_id = $db->quote($category_id);

		$service_filter.= " AND service_category_id =".$category_id;
	}

	$result = $db->query("SELECT id, name, description, service_category_name FROM `service` WHERE delete_flag = 0".$service_filter);

	$service_list = array();

	while ($row = $result->fetch_assoc()) {
		$service_list[] = $row;
	}

	return $service_list;
}