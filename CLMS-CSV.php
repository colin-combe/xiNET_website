<!DOCTYPE html>
<html lang="en">
<head>
   <meta name="generator" content=
   "HTML Tidy for HTML5 for Linux version 5.2.0"><?php
       $pageName = "CLMS-CSV";
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
            <h1 class="page-header">Cross-link CSV File Format</h1>
            <p>Example files: <a href="./data/PolII.csv" target=
            "_blank">Pol II</a>, <a href="./data/PP2A.csv" target=
            "_blank">PP2A</a></p><br>
            <p>Information on representing <a href=
            "#ambiguous">ambiguous links</a> and <a href=
            "#productTypes">different product types</a> is
            below.</p><br>
            <p>xiNET can display data either with or without
            information on the sequences of the linked peptides.
            The fields PepPos1, PepSeq1, PepPos2 and PepSeq2 are
            only used when peptide sequence information is being
            supplied.</p>
            <table class="hor-minimalist-a" style=
            "border:1px solid #000;background-color:#eee;">
               <col>
               <col>
               <col>
               <tr>
                  <td>
                     <h6>COLUMN NAME</h6>
                  </td>
                  <td>
                     <h6>REQUIRED?</h6>
                  </td>
                  <td>
                     <h6>NOTES</h6>
                  </td>
               </tr>
               <tr>
                  <td>
                     <p>Protein1</p>
                  </td>
                  <td>
                     <p>Yes</p>
                  </td>
                  <td>
                     <p>Identifier for protein 1</p>
                  </td>
               </tr>
               <tr>
                  <td>
                     <p>PepPos1</p>
                  </td>
                  <td>
                     <p>No</p>
                  </td>
                  <td>
                     <p>One-based residue number for peptide 1
                     start position in protein 1.</p>
                  </td>
               </tr>
               <tr>
                  <td>
                     <p>PepSeq1</p>
                  </td>
                  <td>
                     <p>No</p>
                  </td>
                  <td>
                     <p>Sequence for peptide 1, lowercase
                     characters ignored.</p>
                  </td>
               </tr>
               <tr>
                  <td>
                     <p>LinkPos1</p>
                  </td>
                  <td>
                     <p>If PepSeq1 is present</p>
                  </td>
                  <td>
                     <p>One-based residue number for linkage site
                     in peptide 1, or absolute position for link in
                     Protein 1 if peptide position is ommitted.</p>
                  </td>
               </tr>
               <tr>
                  <td>
                     <p>Protein2</p>
                  </td>
                  <td>
                     <p>See note</p>
                  </td>
                  <td>
                     <p>Identifier for protein 2. This value is
                     omitted for a linker modified peptide or an
                     internally cross-linked peptide.</p>
                  </td>
               </tr>
               <tr>
                  <td>
                     <p>PepPos2</p>
                  </td>
                  <td>
                     <p>No</p>
                  </td>
                  <td>
                     <p>One-based residue number for peptide 2
                     start position in protein 2.</p>
                  </td>
               </tr>
               <tr>
                  <td>
                     <p>PepSeq2</p>
                  </td>
                  <td>
                     <p>No</p>
                  </td>
                  <td>
                     <p>Sequence for peptide 2, lowercase
                     characters ignored.</p>
                  </td>
               </tr>
               <tr>
                  <td>
                     <p>LinkPos2</p>
                  </td>
                  <td>
                     <p>If PepSeq2 is present</p>
                  </td>
                  <td>
                     <p>One-based residue number for linkage site
                     in peptide 2, or absolute position for link in
                     Protein 2 if peptide position is ommitted.</p>
                     <p>Ommitted for linked modified peptides
                     (mono-links).</p>
                  </td>
               </tr>
               <tr>
                  <td>
                     <p>Score</p>
                  </td>
                  <td>
                     <p>No</p>
                  </td>
                  <td>
                     <p>Confidence score – used by cut-off
                     slider.</p>
                  </td>
               </tr>
               <tr>
                  <td>
                     <p>Id</p>
                  </td>
                  <td>
                     <p>No</p>
                  </td>
                  <td>
                     <p>Id for link</p>
                  </td>
               </tr>
            </table>
         </div>
      </section>
      <section id="ambiguous" class="two">
         <div class="container">
            <h4>Ambiguous Linkage Sites</h4>
            <p>Ambiguous links are represented by listing the
            alternative linkage sites separated by commas or
            semi-colons in the protein and position fields. For
            example:</p>
            <table class="hor-minimalist-a" style=
            "position:relative;border:1px solid #000;background-color:#eee;">
               <tr>
                  <td>
                     <p>Protein1</p>
                  </td>
                  <td>
                     <p>LinkPos1</p>
                  </td>
                  <td>
                     <p>Protein2</p>
                  </td>
                  <td>
                     <p>LinkPos2</p>
                  </td>
               </tr>
               <tr>
                  <td>
                     <p>O43815; Q13033</p>
                  </td>
                  <td>
                     <p>89; 105</p>
                  </td>
                  <td>
                     <p>O43815; Q13033</p>
                  </td>
                  <td>
                     <p>96; 112</p>
                  </td>
               </tr>
            </table>
            <p>would result in these four ambiguous links being
            displayed:</p>
            <p>from O43815, residue 89 to O43815, residue 96<br>
            from O43815, residue 89 to Q13033, residue 112<br>
            from Q13033, residue 105 to O43815, residue 96<br>
            from Q13033, residue 105 to Q13033, residue 112<br></p>
         </div>
      </section>
      <section id="productTypes" class="one">
         <div class="container">
            <h4>Product types</h4>
            <p>The figures below show the representation of
            different product types. These are: (a) linker modified
            peptides; (b) internally linked peptides; and, (c)
            cross-linked peptides. The product type is indicated by
            the presence or absence of information for the second
            protein and second link position. We also identify a
            subset of cross-linked peptides, (d), in which the
            peptides overlap in the protein sequence.</p><br>
            <table class="productTypeFigs">
               <tr>
                  <td>
                     <div class="productTypeFigLeft">
                        <h6><u>(a) Linker modified
                        peptides</u></h6><a title=
                        "Click to view larger." href=
                        "images/diagrams/f4a.svg"><img alt=
                        "Linker modified peptides" class=
                        "image featured full" src=
                        "images/diagrams/f4a.svg"></a>
                        <p>&nbsp;</p>
                     </div>
                  </td>
                  <td>
                     <div class="productTypeFigRight">
                        <h6><u>(b) Internally linked
                        peptides</u></h6><a title=
                        "Click to view larger." href=
                        "images/diagrams/f4b.svg"><img alt=
                        "Internally linked peptides" class=
                        "image featured full" src=
                        "images/diagrams/f4b.svg"></a>
                        <p>&nbsp;</p>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>
                     <div class="productTypeFigLeft">
                        <h6><u>(c) Cross-linked
                        peptides.</u></h6><a title=
                        "Click to view larger." href=
                        "images/diagrams/f4c.svg"><img alt=
                        "Cross-linked peptides" class=
                        "image featured full" src=
                        "images/diagrams/f4c.svg"></a>
                        <p>&nbsp;</p>
                     </div>
                  </td>
                  <td>
                     <div class="productTypeFigRight">
                        <h6><u>(d) Homomultimers (cross-links in
                        which peptide sequences
                        overlap)</u></h6><a title=
                        "Click to view larger." href=
                        "images/diagrams/f4d.svg"><img alt=
                        "Homomultimers" class="image featured full"
                        src="images/diagrams/f4d.svg"></a>
                        <p>&nbsp;</p>
                     </div>
                  </td>
               </tr>
            </table>
         </div>
      </section>
   </div>
</body>
</html>
