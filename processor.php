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
 *  - $caseID: give the first question
 *  - $caseID; 
 */
$mysqli = new mysqli('localhost', 'root', 'root', 'gammu');
$rolesystem = new mysqli('localhost', 'root', 'root', 'rolesystem');

if($mysqli->connect_errno)
	exit($mysqli->connect_error);
if($rolesystem->connect_errno)
	exit($rolesystem->connect_error);

// get the message string and phone number
$query = <<<SQL
	SELECT *
	FROM inbox
	WHERE Processed = 'false'
SQL;
$raw_data = $mysqli->query($query);

// main loop (just in case there are several messages)
while($row = $raw_data->fetch_object()) {
	$phone_number = $row->SenderNumber();
	$message = $row->TextDecoded;

	// main message switch case
	if(substr($message, 0, 3) == 'REG'){
		// check whether the number is already registered
		$query = "SELECT * FROM clients WHERE phone_number = '$phone_number'";
		$user_counts = $mysqli->query($query);

		if($user_counts->num_rows == 0){
			$client_name = trim(substr($message, 3));

			// register the number
			$mysqli->query("INSERT INTO clients (phone_number, client_name) VALUES ('$phone_number', '$client_name')");
			
			// give a success response
			$query = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) ".
					 "VALUES ('$phone_number', 'Terimakasih. Anda telah terdaftar.', 'Gammu')";
			$mysqli->query($query);
		}else{
			// notify user
			$query = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) ".
					 "VALUES ('$phone_number', 'Maaf, anda telah terdaftar, silakan mulai konsultasi dengan mengetikkan START.', 'Gammu')";
			$mysqli->query($query);
		}
	}else{
		// check whether the number is already registered
		$query = "SELECT * FROM clients WHERE phone_number = '$phone_number'";
		$user_counts = $mysqli->query($query);

		if($user_counts->num_rows > 0){
			// check current status
			$status = $mysqli->query("SELECT * FROM clients WHERE phone_number = '$phone_number'")->fetch_object()->status;

			if($status == '0'){
				// initial condition, send case list
				$case = $rolesystem->query("SELECT * FROM tab_kasus ORDER BY id");

				$user_message = "Silakan pilih kasus di bawah ini:\r\n";
				while($foo = $case->fetch_object())
					$user_message .= "$foo->kasus_judul ($foo->kasus_id)";

				// send SMS
				$query = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) ".
					 	 "VALUES ('$phone_number', '$user_message', 'Gammu')";
				$mysqli->query($query);

				// change user status
				$mysqli->query("UPDATE clients SET status = '1' WHERE phone_number = '$phone_number'");

				// END
			}elseif($status == '1'){
				// second condition, send case list
				// $message contains selected case
				if(strlen($message) != 2){
					// wrong format, sends error
					// reset number status
				}else{
					$case = $rolesystem->query("SELECT * FROM tab_role LEFT JOIN tab_gejala ON tab_gejala.gjl_id=tab_role.role_ident 
									WHERE role_kasus='$kasusid' && role_start=1 ");

					$user_message = "Silakan pilih kasus di bawah ini:\r\n";
					while($foo = $case->fetch_object())
						$user_message .= "$foo->kasus_judul ($foo->kasus_id)";

					// send SMS
					$query = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) ".
						 	 "VALUES ('$phone_number', '$user_message', 'Gammu')";
					$mysqli->query($query);

					// change user status
					$mysqli->query("UPDATE clients SET status = '1' WHERE phone_number = '$phone_number'");

					// END
				}
			}
		}else{
			// notify user
			$query = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) ".
					 "VALUES ('$phone_number', 'Maaf, anda belum terdaftar, silakan daftar dengan REG <nama>.', 'Gammu')";
			$mysqli->query($query);
		}
	}
}

function give_error(){

}

?>