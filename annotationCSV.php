<!DOCTYPE HTML>
<html lang="en">
<head>
    <?php
    $pageName = "Annotation CSV";
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
                            <h1 class="page-header">Annotation CSV file format</h1>
                                    <p>Example files: <a href="./data/TFIIF.csv" target="_blank">TFIIF cross-link data</a> , <a href="./data/TFIIF_annot.csv" target="_blank">TFIIF annotations</a> (to test <a href="./upload.php">upload both files</a>)</p>
								<br>
                                <table class="hor-minimalist-a" style="border:1px solid #000;background-color:#eee;">
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
                                            <p>ProteinId</p>
                                        </td>
                                        <td>
                                            <p>Yes</p>
                                        </td>
                                        <td>
                                            <p>Identifier for protein to annotate.</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>AnnotName</p>
                                        </td>
                                        <td>
                                            <p>Yes</p>
                                        </td>
                                        <td>
                                            <p>Name of annotation.</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>StartRes</p>
                                        </td>
                                        <td>
                                            <p>Yes</p>
                                        </td>
                                        <td>1-based start residue of annotation</td>
                     <!--                   <td width=390 rowspan=2>

                                            <p>If StartResidue and EndResidue are ommitted
                                            then the annotation is assumed to be non-positional (i.e. a keyword):
                                            the circle will be colored according to it but it will not be represented on the bar.
                                            </p>

                                        </td>                   -->
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>EndRes</p>
                                        </td>
                                        <td>
                                            <p>Yes</p>
                                        </td>
                                        <td>1-based end residue of annotation</td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Color</p>
                                        </td>
                                        <td>
                                            <p>No</p>
                                        </td>
                                        <td>
                                            <p>Hex value for color or  <a target="_blank" href="https://www.w3schools.com/colors/colors_names.asp">HTML color name</a><br>
												If omitted then a color is chosen automatically.
                                             In this case annotations with the same name are always assigned the same color.</p>
                                        </td>
                                    </tr>

                                </table>
                        </div> <!-- CONTAINER -->
                    </section>
            </div>
    </body>
</html>
