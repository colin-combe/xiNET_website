<div id="header" class="skel-panels-fixed">
    <div class="header-bg">
        <div class="top">
            <div class="logogroup">
                <a style="text-decoration:none;" href="index.php"><h1 class="logo">xiVIEW</h1></a>
                <!-- <h4 class="logo-subtitle">Multiple Coordinated Views of Cross-Linking / Mass Spectrometry Data.</h4> -->
            </div>
            <nav class="hover-effect">
                <a href="index.php" data-hover="Home" data-no-instant>Home</a><br/>
                <a href="demo.php" data-hover="Demo" data-no-instant>Demo</a><br/>
                <a href="dataFormats.php" data-hover="Data Formats">Data Formats</a><br/>
                <a href="privacy.php" data-hover="Privacy Statement">Privacy</a><br/>
                <a href="contact.php" data-hover="Contact">Contact</a><br/>
                <?php
                    session_start();
                    if (!isset($_SESSION['session_name'])) {
                        echo '<a href="createAccount.php" data-hover="Create Account" data-no-instant>Create Account</a><br/>';
                        echo '<a href="login.php" data-hover="Sign in">Sign in</a><br/>';
                    } else {
                        echo '<a href="upload.php" data-hover="Upload new data set">Upload</a><br/>';
                        echo '<a href="../history/history.html" data-hover="Back to data set list" data-no-instant>My Data</a><br/>';
                        echo '<a href="../userGUI/php/logout.php" data-hover="Sign out">Sign Out</a><br/>';
                    }
                ?>
            </nav>
        </div>
        <div class="bottom">
            <a href="http://rappsilberlab.org/" target="_blank">
                <img alt="Find out more about us." id="rapplablogo" class="image" src="./images/logos/rappsilber-lab-small.png"/>
            </a>
            <a href="http://www.wellcome.ac.uk/" target="_blank">
                <img alt="Visit the Wellcome Trust website." id="wellcometrustlogo" class="image" src="./images/logos/wellcome-trust-small.png"/>
            </a>
        </div> <!-- BOTTOM -->
    </div> <!-- headerbg -->
</div> <!-- header -->

<!-- <script type="text/javascript">
    $( document ).ready(function() {
    $('.menu').click(function(){
    $('.header-top').slideToggle();
    });
    });
</script>

<div class="menu"></div>

<div class="menu-top">
    <div class="header-top">
    <div class="header-top-bg">
    <nav class="hover-effect">
    <a href="index.php" data-hover="Home" data-no-instant>Home</a>
    <a href="examples.php" data-hover="Examples" data-no-instant>Examples</a>
    <a href="upload.php" data-hover="Upload">Upload</a>
    <a href="help.php" data-hover="Help">Help</a>
    <a href="contact.php" data-hover="Contact">Contact</a>
    <a href="legacy.php" data-hover="Legacy">Legacy</a>
    </nav>
    </div>
    </div>
</div> -->
