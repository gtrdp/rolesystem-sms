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

if($mysqli->connect_errno)
	exit($mysqli->connect_error);

// get the message string and phone number
$query = <<<SQL
	SELECT *
	FROM inbox
	WHERE Processed = 'false'
SQL;
$raw_data = $mysqli->query($query);

$data = $raw_data->fetch_object();

$sender = $data->SenderNumber;
$date = $data->ReceivingDateTime;
$message = $data->TextDecoded;

if(substr($message, 0, 3) == 'REG'){
	$nama = trim(substr($message, 3));
	$query = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) ".
						 "VALUES ('$sender', 'Terimakasih. Anda telah terdaftar Sdr. $nama . Balas mulai untuk mulai konsultasi.', 'Gammu')";
	$mysqli->query($query);
	$query = "UPDATE inbox SET Processed = 'true' WHERE ReceivingDateTime = '$date'";
	$mysqli->query($query);
}else if($message == 'mulai'){
	$query = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) ".
						 "VALUES ('$sender', 'Apakah ada bintik-bintik merah di kulit? Ya (Y). Tidak (T).', 'Gammu')";
	$mysqli->query($query);
	$query = "UPDATE inbox SET Processed = 'true' WHERE ReceivingDateTime = '$date'";
	$mysqli->query($query);
}else if($message == 'Y'){
$query = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) ".
						 "VALUES ('$sender', 'Diagnosis: Demam Berdarah. Saran: Segera ke dokter.', 'Gammu')";
	$mysqli->query($query);
	$query = "UPDATE inbox SET Processed = 'true' WHERE ReceivingDateTime = '$date'";
	$mysqli->query($query);
}else if($message == 'T'){
	$query = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) ".
						 "VALUES ('$sender', 'Diagnosis: Insya Allah Sehat. Saran: Jaga kesehatan.', 'Gammu')";
	$mysqli->query($query);
	$query = "UPDATE inbox SET Processed = 'true' WHERE ReceivingDateTime = '$date'";
	$mysqli->query($query);
}else{
	$query = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) ".
						 "VALUES ('$sender', 'Maaf format anda salah. Balas mulai untuk mulai konsultasi.', 'Gammu')";
	$mysqli->query($query);
	$query = "UPDATE inbox SET Processed = 'true' WHERE ReceivingDateTime = '$date'";
	$mysqli->query($query);
}

?>