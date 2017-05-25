# PHP-Database-Class
---------------------
OOP Database class for PHP MySQL connection and insert, update, delete and select query

CONFIG File
------------

All database configurations are stored in seperate config.ini.php file, which can be kept off document root.

DATABASE CONNECTION AND QUERIES
-------------------------------

Database class loads configuration file and establishes a MySQLi connect in constructor so just creating an instance of class connects you with database.

e.g: 

$db = new MySQLDb; // would connect to database


To run any kind of query (select, insert, update, delete), pass SQL query to query method of class

e.g: 

$query = "select * from table_name";

$result = $db->query($query); //$result object returns true on successful execution


To select rows after executing query, use fetch() method and store result in an array

e.g: 

$rows = $db->fetch();


Examples of Use:
---------------
examples.php has a create table SQL to create a test table and load some data in it

Examples includes quering database, checking result object and examples of select, insert, update and delete queries.
