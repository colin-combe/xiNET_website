<!DOCTYPE HTML>
<html lang="en">
	<head>
		<?php
		$pageName = "Home";
		include("head.php");
		?>
		<?php include("xiNET_scripts.php");?>
	</head>

	<body>
   	 	<!-- Sidebar -->
   	 	<?php include("navigation.php");?>

   	 	<!-- Main -->
   	 	<div id="main">
	
   	 	<!-- Intro -->			
   	 				<div class="container">
   	 					<h1 class="page-header">A tool for exploring and communicating cross‑linking / mass spectrometry data.</h1>
   	 					<div class="external-link">
							
							
							
							<p>xiNET displays:</p>
							<ul>
								<li>residue
							resolution positional information including linkage sites
							and linked peptides;</li>
								<li>all types of cross-linking reaction
							product;</li>
								<li>ambiguous results;</li>
								<li>additional sequence information such as domains.</li>
							</ul>


						</div><!-- external-link -->
							
						<div class="controlsexamplespage">						
						<p style="text-align:center;font-size:small;">
							<a target="_blank" href="https://www.ncbi.nlm.nih.gov/pubmed/25648531">
							Combe, C. W., Fischer, L. &amp; Rappsilber, J. xiNET: Cross-link Network Maps With Residue Resolution. <i>Mol Cell Proteomics</i> <b>14,</b> 1137–1147 (2015).
							</a>
						</p>
					</div>
			 			
			 	</div> <!-- CONTAINER -->
			<div id="networkFrontPage" class="skel-panels-fixed"></div>
		</div> <!-- MAIN -->
   	 				<script>//<![CDATA[
					window.addEventListener('load', function() {
   	 				
						var targetDiv = document.getElementById('networkFrontPage');
						xlv = new xiNET.Controller(targetDiv);
						
						d3.text("./data/TFIIF_annot.csv", "text/csv", function(annot) {
							d3.text("./data/TFIIF_highConf.csv", "text/csv", function(text) {
								xlv.readCSV(text, null, annot);
								function makeABarP1(){
									xlv.proteins.values()[1].setForm(1);
								}
								function makeABarP2(){
									xlv.proteins.values()[2].setForm(1);
								}
								setTimeout(makeABarP1, 4000);
								setTimeout(makeABarP2, 6000);
							});
						});
								
   	 				
   	 				}, false);
   	 				//]]>
   	 				</script>

   	 				
   	 				
	</body>
</html>
