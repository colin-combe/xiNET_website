<?php
    //your connection string here
    // $connectionString = "host= dbname= user= password=";
    include('./uploadsConnectionString.php');
    $id = $_POST["id"];
    $layout = $_POST["layout"];
	$dbconn = mysqli_connect($server,$user,$password) or die('Could not connect: ' . mysqli_error($dbconn));
    mysqli_select_db($dbconn, $db) or die("Could not select database.");
    $query = "UPDATE upload SET layout = '" . $layout . "' WHERE rand = '" . $id . "';";
    //echo $query;
    $result = mysqli_query($dbconn, $query) or die('Query failed: ' . mysqli_error($dbconn));
    echo 'Layout saved';
    mysqli_close($dbconn);
        
?>
