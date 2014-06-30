<?php

// for gammu DB
$gammu_db = new mysqli("localhost", "root", "root", "smsd");
if ($gammu_db->connect_errno) {
    echo "Failed to connect to MySQL: " . $gammu_db->connect_error;
}

// for rolesystem DB
$rolesystem_db = new mysqli("localhost", "root", "root", "rolesystem");
if ($rolesystem_db->connect_errno) {
    echo "Failed to connect to MySQL: " . $rolesystem_db->connect_error;
}

// check unprocessed inbox
$result = $gammu_db->query("SELECT * FROM inbox WHERE Processed == 'false'");

while ($row = $result->fetch_assoc()) {
	$result2 = $gammu_db->query("SELECT * FROM reg WHERE phone_number = ");
}

// for each number in unprocessed inbox

// 		check the current stage of the number
//		whether it is case selection, ident gejala, or ident gejala2

//		if complete, set the number stage to finish stage



?>