<!DOCTYPE HTML>
<html>

    <head>
        <?php
        $pageName = "Sign In";
        include("head.php");
        ?>

            <link rel="stylesheet" href="../vendor/css/example.wink.css" />
            <link rel="stylesheet" href="../vendor/css/common.css" />
            <link rel="stylesheet" href="../userGUI/css/login.css" />

            <script src="../vendor/js/jquery-3.4.1.js"></script>
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


                <?php include("../userGUI/userLoginInnerDiv.php");?>
                <div class="newUserSection">
                    <hr class="wideDivider">
                    <h3>Citation:</h3>
                    <a target="_blank" href="http://biorxiv.org/cgi/content/short/561829v1">
                        Graham, M., Combe, C. W., Kolbowski, L. &amp; Rappsilber, J. xiView: A common platform for the downstream analysis of
                        Crosslinking Mass Spectrometry data. <i>doi: 10.1101/561829 </i>.
                    </a>
                </div>
            </div>
            <!-- CONTAINER -->
        </div>
        <!-- MAIN -->

    </body>

</html>
