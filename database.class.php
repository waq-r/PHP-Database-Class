<?php

class MySQLDb {
public $connection;
public $result;
private $db;

/**
 * Loads DB config file and sets $this->db property
 * Constructor establishes database connection using connectToDb()
 * example usage
 * $db = new MySQLDb;
 */
public function __construct(){
	$this->db = parse_ini_file("config.ini.php");
	$this->connectToDb();


}

/**
 * connectToDb establishes database connection
 * @return only returns an error if connection was unsuccessful
 * Method used through __construct() only
 */
private function connectToDb(){
	$this->connection = new mysqli($this->db['host'], $this->db['username'], $this->db['password'], $this->db['db_name']);
	if(mysqli_connect_error()){
		return "can not connect to database ".mysqli_connect_error();
	}

}

/**
 * Run select, insert, update or delete query
 * A successful query will return $result as true
 * For select query after query() run fetch() to fetch result rows
 * @return result object returned, contains details like $result->num_rows
 * @param $query a query to be run
 * example usage
 * $query = "select * from table"; // or insert, update, delete query
 * $result = $db->query($query);
 */
public function query($query){
	$this->result = $this->connection->query($query);
	return $this->result;

}
/**
 * For select queries run query($query) and then fetch() to get result rows
 * @return associative array of all selected rows
 * example usage
 * $rows = $db->fetch();
 */
public function fetch(){
	if(!$this->result){
		return "no results";
	}
	while($row = $this->result->fetch_assoc()){
		$rows[] = $row;
	}
	return $rows;
}


}


?>