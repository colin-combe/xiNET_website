<!DOCTYPE HTML>
<html>

    <head>
        <?php
    $pageName = "Home";
    include("head.php");
    ?>


    </head>
    <script type="text/javascript">
        // $( document ).ready(function() {
        //
        // 	var slideIndex = 0;
        // 	function showDiv(n) {
        // 		oldSlide = slideIndex;
        //
        // 		if(slideIndex+n >= $('.sliderImg').length)
        // 			slideIndex = 0;
        // 		else if(slideIndex+n < 0)
        // 			slideIndex = $('.sliderImg').length - 1;
        // 		else
        // 			slideIndex += n;
        // 		$('.sliderImg').eq(oldSlide).fadeOut(300, function(){ $('.sliderImg').eq(slideIndex).fadeIn(300); });
        // 		$('#sliderInfo').text($('.sliderImg').eq(slideIndex).attr('alt'));
        // 	}
        //
        // 	var myTimer = setInterval(function () {showDiv(1)}, 4000);
        //
        // 	$('.sliderImg').click(function(){
        // 		clearInterval(myTimer);
        // 	})
        //
        // 	$('.slider-left').click(function(){
        // 		showDiv(-1);
        // 		clearInterval(myTimer);
        // 		// myTimer = setInterval(function () {showDiv(slideIndex+1)}, 4000);
        // 	})
        //
        // 	$('.slider-right').click(function(){
        // 		showDiv(1);
        // 		clearInterval(myTimer);
        // 		// myTimer = setInterval(function () {showDiv(slideIndex+1)}, 4000);
        // 	})
        //
        // });

    </script>

    <body>
        <!-- Sidebar -->
        <?php include("navigation.php");?>
        <!-- Main -->
        <div id="main">
            <div class="container">
                <h1 class="page-header"><?php echo($pageName); ?></h1>
                <p>xiView is a web-based visualisation tool for the analysis of cross-linking
                    / mass spectrometry results, it is independent of the search software
                    used. It provides multiple, linked views of the data, including:</p>
                <ul>
                    <li>2D network (<a href="http://crosslinkviewer.org" target="_blank">xiNET</a>                        or circular)</li>
                    <li>the supporting annotated spectra using <a href="http://spectrumviewer.org"
                            target="_blank">xiSPEC</a>.</li>
                    <li>3D structure view using <a href="http://nglviewer.org/ngl" target="_blank">NGL</a>.</li>
                </ul>
                <div>
                    <hr class="wideDivider">
                    <p>The <a href="http://rappsilberlab.org/rappsilber-laboratory-home-page/tools/xiview/xiview-videos/"
                            target="_blank">video tutorials</a> give an overview of xiView's
                        many features.</p>
                </div>
                <div>
                    <hr class="wideDivider">
                    <p>xiView is an open source project on
                        <a href="https://github.com/Rappsilber-Laboratory/xiView_container" target="_blank">GitHub</a>.
                        Report issues and request features
                        <a href="https://github.com/Rappsilber-Laboratory/xiView_container/issues" target="_blank">here</a>.
                    </p>
                </div>
                <div>
                    <hr class="wideDivider"> When using XiView please cite:
                    <a target="_blank" href="http://biorxiv.org/cgi/content/short/561829v1">
                Graham, M., Combe, C. W., Kolbowski, L. &amp; Rappsilber, J. xiView: A common platform for the downstream analysis of
    Crosslinking Mass Spectrometry data. <i>doi: 10.1101/561829 </i>.
                </a>
                </div>
                <div>
                    <div class="login">
                        <div class="newUserSection" style="display:block;">
                            <hr class="wideDivider">
                            <h3>New User?</h3>
                            <form id="new_user_form" name="new_user_form" action="./createAccount.php">
                                <input name="Submit" value="Create New Account" type="submit" class="btn btn-1a" />
                            </form>
                        </div>
                    </div>
                    <br/>
                    <div>
                        <img style="display:block;margin:auto;" class="sliderImg" alt="Automatic mapping of links onto 3D structures"
                            src="images/midScreenshot.png">
                    </div>
                    <!-- <div style="text-align: center;">
    <div class="sliderWrapper">
    <img class="sliderImg" alt="Measure distances between peaks" src="images/slider/measuringTool.png" style="display:none;">
    <img class="sliderImg" alt="Change spectrum annotation parameters" src="images/slider/settingsView.png" style="display:none;">
    <img class="sliderImg" alt="Zoom into spectra" src="images/slider/zoom.png" style="display:none;">
    <button class="sliderBtn slider-left">&#10094;</button>
    <button class="sliderBtn slider-right">&#10095;</button>
    <div id="sliderInfo">Interactive highlighting between all views</div>
    </div> -->
                </div>

            </div>
            <!-- CONTAINER -->
        </div>
        <!-- MAIN -->

    </body>

</html>
