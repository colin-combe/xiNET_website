<?php

	// if (session_status() === PHP_SESSION_NONE){session_start();}

	$identifier = $_POST['identifier'];
	$dashSeperated = explode("-" , $identifier);
	$randId = implode('-' , array_slice($dashSeperated, 1 , 4));
	$upload_id = $dashSeperated[0];

	include('../../connectionString.php');
	$dbconn = pg_connect($connectionString) or die('Could not connect: ' . pg_last_error());
	// Prepare a query for execution
	pg_prepare($dbconn, "my_query", 'INSERT INTO modifications (upload_id, mod_name, mass, residues, accession) VALUES ($1, $2, $3, $4, $5)');

	$i = 0;
	foreach ($_POST['mods'] as $modname) {
		$result = pg_execute($dbconn, "my_query", [$upload_id, $modname, $_POST['modMasses'][$i], '*', '']) or die('Query failed: ' . pg_last_error());
		$i++;
	}
	// }// Free resultset
	pg_free_result($result);
	// Closing connection
	pg_close($dbconn);



	// $dbh = new PDO($dir) or die("cannot open the database");
	// $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//
	// 	try {
	// 		$stmt->execute();
	// 	}
	// 	catch (PDOException $e) {
	// 		if ($e->getCode() == 23000) {
	// 				$stmt = $dbh->prepare("UPDATE modifications SET mass=:modmass WHERE name==:modname;");
	// 				$stmt->bindParam(':modname', $modname, PDO::PARAM_STR);
	// 				$stmt->bindParam(':modmass', $_POST['modMasses'][$i], PDO::PARAM_STR);
	// 				$stmt->execute();
	// 		} else {
	// 				die(json_encode($e));
	// 		}
	// 	}
	//

	// header("Location: ../../xi3/network.php?upload=" + $identifier);
	// die();

?>
