<?php

	if (session_status() === PHP_SESSION_NONE){session_start();}
	// unset($_SESSION['db']);
	$_SESSION['tmpDB'] = session_id();
	$target_dir = "../../uploads/".session_id()."/";
	$mzid_file = $target_dir . $_POST['mzid_fn'];
	$mzml_file = $target_dir . $_POST['mzml_fn'];
	$command = escapeshellcmd('../python_env/bin/python ../py/parser.py '.$mzid_file.' '.$mzml_file. ' '.session_id());
	//echo $command;
	// echo "<br/>";
	$output = shell_exec($command);
	echo $output;

?>
