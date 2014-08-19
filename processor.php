<?php
/**
 * This script is executed when a new message is received
 *
 * clients table legends:
 * |----|--------------|-------------|--------|
 * | id | phone_number | client_name | status |
 * |----|--------------|-------------|--------|
 *
 * clients table's status legends:
 *  - 0: user just freshly registered -> give case selection
 *  - 1: first case selection sent -> give first question 
 *  - kasusID;role_identnext;answer_identnext;ke: consultation process
 */
$mysqli = new mysqli('localhost', 'root', '', 'gammu');
// $rolesystem = new mysqli('localhost', 'root', '', 'rolesystem');

if($mysqli->connect_errno)
	exit($mysqli->connect_error);
// if($rolesystem->connect_errno)
// 	exit($rolesystem->connect_error);

$query = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) ".
					 "VALUES ('081578762345', 'Terimakasih. Anda telah terdaftar.', 'Gammu')";
$mysqli->query($query);

?>