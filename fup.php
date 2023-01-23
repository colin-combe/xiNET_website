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

    $fastaData = null;
    if ($_FILES['upfasta']['tmp_name']) {
        $fastaData = addslashes(file_get_contents($_FILES['upfasta']['tmp_name']));
    }
    //echo $fastaData;
    $annotData = null;
    if ($_FILES['upannot']['tmp_name']) {
        $annotData = addslashes(file_get_contents($_FILES['upannot']['tmp_name']));
    }
    //~ echo $annotData;

    $ip = $_SERVER['REMOTE_ADDR'];
    $country = trim(file_get_contents("http://ipinfo.io/{$ip}/country"));

    $conn = mysqli_connect($server, $user, $password, $db);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "INSERT INTO upload (rand, links, fileName, fasta, annot, ip, country) VALUES(?, ?, ?, ?, ?, ?, ?)";
    $insertStatement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($insertStatement, "sssssss", $rand, $linkData, $fileName, $fastaData, $annotData, $ip, $country);

    if (mysqli_stmt_execute($insertStatement)) {
        //redirect to page with unique url
        header('Location: ./uploaded.php?uid=' . $rand);
    }
    mysqli_close($conn);

    function check_file($file){
        if (!empty($_FILES[$file]['tmp_name'])) {

            $blacklist = array(".php", ".html", ".shtml", ".phtml", ".php3", ".php4");
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
                '<', 'eval(', '?php');

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
