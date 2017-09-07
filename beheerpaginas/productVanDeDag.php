<?php
$rollen = array("admin", "eigenaar");
require_once("./security.php");
?>

<?php

require_once("classes/LoginClass.php");
require_once("classes/ProductClass.php");
if (isset($_POST['submit'])) {

    ProductClass::set_product_van_de_dag($_POST['idProduct']);

    echo "<h3 style='text-align: center;' >Uw wijzigingen zijn verwerkt.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    header("refresh:4;url=index.php?content=\beheerpaginas\adminHomepage");


} else {
    ?>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript"
                src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
              type="text/css">
        <link href="../style.css" rel="stylesheet" type="text/css">
        <style>
            .header {
                font-size: 24px;
                padding: 20px;
            }

            th {
                min-width: 300px;
            }

        </style>

    </head>
<body>
<div class="section">
    <div class="container">
    <div class="row">
        <div class="col-md-12"><h2>Product van de Dag</h2></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="index.php?content=\beheerpaginas\adminHomepage">Admin Homepage</a></li>
                <li><a href="index.php?content=\beheerpaginas\productenToevoegen">Producten Toevoegen</a></li>
                <li><a href="index.php?content=\beheerpaginas\productVanDeDag">Product van de dag</a></li>
                <li><a href="index.php?content=\beheerpaginas\productenBeheren">Producten beheren</a></li>
                <li><a href="index.php?content=\beheerpaginas\verwijderProduct">Producten verwijderen</a></li>
                <li><a href="index.php?content=\beheerpaginas\beschikbaarMaken">Producten beschikbaar maken</a></li>
                <li><a href="index.php?content=\beheerpaginas\meestVerkochtProductOverview">Meest Verkochte Producten Overview</a></li>
                <li><a href="index.php?content=\beheerpaginas\rolWijzigen">Gebruikerrol veranderen</a></li>
                <li><a href="index.php?content=\beheerpaginas\blokkeren">Gebruiker blokkeren</a></li>
                <li><a href="index.php?content=\beheerpaginas\klachtenBekijken">Klachten Bekijken</a></li>
            </ul>
        </div>
    </div>
    <div class="row">

        <div class="col-md-12">
            <?php
            require_once("classes/LoginClass.php");
            require_once("classes/VerkoopClass.php");
            require_once("classes/SessionClass.php");
            require_once("classes/ProductClass.php");

            $result = ProductClass::get_available_products();

            if ($result->num_rows > 0) { ?>
                <form role="form" action='' method='post'>
                <div class="form-group">
                    <label class="control-label" for="idProduct">Product<br></label>
                    <select class="form-control" name="idProduct">
                        <?php
                            while ($row = $result->fetch_assoc()) {
                                echo"<option value='".$row['idProduct']."'>id product: ".$row['idProduct'].", Naam: ".$row['naam'].",  Prijs: ".$row['prijs']." <euro></euro></option>";
                            }
                        ?>
                    </select>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Verstuur<br></button>

            </form>
            <?php
            } else {
                echo "Geen resultaten<br><br><br><br><br><br><br><br><br><br><br>";
            }
            echo "<div class=\"col-md-12\"><h2>Product van de Dag</h2></div>";
            $result1 = ProductClass::get_Product_Van_De_Dag();

            if ($result1->num_rows > 0) {
                while ($row = $result1->fetch_assoc()) {
                    if ($row["beschikbaar"]) {
                        echo "
                            <div style='height: 1000px; margin-bottom: -20px;' class=\"col-md-3\">
                                <img style='height: 400px' src=\"images/" . $row["foto"] . "\" class=\"img-responsive\">
                                <h3>" . $row["naam"] . "</h3>
                                <p class=\"videos\"><strike>" . $row["prijs"] . "</strike> " . $row["prijsDagProduct"] . "</p>
                                <p class=\"videos\">" . $row["beschrijving"] . "</p>
                                <br><br><br>
                            </div>
                        ";
                    }
                }
            }
            else {
                echo "Op dit moment is er geen product van de dag";
            }
            ?>




        </div>
    </div>
    <?php
}
?>