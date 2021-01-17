<!DOCTYPE HTML>
<html>

    <head>
        <?php
        $pageName = "Create Account";
        include("head.php");
        ?>

            <link rel="stylesheet" href="../vendor/css/example.wink.css" />
            <link rel="stylesheet" href="../vendor/css/common.css" />
            <link rel="stylesheet" href="../userGUI/css/login.css" />

            <script src="../vendor/js/jquery-3.4.1.js"></script>
            <script type="text/javascript" src="./vendor/jquery.easyModal.js"></script>
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
                <h1 class="page-header"><?php echo($pageName); ?></h1>

                <p><b>Maintenance News: </b> xiVIEW is not accepting new uploads for the week 18th to 25th January 2021. We are migrating to a new server, you will still be able to view uploaded data for most of the week.</p>
                <br/>

                <p><a href="https://player.vimeo.com/video/298348200" target="_blank">Account creation video tutorial</a></p>

                <?php include("../userGUI/userRegInnerDiv.php");?>

            </div>
            <!-- CONTAINER -->
        </div>
        <!-- MAIN -->

    </body>

</html>
