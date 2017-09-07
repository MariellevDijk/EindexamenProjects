<?php
$rollen = array("admin");
require_once("./security.php");

require_once("./classes/VerkoopClass.php");
?>
<html>
<head>
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
            <div class="col-md-12"><h2>Admin Homepage</h2></div>
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
                <br><br>
            </div>
            <div class="row">
                <div class="col-md-12"><h3>Meest gewilde producten</h3></div>
            </div>
            <div class="row">
                <?php
                require_once("classes/LoginClass.php");
                require_once("classes/VerkoopClass.php");
                require_once("classes/SessionClass.php");

                $result = VerkoopClass::get_most_popular_products();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row["beschikbaar"]) {
                            echo " <div style='height: 800px;' class=\"col-md-3\">
                   <h4 class=\"videos\"> Aantal keer verkocht: " . $row["aantalVerkocht"] . "</h4>
                   <img style='height: 400px' src=\"images/" . $row["foto"] . "\" class=\"img-responsive\">
                   <h3>" . $row["naam"] . "</h3>
                   <p class=\"videos\">" . $row["beschrijving"] . "</p>
    
                   <a href='index.php?content=productPagina&idProduct=" . $row["idProduct"] . "'><button type=\"button\" class=\"btn btn-primary\">Meer Informatie</button></a>
    
                   <br><br><br></div>
                 ";
                        }
                    }
                } else {
                    echo "0 results";
                }
                ?>

                <br><br>
            </div>
    </div>
</div>
</body>
</html>