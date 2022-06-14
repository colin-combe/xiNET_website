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
        exit;
    }

    check_file('upfile');
    check_file('upfasta');
    check_file('upannot');

    //randomString
    $rand = sha1(uniqid(mt_rand(), true));
    //echo $rand;
    $linkData = addslashes(file_get_contents($_FILES['upfile']['tmp_name']));
    //echo $linkData;
    $fileName =  $_FILES["upfile"]["name"];
    //echo $fileName;

    if ($_FILES['upfasta']['tmp_name']) {
        $fastaData = addslashes(file_get_contents($_FILES['upfasta']['tmp_name']));
    }
    //echo $fastaData;

    if ($_FILES['upannot']['tmp_name']) {
        $annotData = addslashes(file_get_contents($_FILES['upannot']['tmp_name']));
    }
    //~ echo $annotData;



    $ip = $_SERVER['REMOTE_ADDR'];
    $country = trim(file_get_contents("http://ipinfo.io/{$ip}/country"));

    $dbconn = mysqli_connect($server, $user, $password) or die('Could not connect: ' . mysqli_error($dbconn));
    mysqli_select_db($dbconn, $db) or die("Could not select database.");
    $query = "INSERT INTO upload (rand, links, fileName, fasta, annot, ip, country) "
        . "VALUES ('" . $rand . "','" . $linkData . "','" . $fileName . "','" . $fastaData . "','" . $annotData . "','" . $ip . "','" . $country . "');";
    //echo $query;
    $result = mysqli_query($dbconn, $query) or die('Query failed: ' . mysqli_error($dbconn));
    // Free resultset
    //mysql_free_result();
    // Closing connection
    mysqli_close($dbconn);
    //redirect to page with unique url
    header('Location: ./uploaded.php?uid=' . $rand);

    function check_file($file){
        if (!empty($_FILES[$file]['tmp_name'])) {

            $blacklist = array(".php", "html", "shtml", ".phtml", ".php3", ".php4");
            foreach ($blacklist as $item) {
                if (preg_match("/$item$/i", $_FILES[$file]['name'])) {
                    dodgy_file_exit();
                }
            }

            // files are suspicious if they contain any of these strings
            $suspicious_strings = array(
                'c99shell',
                'h4x0r', '/etc/passwd',
                'uname -a', 'eval(base64_decode(',
                '(0xf7001E)?0x8b:(0xaE17A)',
                'd06f46103183ce08bbef999d3dcc426a',
                'rss_f541b3abd05e7962fcab37737f40fad8',
                'r57shell',
                'Locus7s',
                'milw0rm.com',
                '$IIIIIIIIIIIl',
                'SubhashDasyam.com',
                '31337', '<', 'eval(', '?php');

            $file_content = file_get_contents($_FILES[$file]['tmp_name']);
            foreach ($suspicious_strings as $item) {
//                echo strtolower($item)."\n";
//                echo strpos(strtolower($file_content), strtolower($item))."\n";
                if (strpos(strtolower($file_content), strtolower($item)) !== false) {
                    dodgy_file_exit();
                }
            }
        }
    }

    function dodgy_file_exit(){
        echo "<h3>Incorrect file format, contact us for help.</h3>";
        exit;
    }

?>
