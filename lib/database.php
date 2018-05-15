<?php
include_once($config['libdir'].'/db/mysql.php');

function setup_database() {
	global $db, $config;
	
	$db = new MySql($config['db_host'], $config['db_user'], $config['db_password'], $config['db_database']);	
	
	return true;
}
