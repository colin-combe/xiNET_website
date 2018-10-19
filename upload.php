<!DOCTYPE html>
<html lang="en">
<head>
   <?php
       $pageName = "Upload your Data";
       include("head.php");
   ?>
</head>
<body>
   <!-- Sidebar -->
   <?php include("navigation.php");?><!-- Main -->
   <div id="main">
      <!-- Intro -->
      <section id="top" class="one">
         <div class="container">

		

            <h1 class="page-header">NEW! Try xiNET's successor at <a href="https://xiview.org">xiVIEW.org</a></h1>
        	

            <h1 class="page-header">Upload Your Own Data</h1>
            <form class="fileupload" action="./fup.php" enctype=
            "multipart/form-data" method="post">
               <table>
                  <tr>
                     <td>
                        <div class="cross-link-csv">
                           <label for="csvFile">Cross-link CSV
                           file:</label> <input style=
                           "margin: 0;padding: 0;" class=
                           "file btn btn-1 btn-1a-inputbtn" name=
                           "upfile" type="file" id="csvFile">
                        </div><!-- CROSS-LINK-CSV -->
                     </td>
                     <td>
                        <div class="fasta-file">
                           <label for="fastaFile">FASTA
                           file:</label> <input style=
                           "margin: 0;padding: 0;" class=
                           "file btn btn-1 btn-1a-inputbtn" name=
                           "upfasta" type="file" id="fastaFile">
                        </div><!-- FASTA-FILE -->
                     </td>
                     <td>
                        <div class="annotation-csv-file">
                           <label for="annotFile">Annotation CSV
                           file:</label> <input style=
                           "margin: 0;padding: 0;" class=
                           "file btn btn-1 btn-1a-inputbtn" name=
                           "upannot" type="file" id="annotFile">
                        </div><!-- ANNOTATION-CSV-FILE -->
                     </td>
                  </tr>
               </table>
               <div class="custom_file_upload">
                  <div class=
                  "file_upload btn btn-1 btn-1a-inverse">
                     <input class="upload" value="Upload" type=
                     "submit">
                  </div><!-- CUSTOM_FILE_UPLOAD -->
               </div><br>
               <p class="center" style=
               "margin-bottom:-40px;top:-50px;position:relative;">
               You will be redirected to a unique URL for your data
               which you can share with others.</p>
            </form>
            
            <div class="image-link"><img alt="xiNET workflow" class="image full" 
					src="images/diagrams/workflow.svg"></div>
            <p>You can view your results by uploading <a href=
            "./CLMS-CSV.php">cross-link data</a> in a Comma Separated
            Values (CSV) file.</p>
            <br>
            <p>Optionally, this can be accompanied
            by a <a href=
            "https://en.wikipedia.org/wiki/FASTA_format" target=
            "_blank">FASTA file</a> giving the protein sequences
            and/or a CSV file containing <a href=
            "./annotationCSV.php">annotations</a>.</p>  
            <br>
            <p>For further information on the file formats see:</p>
            <ul>
				<li><a id="CLMS-CSV" href="./CLMS-CSV.php">Cross-link CSV format</a></li>
				<li><a href="./proteinData.php">FASTA files / protein IDs</a></li>
				<li><a id="Annotations" href="./annotationCSV.php">Annotations CSV format</a></li>
			</ul>
         </div><!-- CONTAINER -->
      </section>
   </div>
</body>
</html>
