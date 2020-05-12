<?php
/*

░▒▓█ ACCOUNTING DOUBLE ENTRY ALGORITHM █▓▒░

*/


//DB connection variables
$host = 'localhost';
$user = 'root';
$password = '1995';

//create mysql connection
$mysqli = new mysqli($host,$user,$password);
if ($mysqli->connect_errno) {
    printf("Connection failed: %s\n", $mysqli->connect_error);
    die();
}

//Drop database if exist
$mysqli->query('
DROP DATABASE IF EXISTS `accounting`;
') or die($mysqli->error);


//create the database
if ( !$mysqli->query('CREATE DATABASE accounting') ) {
    printf("Errormessage: %s\n", $mysqli->error);
}


//create sheet table
$mysqli->query('
CREATE TABLE `accounting`.`sheet`
(
    `sheet_id` VARCHAR(20) NOT NULL,
    `sheet_name` VARCHAR(50) NOT NULL,
	 PRIMARY KEY (`sheet_id`)
);') or die($mysqli->error);

//create account table
$mysqli->query('
CREATE TABLE `accounting`.`account`
(
    `account_id` VARCHAR(20) NOT NULL,
    `sheet_id` VARCHAR(50) NOT NULL,
    `account_name` VARCHAR(20) NOT NULL,
	 PRIMARY KEY (`sheet_id`,`account_id`)
);') or die($mysqli->error);


//create transactions table
$mysqli->query('
CREATE TABLE `accounting`.`transaction`
(
    `trans_id` VARCHAR(10) NOT NULL,
    `sheet_id` VARCHAR(50) NOT NULL,
    `account_id` VARCHAR(10) NOT NULL,
    `trans_date` VARCHAR(20) NOT NULL,
    `trans_detail` VARCHAR(40) NOT NULL,
    `trans_amount` VARCHAR(10) NOT NULL,
    `trans_type` VARCHAR(10) NOT NULL,
	 PRIMARY KEY (`trans_id`)
);') or die($mysqli->error);

echo "Information added to database successfully";

?>
