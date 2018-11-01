<?php
	if (session_status() === PHP_SESSION_NONE){session_start();}

    include('../../vendor/php/utils.php');
    //you could comment out the following line and have no login authentication.
    ajaxBootOut();

    include('../../connectionString.php');
    //open connection
    try {
        // @ suppresses non-connection throwing an uncatchable error, so we can generate our own error to catch
        $dbconn = pg_connect($connectionString) or die('Could not connect: ' . pg_last_error());

        if ($dbconn) {
            //error_log (print_r ($_SESSION, true));
            //error_log (print_r ($_POST, true));

            $qPart1 = "select mod_name, mass from modifications m INNER join uploads u on m.upload_id = u.id where u.user_id = $1 and m.mass != 0 order by u.upload_time DESC; ";
            pg_prepare($dbconn, "my_query", $qPart1);
            $result = pg_execute($dbconn, "my_query", [$_SESSION['user_id']]);

            $data = pg_fetch_all($result);
            for ($d = 0; $d < count($data); $d++) {
                $item = $data[$d];
                if (!empty($item)){
                    // json decoding
                    $item["mod_name"] = $item["mod_name"];
                    $item["mass"] = number_format($item["mass"], 6);
                    $data[$d] = $item;
                }
            }
			if ($data[0] == null) $data = [];

            echo json_encode(array("user"=>$_SESSION['session_name'], "data"=>$data));

            //close connection
            pg_close($dbconn);
        } else {
            throw new Exception("Cannot connect to Database ☹");
        }
    } catch (Exception $e) {
        if ($dbconn) {
            pg_close($dbconn);
        }
        $msg = $e->getMessage();
        echo(json_encode(array("status"=>"fail", "error"=> "Error - ".$msg)));
    }

	//
	// if (isset($_SESSION['tmpDB'])){
	// 	$dbname = "tmp/".session_id();
	// }
	// else {
	// 	$dbname = "saved/".$_GET['db'];
	// }
	//
	// if(!in_array($_GET['db'], $_SESSION['access'])){
	// 	$json['error'] = "Authentication error occured!";
	// 	die(json_encode($json));
	// }
	//
	// $xiSPEC_ms_parser_dir = '../../xiSPEC_ms_parser/';
	// $dir = 'sqlite:'.$xiSPEC_ms_parser_dir.'/dbs/'.$dbname.'.db';
	//
	// $dbh = new PDO($dir) or die("cannot open the database");
	// $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// $query =  "SELECT * FROM modifications;";
	//
	// $res = array();
	//
	// foreach ($dbh->query($query) as $row)
	// {
	// 	$mod = [
	// 		"id" => $row['mod_name'],
	// 		"mass" => floatval($row['mass']),
	// 		"aminoAcids" => str_split($row['residues']),
	// 	];
	// 	array_push($res, $mod);
	// }
	//
	// $arr = array('modifications' => $res);
	// header('Content-type: application/json');
	// echo json_encode($arr);

?>
