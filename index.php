<!DOCTYPE HTML>
<html>
	<head>
		<?php
		$pageName = "Home";
		include("head.php");
		include("xiSPEC_scripts.php");
		?>
	<script type="text/javascript">

	$( document ).ready(function() {

		var slideIndex = 0;
		function showDiv(n) {
			oldSlide = slideIndex;

			if(slideIndex+n >= $('.sliderImg').length)
				slideIndex = 0;
			else if(slideIndex+n < 0)
				slideIndex = $('.sliderImg').length - 1;
			else
				slideIndex += n;
			$('.sliderImg').eq(oldSlide).fadeOut(300, function(){ $('.sliderImg').eq(slideIndex).fadeIn(300); });
			$('#sliderInfo').text($('.sliderImg').eq(slideIndex).attr('alt'));
		}

		var myTimer = setInterval(function () {showDiv(1)}, 4000);

		$('.sliderImg').click(function(){
			clearInterval(myTimer);
		})

		$('.slider-left').click(function(){
			showDiv(-1);
			clearInterval(myTimer);
			// myTimer = setInterval(function () {showDiv(slideIndex+1)}, 4000);
		})

		$('.slider-right').click(function(){
			showDiv(1);
			clearInterval(myTimer);
			// myTimer = setInterval(function () {showDiv(slideIndex+1)}, 4000);
		})

	});

	</script>
	</head>

	<body>
		<!-- Sidebar -->
		<?php include("navigation.php");?>
		<!-- Main -->
		<div id="main">
			<div class="container">
				<h1 class="page-header">Multiple Coordinated Views of Cross-Linking / Mass Spectrometry Data.</h1>
				xiView is a visualisation tool for the downstream analysis of cross-linking / mass spectrometry results. It provides multiple, linked views of the data, including:
				<ul>
					<li>2D network (xiNET or circular)</li>
					<li>the supporting annotated spectra (xiSPEC)</li>
					<li>3D structure view (NGL).</li>
			 </ul>
				<p>xiView is an open source project on <a href="https://github.com/Rappsilber-Laboratory/xiView" >GitHub</a>. Report issues and request features <a href="https://github.com/Rappsilber-Laboratory/xiView/issues">here</a>.</p>
				<p>
									</p>
				<div style="text-align: center;">
					<div class="sliderWrapper">
					<img class="sliderImg" alt="Automatic mapping of links onto 3D structures" src="images/slider/xiView_3d.png">
					<img class="sliderImg" alt="Measure distances between peaks" src="images/slider/measuringTool.png" style="display:none;">
					<img class="sliderImg" alt="Change spectrum annotation parameters" src="images/slider/settingsView.png" style="display:none;">
					<img class="sliderImg" alt="Zoom into spectra" src="images/slider/zoom.png" style="display:none;">
					<!-- <img class="sliderImg" alt="highlight spectrum" src="images/slider/5.png" style="display:none;"> -->
					<button class="sliderBtn slider-left">&#10094;</button>
					<button class="sliderBtn slider-right">&#10095;</button>
					<div id="sliderInfo">Interactive highlighting between all views</div>
					</div>
				</div>
			</div> <!-- CONTAINER -->
		</div> <!-- MAIN -->

	</body>
</html>
