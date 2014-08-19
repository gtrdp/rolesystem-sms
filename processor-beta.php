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
				// identical to index.php in rolesystem
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
				// identical to ident_gejala.php in rolesystem
				if(strlen($message) != 2){
					// wrong format, sends error
					$query = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) ".
						 	 "VALUES ('$phone_number', 'Mohon maaf, terjadi error, silakan mulai dari awal.', 'Gammu')";
					$mysqli->query($query);

					// reset number status
					$mysqli->query("UPDATE clients SET status = '0' WHERE phone_number = '$phone_number'");

					// END
				}else{
					// correct format
					// $message contains selected case
					$case = $rolesystem->query("SELECT * FROM tab_role LEFT JOIN tab_gejala ON tab_gejala.gjl_id=tab_role.role_ident 
									WHERE role_kasus='$message' && role_start=1 ")->fetch_object();

					$user_message = $case->gjl_tanya . "\r\nJawab dengan Y / N.";

					// send SMS
					$query = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) ".
						 	 "VALUES ('$phone_number', '$user_message', 'Gammu')";
					$mysqli->query($query);

					// change user status
					// new status: kasusID;role_identnext;answer_identnext;ke
					$new_status = $message.';'.$case->role_identnext.';'.$case->answer_identnext.';1';
					$mysqli->query("UPDATE clients SET status = '$new_status' WHERE phone_number = '$phone_number'");

					// END
				}
			}else{
				// might be in consulting process, send appropriate response
				// identical to ident_gejala2.php in rolesystems
				if(strlen($message) != 1){
					// wrong format, sends error
					$query = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) ".
						 	 "VALUES ('$phone_number', 'Mohon maaf, terjadi error, silakan mulai dari awal.', 'Gammu')";
					$mysqli->query($query);

					// reset number status
					$mysqli->query("UPDATE clients SET status = '0' WHERE phone_number = '$phone_number'");

					// END
				}else{
					// correct format
					// $message contains yes (Y) or no (N)

					// explode the status
					// kasusID;role_identnext;answer_identnext;ke
					$status = explode(";", $status);
					$kasus_id = $status[0];
					$role_identnext = $status[1];
					$answer_identnext = $status[2];
					$ke = $status[3] + 1;

					// main switching
					if($answer_identnext == '0'){
						// next question
						$case = $rolesystem->query("SELECT * FROM tab_role LEFT JOIN tab_gejala ON tab_gejala.gjl_id=tab_role.role_ident 
						WHERE role_kasus='$kasusid' && role_start=0 && role_ident='$role_identnext' ")->fetch_object();

						$user_message = "Pertanyaan ke-$ke:\r\n".$case->gjl_tanya . "\r\nJawab dengan Y / N.";

						// send SMS
						$query = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) ".
							 	 "VALUES ('$phone_number', '$user_message', 'Gammu')";
						$mysqli->query($query);

						// change user status
						// new status: kasusID;role_identnext;answer_identnext;ke
						$new_status = $kasus_id.';'.$case->role_identnext.';'.$case->answer_identnext.';'.$ke;
						$mysqli->query("UPDATE clients SET status = '$new_status' WHERE phone_number = '$phone_number'");

						// END
					}elseif ($answer_identnext == '1') {
						// decision
						$decision = $mysqli->query("SELECT * FROM tab_diag WHERE diag_id='$role_identnext'")->fetch_object();

						$user_message = 'Diagnosis: ' . $decision->diag_hasil;
						$user_message.= "\r\nSaran: " . $decision->diag_saran;

						// send message
						$query = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) ".
						 	 "VALUES ('$phone_number', '$user_message', 'Gammu')";
						$mysqli->query($query);

						// reset status
						$mysqli->query("UPDATE clients SET status = '0' WHERE phone_number = '$phone_number'");

						// END
					}
				}
			}
		}else{
			// user is not registered yet
			// notify user
			$query = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) ".
					 "VALUES ('$phone_number', 'Maaf, anda belum terdaftar, silakan daftar dengan REG <nama>.', 'Gammu')";
			$mysqli->query($query);
		}
	}
}

?>