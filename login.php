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
            <h1 class="page-header"><?php echo($pageName); ?></h1>
            <?php include("../userGUI/userLoginInnerDiv.php");?>
        </div> <!-- CONTAINER -->
    </div> <!-- MAIN -->

    </body>
</html>
