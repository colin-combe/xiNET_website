<?php

	error_reporting(E_ERROR | E_PARSE);

	if (session_status() === PHP_SESSION_NONE){session_start();}
	if (!isset($_SESSION['session_name'])) {
        header("location:../login.php");
        exit();
    }

	if( isset($_POST['res_fn']) && isset($_POST['peakFile_fn']) ){
		$id_file = $_POST['res_fn'];
		$pl_file = $_POST['peakFile_fn'];

		$target_dir = "../uploads/".session_id()."/";
		$id_arg = $target_dir . escapeshellarg($id_file);
		$pl_arg = $target_dir . escapeshellarg($pl_file);
		$upload_arg = session_id();
	//	$ftp_arg = '';
	}
	else {
		die('error: invalid post data!');
	}

	$xiSPEC_ms_parser_dir = '../../xiSPEC_ms_parser/';

	$argStr = implode(' ', [$id_arg, $pl_arg, $upload_arg, $_SESSION['user_id']]);

	$command = $xiSPEC_ms_parser_dir.'python_env/bin/python '.$xiSPEC_ms_parser_dir.'parser.py '.$argStr;
	// die($command);
	// echo "<br/>";
	$output = shell_exec($command);
	echo $output;

?>
