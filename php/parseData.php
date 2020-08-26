<?php

	error_reporting(E_ERROR | E_PARSE);

	if (session_status() === PHP_SESSION_NONE){session_start();}
	if (!isset($_SESSION['session_name'])) {
        header("location:../login.php");
        exit();
    }

	$target_dir = "../uploads/".session_id()."/";
	if( isset($_POST['res_fn'])){
		$id_file = $_POST['res_fn'];
		$id_arg = $target_dir . escapeshellarg($id_file);
	}
	else {
		die('error: invalid post data!');
	}
	$argStr = ' -i '.$id_arg;

	if (isset($_POST['peakFile_fn'])){
			$pl_file = $_POST['peakFile_fn'];
			$pl_arg = $target_dir . escapeshellarg($pl_file);
			$argStr = $argStr.' -p '.$pl_arg;
	}

	$argStr = $argStr.' -s '.session_id().' -u '.$_SESSION['user_id'].' --postgresql';

	$xiSPEC_ms_parser_dir = '../../xiSPEC_ms_parser/';

	$command = $xiSPEC_ms_parser_dir.'python_env/bin/python '.$xiSPEC_ms_parser_dir.'parser.py '.$argStr;
	// die($command);
	// echo "<br/>";
	$output = shell_exec($command);
	echo $output;

?>
