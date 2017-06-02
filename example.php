<?php
require_once('database.class.php');

/**
* database table used in this example
*
CREATE TABLE `guestbook` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `message` varchar(400) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

*
* some random data inserted
*
insert into guestbook (user, message, DATE) values ('me', 'anything', now());
insert into guestbook (user, message, DATE) values ('user', 'a message', now());
insert into guestbook (user, message, DATE) values ('user1', 'new message', now());


**/


//run select query and display results
$db = new MySQLDb;
$query = "select * from guestbook";
$result = $db->query($query);

//check total number of rows returned
// var_dump($result); to see details of returned object
echo "number of rows in result set = ".$result->num_rows;

//fetch those rows into $rows
$rows = $db->fetch();
var_dump($rows);

//insert into table query
$query = "insert into guestbook (user, message, DATE) values ('user', 'a message', now())";
$result = $db->query($query);

//$result will return false if query was unsucsessful
echo ($result) ? "<br> Successfully inserted" : "<br> Insert query was not successfull";

//update a row in table
$query = "update guestbook set user = 'user1' where id = 3";
$result = $db->query($query);
echo ($result) ? "<br> Successfully update" : "<br> Update query was not successfull";

//delete a row in table
$query = "delete from guestbook  id = 2";
$result = $db->query($query);
echo ($result) ? "<br> Successfully deleted" : "<br> Delete query was not successfull";

/* SQL Injection Prevention
Use prepareed statement and bind variables
Most common attacks can be prevented by binding variables
Use PHP sanitize filters on user inputs
e.g: FILTER_SANITIZE_NUMBER_INT will remove all non-int from integer inputs
more info: 
http://us3.php.net/manual/en/filter.filters.sanitize.php
http://php.net/manual/en/pdo.prepared-statements.php
*/

// sanitize user id input, remove all non digit characters
	$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

// Insert query with prepare and bind 
	$values = array(0 => 'userx', 1 => 'guest message', 2 => date("Y-m-d H:i:s"));
	$stmt = $db->connection->prepare("INSERT INTO guestbook (fid, user, message, DATE) VALUES (?, ?, ?, ?)");
	if($stmt){
// bind variables here "sss" declares 1st, 2nd & 3rd values are string, use i for integer
	$stmt->bind_param("sss", $values[0], $values[1], $values[2]);
	$stmt->execute();
	}

?>