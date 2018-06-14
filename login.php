<!DOCTYPE HTML>
<html>
    <head>
        <?php
        $pageName = "Home";
        include("head.php");
        ?>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <link rel="stylesheet" href="../vendor/css/example.wink.css" />
        <link rel="stylesheet" href="../vendor/css/common.css" />
        <link rel="stylesheet" href="../userGUI/css/login.css" />

        <script src="../vendor/js/jquery-3.2.1.min.js"></script>
        <script src="../vendor/js/hideShowPassword.js"></script>
        <script src="../vendor/js/spin.js"></script>
        <script src="../userGUI/js/forms.js"></script>
    </head>

    <body>
    <!-- Sidebar -->
    <?php include("navigation.php");?>

    <!-- Main -->
    <div id="main">
        <div class="container">
            <h1 class="page-header">Multiple Coordinated Views of Cross-Linking / Mass Spectrometry Data.</h1>
            <!-- xiView is a visualisation tool for the downstream analysis of cross-linking / mass spectrometry results. It provides multiple, linked views of the data, including: -->

            <?php include("../userGUI/userLoginInnerDiv.php");?>

        </div> <!-- CONTAINER -->
    </div> <!-- MAIN -->

    </body>
</html>
