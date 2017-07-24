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
            
            <div class="image-link-left"><img alt="xiNET workflow" class="image full" 
					src="images/diagrams/workflow.svg"></div>
            <h4>Getting Started</h4>
            <p>You can view your results by uploading <a href=
            "#CLMS-CSV">cross-link data</a> in a Comma Separated
            Values (CSV) file. Optionally, this can be accompanied
            by a <a href=
            "https://en.wikipedia.org/wiki/FASTA_format" target=
            "_blank">FASTA file</a> giving the protein sequences
            and/or a CSV file containing <a href=
            "#annotCSV">annotations</a>. If the FASTA file is
            omitted then protein sequences are retrieved by looking
            up accession numbers via the UniprotKB web service. 
            <!--
                                <a href="http://www.biodas.org/wiki/Main_Page" target="_blank">Distributed Annotation System</a>. 
-->
             This assumes that the sequences used in the search
            correspond exactly with those of valid, current
            UniprotKB accession numbers.</p>
            <div class="columnNames">
               <h4>Column Names in CSV files</h4>
               <ul style="list-style-type:square;">
                  <li>Column names are required as the first line
                  of the CSV file.</li>
                  <li>Column names are case-sensitive.</li>
                  <li>The order of the columns is unspecified.</li>
               </ul>
            </div>
            <div class="protIds">
               <h4>Protein Identifiers</h4>
               <h6>If a FASTA file is provided:</h6>
               <p>then the protein identifiers (columns 'Protein1'
               and 'Protein2') must match identifiers in the FASTA
               file. In a FASTA file, the word following the "&gt;"
               symbol is the identifier of the sequence, and the
               rest of the line is the description.</p>
               <div class="external-link">
                  <h6>If a FASTA file is not provided:</h6>
                  <p>protein identifiers are assumed to be six
                  character <a href=
                  "http://www.uniprot.org/help/accession_numbers">UniprotKB</a>
                  accession numbers. SwissProt style identifiers of
                  the format: <code>sp|accession|name</code> are
                  also accepted and in this case 'name' will be
                  used for the protein labels.</p>
               </div>
            </div>
         </div><!-- CONTAINER -->
      </section>
   </div>
</body>
</html>
