<?php

session_start();

$dir = 'sqlite:/var/www/html/xiSPEC/dbs/'.session_id().'.db';
$dbh = new PDO($dir) or die("cannot open the database");
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query =  "SELECT * FROM jsonReqs WHERE id=".$_GET['i']." LIMIT 1";
foreach ($dbh->query($query) as $row)
{
    $postJSON = $row['json'];
}

print $postJSON;

?>