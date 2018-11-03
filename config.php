<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0");
$config =  array();

$config['db_host'] = 'localhost';
$config['db_user'] = 'dbuser';
$config['db_password'] = 'dbpass';
$config['db_database'] = 'database';

$config['site_name']= 'Site Name';
$config['document_root']= dirname(__FILE__);
$config['http_root']= 'http://www.yoursite.com';
$config['https_root']= 'https://www.yoursite.com';
$config['resource_root']= 'http://www.yoursite.com/resources';

//$GLOBALS['config'] = $config;

require_once(dirname(__FILE__) . '/lib/setup.php');
