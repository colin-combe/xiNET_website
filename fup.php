<?php

    //your connection string here
    // $connectionString = "host= dbname= user= password=";
    include('./connection.php');

    //if ($_FILES["upfile"]["error"] > 0) {
    //    echo "Error: " . $_FILES["upfile"]["error"] . "<br />";
    //} else {
    //    echo "Upload: " . $_FILES["upfile"]["name"] . "<br />";
    //    echo "Type: " . $_FILES["upfile"]["type"] . "<br />";
    //    echo "Size: " . ($_FILES["upfile"]["size"] / 1024) . " Kb<br />";
    //    echo "Stored in: " . $_FILES["upfile"]["tmp_name"];
    //}

    if (empty($_FILES['upfile']['tmp_name'])) {
        echo '<h3>No CSV file uploaded.</h3>';
    }
    else {
        //randomString
        $rand = sha1(uniqid(mt_rand(), true));
        //echo $rand;
        $linkData = addslashes(file_get_contents($_FILES['upfile']['tmp_name']));
        //echo $linkData;
        $fileName =  $_FILES["upfile"]["name"];
        //echo $fileName;
-
        $fastaData;
        if ($_FILES['upfasta']['tmp_name']) {
            $fastaData = addslashes(file_get_contents($_FILES['upfasta']['tmp_name']));
        }
        //echo $fastaData;

        if ($_FILES['upannot']['tmp_name']) {
            $annotData = addslashes(file_get_contents($_FILES['upannot']['tmp_name']));
        }
        //echo $annotData;

        $dbconn = mysql_connect($server,$user,$password) or die('Could not connect: ' . mysql_error());
        mysql_select_db($db, $dbconn) or die("Could not select database.");
        $query = "INSERT INTO upload (rand, links, fileName, fasta, annot) "
                . "VALUES ('".$rand."','".$linkData."','".$fileName."','".$fastaData."','".$annotData."');";
        //echo $query;
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
        // Free resultset
        //mysql_free_result();
        // Closing connection
        mysql_close($dbconn);
        //redirect to page with unique url
        header('Location: ./uploaded.php?uid='.$rand);
    }
?>
