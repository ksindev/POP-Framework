<?php
class MySql {
	
	protected static $connection;
	
	public function __construct($host, $user, $pass, $database) {
		if (!isset(self::$connection)) {
			self::$connection = new mysqli($host, $user, $pass, $database);
		}
		if (self::$connection === false) {
			//TO DO: implement error logging	
			echo "Connection error: ".$host;
			exit;
		}		
	}
	
	public function query($query) {
		if (self::$connection === false) {
			//TO DO: implement error logging
			return false;
		} 
		//debug echo $query; exit;
		$result = self::$connection->query($query);
		return $result;
	}
	


	public function inset_into_table($table_name, $data) {
		
		if ($table_name && count($data)) {
			$fields = array_keys($data);
			$values = array_values($data);
			$insert_statement = "INSERT INTO ".$table_name." (".implode(",", $fields)." )";
			
			$value_string = "";
			$count =0;
			foreach ($values as $v) {
				if ($count) $value_string.= ", ";
				$value_string.= $this->quote($v);
				$count++;
			}
			$insert_statement.= " VALUES (".$value_string." );";				
		}
		
		$result = self::$connection->query($insert_statement);
		return $result;
	}
	
	public function quote($value) {
		if (self::$connection === false) {
			//TO DO: implement error logging
			return false;
		}
		$escapedString = self::$connection->real_escape_string($value);
		return "'". $escapedString . "'";
	}
	
	public function error() {
		return self::$connection->error;
	}
}