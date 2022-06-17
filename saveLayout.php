<?php
    //your connection string here
    // $connectionString = "host= dbname= user= password=";
    include('./connection.php');
    $id = $_POST["id"];
    $layout = $_POST["layout"];

    // data is suspicious if it contains any of these strings
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

    foreach ($suspicious_strings as $item) {
        if (strpos(strtolower($layout), strtolower($item)) !== false) {
            exit;
        }
    }

    $conn = mysqli_connect($server, $user, $password, $db);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "UPDATE upload SET layout = ? WHERE rand = ?;";
    $updateStatement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($updateStatement, "ss", $layout, $id);

    if (mysqli_stmt_execute($updateStatement)) {
        echo 'Layout saved';
    }
    mysqli_close($conn);

?>
