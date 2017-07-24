<!DOCTYPE HTML>
<html lang="en">
<head>
    <?php
    $pageName = "Home";
    include("head.php");
    ?>
</head>
    <body>
        <!-- Sidebar -->
        <?php include("navigation.php");?>

        <!-- Main -->
            <div id="main">

                <!-- Intro -->
                    <section id="top" class="one">
                        <div class="container">

                            <h1 class="page-header">Protein Data</h1>
 								
                                <p>A <a href="https://en.wikipedia.org/wiki/FASTA_format" target="_blank">FASTA file</a>
                                can be uploaded to provide protein sequence data.</p> 
                                <br>
                                <p>If the FASTA file is omitted then protein sequences are retrieved by looking up accession numbers via the UniprotKB web service. 
                                This assumes that the sequences used in the search correspond exactly with those of valid, current UniprotKB accession numbers. </p> 
								<br>
	                              <h4>Protein Identifiers</h4>
                                <b>If a FASTA file is provided:</b>

                                <p> then the protein identifiers
                                    (columns 'Protein1' and 'Protein2') must match identifiers in the
                                    FASTA file. In a FASTA file, the word following the
                                    "&gt;" symbol is the identifier of the sequence,
                                    and the rest of the line is the description.</p>
                                <b>If a FASTA file is not provided:</b> 
                                <p> protein identifiers are
                                    assumed to be six character <a href="http://www.uniprot.org/help/accession_numbers">UniprotKB</a> accession numbers. SwissProt style identifiers of the format: <code>sp|accession|name</code> are also accepted and in this case 'name' will be used for the protein labels.</p>
                        </div> <!-- CONTAINER -->
                    </section>              
            </div>
    </body>
</html>
