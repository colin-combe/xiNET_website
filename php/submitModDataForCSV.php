<?php
	include_once('../../vendor/php/utils.php');
	// if (session_status() === PHP_SESSION_NONE){session_start();}

	$identifier = $_POST['identifier'];

	include('../../connectionString.php');
	$dbConn = pg_connect($connectionString) or die('Could not connect: ' . pg_last_error());

    $upload_id = validateID_RandID($dbConn, $identifier);

	if ($upload_id > 0) {
		// Prepare a query for execution
		pg_prepare($dbConn, "my_query", 'INSERT INTO modifications (upload_id, mod_name, mass, residues, accession) VALUES ($1, $2, $3, $4, $5)');

		$i = 0;
		foreach ($_POST['mods'] as $modname) {
			$result = pg_execute($dbConn, "my_query", [$upload_id, $modname, $_POST['modMasses'][$i], '*', '']) or die('Query failed: ' . pg_last_error());
			$i++;
		}
		// }// Free resultset
		pg_free_result($result);
	}
	// Closing connection
	pg_close($dbConn);



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
