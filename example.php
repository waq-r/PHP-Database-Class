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
if($result){
	echo "<br> successfully inserted ";
}

//update a row in table
$query = "update guestbook set user = 'user1' where id = 3";
$result = $db->query($query);

if($result){
	echo "<br> successfully updated ";
}

//delete a row in table
$query = "delete from guestbook where id = 2";
$result = $db->query($query);
if($result){
	echo "<br> successfully deleted ";
}


?>