<?php
ini_set('display_errors', '1');
error_reporting(E_ERROR);
// Set up some paths.
$config['libdir'] = $config['document_root'] .'/lib';
$config['html_dir'] = $config['document_root'] .'/html';

global $config;
/**
 * Database connection. Used for all access to the database.
 * @global Database $db
 * @name $db
 */
global $db;

// Load up standard libraries
require_once($config['libdir'] .'/database.php');      // Database access
require_once($config['libdir'] .'/datalib.php');       // Legacy lib with a big-mix of functions.

setup_database();