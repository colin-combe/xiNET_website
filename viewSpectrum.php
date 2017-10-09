<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("functions.php");

if(isset($_GET['db']))
	require("php/logAccess.php");


if (empty($_POST)){
	$dbView = TRUE;
}
else{
	$dbView = FALSE;
	$mods = [];
	if(isset($_POST['mods'])){
	    $mods = $_POST['mods'];
	    $modMasses = $_POST['modMasses'];
	    $modSpecificities = $_POST['modSpecificities'];
	}

	$pepsStr = $_POST["peps"];
	$clModMass = floatval($_POST['clModMass']);
	$ms2Tol = floatval($_POST['ms2Tol']);
	$tolUnit = $_POST['tolUnit'];
	$peaklist = $_POST['peaklist'];

	//$method = $_POST['fragMethod'];
	$preCharge = intval($_POST['preCharge']);

	$peaklist = explode("\r\n", $peaklist);

	//peptides linksites block
	$peps = explode(";", $pepsStr);
	$linkSites = array();
	$peptides = array();

	$i = 0;
	foreach ($peps as $pep) {
	    array_push($peptides, pep_to_array($pep));
	    $linkSites = array_merge($linkSites, get_link_sites($pep, $i));
	    $i++;
	}


	//peak block
	$peaks = array();
	foreach ($peaklist as $peak) {
	    $peak = trim($peak);
	    if ($peak != ""){
	        $parts = preg_split('/\s+/', $peak);
	        if(count($parts) > 1)
	            array_push($peaks, array('mz' => floatval($parts[0]), 'intensity' => floatval($parts[1])));
	    }
	}

	//annotation block
	$tol = array("tolerance" => $ms2Tol, "unit" => $tolUnit);
	$modifications = array();
	$i = 0;
	//var_dump(str_split($modSpecificities[$i]))
	//var_dump(implode(",", str_split($modSpecificities[$i]));
	//die();
	foreach ($mods as $mod) {
	    array_push($modifications, array('aminoAcids' => str_split($modSpecificities[$i]), 'id' => $mod, 'mass' => $modMasses[$i]));
	    $i++;
	}

	$ions = array();
	foreach ($_POST['ions'] as $iontype) {
		$iontype = ucfirst($iontype)."Ion";
		array_push($ions, array('type' => $iontype));
	}

	// array_push($ions, array('type' => 'PeptideIon'));
	// if ($method == "HCD" or $method == "CID") {
	//     array_push($ions, array('type' => 'BIon'));
	//     array_push($ions, array('type' => 'YIon')); 
	// };
	// if ($method == "EThcD" or $method == "ETciD") {
	//     array_push($ions, array('type' => 'BIon'));
	//     array_push($ions, array('type' => 'CIon'));
	//     array_push($ions, array('type' => 'YIon'));
	//     array_push($ions, array('type' => 'ZIon'));     
	// };
	// if ($method == "ETD") {
	//     array_push($ions, array('type' => 'CIon'));
	//     array_push($ions, array('type' => 'ZIon')); 
	// };

	$cl = array('modMass' => $clModMass);

	$annotation = array('fragmentTolerance' => $tol, 'modifications' => $modifications, 'ions' => $ions, 'cross-linker' => $cl, 'precursorCharge' => $preCharge, 'custom' => "LOWRESOLUTION:false"); //ToDo: LOWRESOLUTION: true setting

	//final array
	$postData = array('Peptides' => $peptides, 'LinkSite' => $linkSites, 'peaks' => $peaks, 'annotation' => $annotation);

	$postJSON = json_encode($postData);
	//var_dump(json_encode($postData));
	//die();


	// The data to send to the API
	$url = 'http://xi3.bio.ed.ac.uk/xiAnnotator/annotate/FULL';
	// Setup cURL
	$ch = curl_init($url);
	curl_setopt_array($ch, array(
	    CURLOPT_POST => TRUE,
	    CURLOPT_RETURNTRANSFER => TRUE,
	    CURLOPT_HTTPHEADER => array(
	        'Content-Type: application/json'
	    ),
	    CURLOPT_POSTFIELDS => $postJSON
	));


	// Send the request
	$response = curl_exec($ch);

	// Check for errors
	if($response === FALSE){
	    die(curl_error($ch));
	}
	$errorQuery = "java.lang.NullPointerException";
	if ($response === "" || substr($response, 0, strlen(($errorQuery))) === $errorQuery){
	    var_dump($response);

	    echo ("<p>xiAnnotator experienced a problem. Please try again later!</p><br/>");
	    var_dump($postJSON);
	    die();
	}
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>xiSPEC</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="common platform for downstream analysis of CLMS data" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="icon" type="image/ico" href="images/logos/favicon.ico">
		<link rel="stylesheet" href="./css/style.css" />
        <link rel="stylesheet" href="./css/style2.css" />
        <link rel="stylesheet" href="./css/tooltip.css">
        <link rel="stylesheet" href="./css/spectrumViewWrapper.css">
        <link rel="stylesheet" href="./css/validationPage.css">
        <link rel="stylesheet" href="./css/dropdown.css">
		<?php include("xiSPEC_scripts.php");?>

        <script type="text/javascript" src="./vendor/jscolor.min.js"></script>
        <script type="text/javascript" src="./vendor/c3.js"></script>
        <script type="text/javascript" src="./vendor/split.js"></script>
        <script type="text/javascript" src="./vendor/svgexp.js"></script>
        <script type="text/javascript" src="./vendor/spin.js"></script>
        <script type="text/javascript" src="./vendor/byrei-dyndiv_1.0rc1.js"></script>
        <script type="text/javascript" src="./vendor/download.js"></script>

        <!-- Spectrum view .js files -->
        <script type="text/javascript" src="./src/model.js"></script>
        <script type="text/javascript" src="./src/SpectrumView2.js"></script>
        <script type="text/javascript" src="./src/FragmentationKeyView.js"></script>
        <script type="text/javascript" src="./src/PrecursorInfoView.js"></script>
		<script type="text/javascript" src="./js/PeptideView.js"></script>
		<script type="text/javascript" src="./js/PepInputView.js"></script>	
        <script type="text/javascript" src="./src/ErrorIntensityPlotView.js"></script>     
        <script type="text/javascript" src="./src/FragKey/KeyFragment.js"></script>
        <script type="text/javascript" src="./src/graph/Graph.js"></script>
        <script type="text/javascript" src="./src/graph/Peak.js"></script>
        <script type="text/javascript" src="./src/graph/Fragment.js"></script>
        <script type="text/javascript" src="./js/modTable.js"></script>
<?php if($dbView)
echo 	'<script type="text/javascript" src="./js/specListTable.js"></script>
		<script type="text/javascript" src="./js/altListTable.js"></script>';
?>  
        <script>

    SpectrumModel = new AnnotatedSpectrumModel();
    SettingsSpectrumModel = new AnnotatedSpectrumModel();

    $(function() {

		<?php 
			if($dbView){
				echo 'window.dbView = true;';
			}
			else{
				echo 'window.dbView = false;';
	        	echo 'var json_data = '.$response.';';
        		echo 'var json_req = '.$postJSON.';';
			} 
		?>

		if(dbView){
			window.SpectrumModel.requestId = "0";
			$('#bottomDiv').show();
			window.initSpinner = new Spinner({scale: 5}).spin (d3.select("#topDiv").node());
		}
		else{
        	console.log(json_req);
        	$("#topDiv-overlay").css("z-index", -1);
			$('#dbControls').hide();
			$('#bottomDiv').hide();
			$('#altDiv').hide();		
		}


        _.extend(window, Backbone.Events);
        window.onresize = function() { window.trigger('resize') };

        window.Spectrum = new SpectrumView({model: SpectrumModel, el:"#spectrumPanel"});
        window.FragmentationKey = new FragmentationKeyView({model: SpectrumModel, el:"#spectrumPanel"});
        window.InfoView = new PrecursorInfoView ({model: SpectrumModel, el:"#spectrumPanel"});
        window.ErrorIntensityPlot = new ErrorIntensityPlotView({model: SpectrumModel, el:"#spectrumPanel"});
		window.SettingsPepInputView = new PepInputView({model: SettingsSpectrumModel, el:"#settingsPeptide"});

		if(!dbView){
			SpectrumModel.set({JSONdata: json_data, JSONrequest: json_req});
			var json_data_copy = jQuery.extend({}, json_data);
			SpectrumModel.settingsModel = SettingsSpectrumModel;
			SettingsSpectrumModel.set({JSONdata: json_data_copy, JSONrequest: json_req});
			render_settings();
		}
		

		//settings panel - put into model? or extra view?


		$('.settingsCancel').click(function(){
			$('#settingsWrapper').hide();
			document.getElementById('highlightColor').jscolor.hide();
			var json_data_copy = jQuery.extend({}, window.SpectrumModel.JSONdata);
			SettingsSpectrumModel.set({JSONdata: json_data_copy});
			SettingsSpectrumModel.trigger("change:JSONdata");
			render_settings();
		});

		$('#toggleSettings').click(function(){
			$('#settingsWrapper').toggle();
		});

		$('.closeTable').click(function(){
			$(this).closest('.tableDiv').hide();
			window.Spectrum.resize();
		});

		$('#toggleSpecList').click(function(){
			$('#bottomDiv').toggle();
			window.Spectrum.resize();
		});

		$('#toggleAltList').click(function(){
			$('#altDiv').toggle();
			window.Spectrum.resize();
		});

		$('#setrange').submit(function (e){
			e.preventDefault();
		});

		$('#settingsForm').submit(function(e) {
			e.preventDefault();
			var formData = new FormData($(this)[0]);
			$('#settingsForm').hide();
			var spinner = new Spinner({scale: 5}).spin (d3.select("#settings_main").node());

			$.ajax({
		        url: "php/formToJson.php",
				type: 'POST',
				data: formData,
				async: false,
				cache: false,
				contentType: false,
				processData: false,
				success: function (data) {
					window.SpectrumModel.request_annotation(JSON.parse(data));
					spinner.stop();
					$('#settingsForm').show();
				}
			  });	 
			  return false;	

			//window.SpectrumModel.request_annotation(window.SettingsSpectrumModel.JSONdata);			
		});

		$("#settingsCustomCfgApply").click(function(){
			var json = window.SpectrumModel.get("JSONrequest");
			//ToDo: LOWRESOLUTION: true setting
			json['annotation']['custom'] = "LOWRESOLUTION:false\n";
			json['annotation']['custom'] += $("#settingsCustomCfg-input").val().split("\n");

		 	window.SpectrumModel.request_annotation(json);
		 });

		$('#settings-appearance').click(function(){
			$('.settings-tab').hide();
			$('#settingsAppearance').show();
		});

		$('#settings-custom_cfg').click(function(){
			$('.settings-tab').hide();
			$('#settingsCustomCfg').show();
		});		

		$('#settingsDecimals').change(function(){
			window.SpectrumModel.showDecimals = $(this).val();
		})

		$('#settings-data').click(function(){
			$('.settings-tab').hide();		
			$('#settingsData').show();
		});

		$('.mutliSelect input[type="checkbox"]').on('click', function() {

		    var ionSelectionArr = new Array();
			$('.ionSelectChkbox:checkbox:checked').each(function(){
			    ionSelectionArr.push($(this).val());
			});

			$('#ionSelection').val(ionSelectionArr.join(", "));

		});

		$("#saveModal").easyModal();

		$('#saveDB').click(function(){
			$("#saveModal").trigger('openModal');
		});

		$('#saveDataSet').click(function(){
			$.ajax({
				type: "GET",
				datatype: "json",
				async: false,
				url: "php/saveDataSet.php?name="+$('#saveDbName').val(),
				success: function(response) {
					response = JSON.parse(response);
					if (response.hasOwnProperty('error'))
						$('#saveDBerror').html(response.error);
					else
						$('#saveModal_content').html("<p>Dataset was successfully saved!</p><p>URL for access: <input type='text' value='"+response.url+"' readonly style='width: 70%; font-size: 1em; color: #000;' onClick='this.select();'></p>");
					console.log(response);
				}
			});	
		});


});
function render_settings(){
	window.SettingsPepInputView.render();

	//ions
	SpectrumModel.JSONdata.annotation.ions.forEach(function(ion){
		$('#'+ion.type).attr('checked', true);
	});
	var ionSelectionArr = new Array();
	$('.ionSelectChkbox:checkbox:checked').each(function(){
	    ionSelectionArr.push($(this).val());
	});
	$('#ionSelection').val(ionSelectionArr.join(", "));

	$("#settingsPeaklist").val(window.SettingsSpectrumModel.peaksToMGF()); 
	$("#settingsPrecursorZ").val(window.SettingsSpectrumModel.JSONdata.annotation.precursorCharge);
	$("#settingsTolerance").val(parseInt(window.SettingsSpectrumModel.JSONdata.annotation.fragementTolerance));
	$("#settingsToleranceUnit").val(window.SettingsSpectrumModel.JSONdata.annotation.fragementTolerance.split(" ")[1]);
	$("#settingsCL").val(window.SettingsSpectrumModel.JSONdata.annotation['cross-linker'].modMass);
	$('#settingsDecimals').val(window.SpectrumModel.showDecimals);
}

function loadSpectrum(rowdata){

	var id = rowdata['id'];
	var mzid = rowdata['mzid'];

	if(rowdata['alt_count'] > 1){
		$('#altDiv').show();
		$('#toggleAltList').prop('disabled', false);
		$('#toggleAltList').prop('title', "Show/Hide alternative explanation list");
		$('#toggleAltList').css('cursor', "pointer");
		$('#toggleAltList').addClass("btn-1a");
		window.altListTable.ajax.url( "php/getAltList.php?id=" + mzid).load();
	}
	else{
		$('#toggleAltList').prop('disabled', true);
		$('#toggleAltList').prop('title', "No alternative explanations for this spectrum");
		$('#toggleAltList').css('cursor', "not-allowed");
		$('#toggleAltList').removeClass("btn-1a");
		$('#altDiv').hide();
	}

	$.ajax({
		url: 'php/getSpectrum.php?i='+id,
		type: 'GET',
		async: false,
		cache: false,
		contentType: false,
		processData: false,
		success: function (returndata) {
			var json = JSON.parse(returndata);
			window.SpectrumModel.requestId = id;
			window.SpectrumModel.mzid = mzid;
			//console.log(window.SpectrumModel.requestId);
			window.SpectrumModel.request_annotation(json);
			var json_data_copy = jQuery.extend({}, window.SpectrumModel.JSONdata);
			var json_req = window.SpectrumModel.get('JSONrequest');
			window.SpectrumModel.settingsModel = SettingsSpectrumModel;
			window.SettingsSpectrumModel.set({JSONdata: json_data_copy, JSONrequest: json_req});
			render_settings();
		}
	});	 			
};

function updateJScolor(jscolor) {
	window.SpectrumModel.changeHighlightColor('#' + jscolor);
};
    </script>
    </head>

    <body>
        <!-- Main -->
        <div id="mainView">
			
            <div class="mainContent">
           
            	 <div id="topDiv"><!--style="height: calc(60% - 5px);">-->
            	 <div class="overlay" id="topDiv-overlay"></div>
	                <div id="spectrumPanel">

						<div class="dynDiv" id="settingsWrapper">
							<div class="dynDiv_moveParentDiv" style="cursor: move;">
								<span class="dynTitle">Settings</span>
								<i class="fa fa-times-circle closeButton settingsCancel" id="closeSettings"></i>
							</div>
							<div class="settings_menu">
								<button class="btn btn-1a" id="settings-data">Data</button>
								<button class="btn btn-1a" id="settings-appearance">Appearance</button>
								<button class="btn btn-1a" id="settings-custom_cfg">Custom config</button>
							</div>
							<div class="dynDiv_resizeDiv_tl" style="cursor: nw-resize;"></div>
							<div class="dynDiv_resizeDiv_tr" style="cursor: ne-resize;"></div>
							<div class="dynDiv_resizeDiv_bl" style="cursor: sw-resize;"></div>
							<div class="dynDiv_resizeDiv_br" style="cursor: se-resize;"></div>
							<div id="settings_main">
								<div class="settings-tab" id="settingsData">
									<form id="settingsForm" method="post">
										<div style="display: flex;">
										<div style="margin-bottom:30px;width:30%;min-width:300px;display:inline;min-width:300px;margin-right:2%;float:left;">
											<input style="width:100%;margin-bottom:10px" class="form-control" id="settingsPeptide" autocomplete="off" required="" type="text" placeholder="Peptide Sequence1[;Peptide Sequence2]" name="peps" autofocus="">
											<textarea class="form-control" style="padding-bottom:0px;" id="settingsPeaklist" required="" type="text" placeholder="Peak List [m/z intensity]" name="peaklist"></textarea>
										</div>
										<div style="width:68%;display:inline;">
											<label for="settingsCL"><span class="label btn">Cross-linker mod mass: </span>
												<input class="form-control" style="margin-right:2%;width:25%" required="" id="settingsCL" placeholder="CL mod mass" name="clModMass" autocomplete="off">
											</label>

											<label for="settingsPrecursorZ"><span class="label btn">Precursor charge: </span>
								  				<input class="form-control" style="margin-right:2%;width:15%" required="" id="settingsPrecursorZ" type="number" min="1" placeholder="Charge" name="preCharge" autocomplete="off">
											</label>

											<label for="settingsIons"><span class="label btn">Ions: </span>
												<div class="dropdown">
													<input type="text" class="form-control btn-drop" id="ionSelection" readonly>
													<div class="dropdown-content mutliSelect">
														<ul>
											                <li>
											                    <label><input type="checkbox" class="ionSelectChkbox" value="peptide" id="PeptideIon" name="ions[]"/>Peptide ion</label></li>
											                <li>
											                    <label><input type="checkbox" class="ionSelectChkbox" value="a" id="AIon" name="ions[]"/>A ion</label></li>
											                <li>
											                    <label><input type="checkbox" class="ionSelectChkbox" value="b" id="BIon" name="ions[]"/>B ion</label></li>
											                <li>
											                    <label><input type="checkbox" class="ionSelectChkbox" value="c" id="CIon" name="ions[]"/>C ion</label></li>
											                <li>
											                    <label><input type="checkbox" class="ionSelectChkbox" value="x" id="XIon" name="ions[]"/>X ion</label></li>
											                <li>
											                    <label><input type="checkbox" class="ionSelectChkbox" value="y" id="YIon" name="ions[]"/>Y ion</label></li>
											                <li>
											                    <label><input type="checkbox" class="ionSelectChkbox" value="z" id="ZIon" name="ions[]"/>Z ion</label></li>
														</ul>
													</div>
												</div>
											</label>
			<!-- 
											<label for="settingsFragmentation"><span class="label btn">Fragmentation method: </span>
												<select class="form-control" style="margin-right:2%;width:15%;display:inline;" id="settingsFragmentation" name="fragMethod">
													<option value="HCD">HCD</option>
													<option value="CID">CID</option>
													<option value="ETD">ETD</option>
													<option value="ETciD">ETciD</option>
													<option value="EThcD">EThcD</option>
												</select>
											</label> -->

											<label for="settingsTolerance"><span class="label btn">MS2 tolerance: </span>
												<input class="form-control" style="margin-right:2%;width:15%;display:inline;" required="" id="settingsTolerance" type="number" min="0" step="0.1" placeholder="Tolerance" name="ms2Tol" autocomplete="off">
												<select class="form-control" style="margin-right:2%;width:15%;display:inline;" required="" id="settingsToleranceUnit" name="tolUnit">
													<option value="ppm">ppm</option> 
													<option value="Da">Da</option>
												</select>									
											</label>
										</div>
										</div>
										<div style="margin-bottom:2%;">
											<div class="form-control" style="height:auto" id="myMods">
											<div id="modificationTable_wrapper" class="dataTables_wrapper no-footer"><div id="modificationTable_processing" class="dataTables_processing" style="display: none;">Processing...</div><table id="modificationTable" class="display dataTable no-footer" width="100%" style="text-align: center; width: 100%;" role="grid">
												<thead>
													<tr role="row"><th class="sorting_disabled invisible" rowspan="1" colspan="1" style="width: 0px;">Mod-Input</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 206px;">Modification</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 144px;">Mass</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 175px;">Specificity</th></tr>
												</thead>
											<tbody><tr class="odd"><td valign="top" colspan="3" class="dataTables_empty">No matching records found</td></tr></tbody></table></div>
											</div>
										</div>	
										<div style="margin-top:10px; text-align: center">
											<input class="btn btn-1 btn-1a network-control" type="submit" value="Apply" id="settingsApply">
											<input class="btn btn-1 btn-1a network-control settingsCancel" type="button" value="Cancel" id="settingsCancel">
										</div>
									</form>
								</div>
								<div id="settingsAppearance" class="settings-tab" style="display:none">
									<label class="btn label">Colour scheme:
									<select id="colorSelector">
										<option value="RdBu">Red &amp; Blue</option>
										<option value="BrBG">Brown &amp; Teal</option>
										<option value="PiYG">Pink &amp; Green</option>
										<option value="PRGn">Purple &amp; Green</option>
										<option value="PuOr">Orange &amp; Purple</option>
									</select>
									</label>
									<label class="btn label">Highlight Color:
										<input class="jscolor form-control" id="highlightColor" value="#FFFF00" onchange="updateJScolor(this.jscolor);">
									</label>
									<label class="btn label"><input id="lossyChkBx" type="checkbox">Neutral Loss Labels</label>
									<label>
										<span class="label btn">Decimals: </span>
				  						<input class="form-control" style="margin-right:2%;width:15%" id="settingsDecimals" type="number" min="1"  autocomplete="off">
									</label>		
								</div>
								<div id="settingsCustomCfg" class="settings-tab" style="display:none">
									<textarea class="form-control" style="padding-bottom:0px;width:100%;" id="settingsCustomCfg-input" type="text"></textarea>
									<input class="btn btn-1 btn-1a network-control" type="submit" value="Apply" id="settingsCustomCfgApply">
								</div>								
							</div>
						</div><!-- end settings -->
		            	<div id="spectrumControls">
		            		<i class="fa fa-home fa-xi" onclick="window.location = 'index.php';" title="Home"></i>
		            		<i class="fa fa-github fa-xi btn-1a" onclick="window.open('https://github.com/Rappsilber-Laboratory/xiSPEC/issues', '_blank');" title="GitHub issue tracker" style="cursor:pointer;"></i>
	            			<i class="fa fa-download btn-1a" aria-hidden="true" id="downloadSVG" title="download SVG" style="cursor: pointer;"></i>
							<label class="btn" title="toggle moveable labels on/off">Move Labels<input id="moveLabels" type="checkbox"></label>
		            		<button id="clearHighlights" class="btn btn-1 btn-1a">Clear Highlights</button>
		            		<label class="btn" title="toggle measure mode on/off">Measure<input id="measuringTool" type="checkbox"></label>
		            		<form id="setrange">
		            			<label class="btn" title="m/z range" style="cursor: default;">m/z:</label>
								<label class="btn" for="lockZoom" title="Lock current zoom level" id="lock" class="btn">🔓</label>
		            			<input type="text" id="xleft" size="7" title="m/z range from:">
		            			<span>-</span>
		            			<input type="text" id="xright" size="7" title="m/z range to:">
		            			<input type="submit" id="rangeSubmit" value="Set" class="btn btn-1 btn-1a" style="display: none;">            			
		            			<span id="range-error"></span>
		            			<button id="reset" title="Reset to initial zoom level" class="btn btn-1 btn-1a">Reset Zoom</button>
		            			<input id="lockZoom" type="checkbox" style="visibility: hidden;">
		            		</form>
		            		<button id="toggleView" title="Toggle between quality control/spectrum view" class="btn btn-1 btn-1a">QC</button>
		    				<button id="toggleSettings" title="Show/Hide Settings" class="btn btn-1a btn-topNav">&#9881;</button>
		    				<span id="dbControls">
		    					
		    					<?php if(!isset($_SESSION['db'])) echo '<button id="saveDB" title="Save" class="btn btn-1a btn-topNav">&#x1f4be;</button> '?>
								<button id="prevSpectrum" title="Previous Spectrum" class="btn btn-1a btn-topNav">&#x2039;</button>
								<button id="toggleSpecList" title="Show/Hide Spectra list" class="btn btn-1a btn-topNav">&#9776;</button>
								<button id="nextSpectrum" title="Next Spectrum" class="btn btn-1a btn-topNav">&#x203A;</button>
								<button id="toggleAltList" title="Show/Hide alternative explanation list" class="btn btn-1">Alternatives</button>
							</span>         		
		            	</div> 
	                    <div class="heightFill">
	                        <svg id="spectrumSVG"></svg>
	                        <div id="measureTooltip"></div>
	                    </div>
					</div>
				</div><!-- end top div -->
<!-- 				<div class="gutter gutter-vertical" style="height: 10px;"></div> -->
				<div id="altDiv" class="tableDiv">
					<i class="fa fa-times-circle closeButton closeTable" id="altListClose"></i>
					<div id="altListWrapper" class="listWrapper">
						<div id="altList_main">
							<span style="color: #fff;">Alternative Explanations for current spectrum:</span>
							<table id="altListTable" class="display" width="100%" style="text-align:center;">
								<thead>
									<tr>
									    <th>internal_id</th>
									    <th>id</th>
									    <th>rank</th>
									    <th>peptide 1</th>
									    <th>peptide 2</th>
									    <th style="min-width: 50px">CL pos 1</th>
									    <th style="min-width: 50px">CL pos 2</th>
									    <th>charge</th>
									    <th>isDecoy</th>
										<th>score</th>
										<th>protein</th>
									    <th>passThreshold</th>
									    <th>alt_count</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
				<div id="bottomDiv" class="tableDiv">
				<i class="fa fa-times-circle closeButton closeTable" id="specListClose"></i> 
					<div id="specListWrapper" class="listWrapper">
						<div id="specList_main">
							<table id="specListTable" class="display" width="100%" style="text-align:center;">
								<thead>
									<tr>
										<th>internal_id</th>
										<th>id</th>
										<th>peptide 1</th>
										<th>peptide 2</th>
										<th style="min-width: 50px">CL pos 1</th>
										<th style="min-width: 50px">CL pos 2</th>
										<th>charge</th>
										<th>isDecoy</th>
										<th>score</th>
										<th>protein</th>
										<th>passThreshold</th>
										<th>alt_count</th>
										<th>dataRef</th>
										<th>scanID</th>									    
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
            </div>

<!-- 			<div class="controls">
				<span id="filterPlaceholder"></span>
			</div> -->
        </div><!-- MAIN -->

		<!-- Modal -->
		<div id="saveModal" role="dialog" class="modal" style="background: #333; width:650px; text-align: center">
			<div class="header" style="background: #750000; color:#fff"">
				Save your dataset
			</div>
			<div class="content" id="saveModal_content">
				<span id="saveDBerror"></span>
				<p>
					<label>Name: <input class="form-control" length=30 id="saveDbName" name="dbName" type="text" placeholder="Enter a name for your dataset" style="width:30%"></label>
				</p>
				<p><button id="saveDataSet" class="btn btn-1 btn-1a">Save</button></p>
	<!-- 			<div id="shareLink" class="btn clearfix" style="font-size: 1.1em;margin:10px 5px;">
					<button id="requestShareLink" type="submit" class="btn btn-1a" >Click here to generate a link for later access or sharing</button>
				</div> -->
			</div>
		</div>
    </body>
</html>
