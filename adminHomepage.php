<?php
$rollen = array("admin");
require_once("./security.php");

require_once("./classes/VerkoopClass.php");
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <link href="style.css" rel="stylesheet" type="text/css">
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
                <ul class="list-group">
                    <li class="list-group-item"><a href="index.php?content=adminHomepage">Admin Homepage</a></li>
                    <li class="list-group-item"><a href="index.php?content=productenToevoegen">Producten Toevoegen</a></li>
                    <li class="list-group-item"><a href="index.php?content=productVanDeDag">Product van de dag</a></li>
                    <li class="list-group-item"><a href="index.php?content=productenBeheren">Producten beheren</a></li>
                    <li class="list-group-item"><a href="index.php?content=verwijderProduct">Producten verwijderen</a></li>
                    <!-- <Wijzigingsopdracht>  -->
                    <li class="list-group-item"><a href="index.php?content=nieuweProducten">Nieuwe producten</a></li>
                    <!-- </Wijzigingsopdracht> -->
                    <li class="list-group-item"><a href="index.php?content=beschikbaarMaken">Producten beschikbaar
                            maken</a></li>
                    <li class="list-group-item"><a href="index.php?content=rolWijzigen">Gebruikerrol veranderen</a></li>
                    <li class="list-group-item"><a href="index.php?content=blokkeren">Gebruiker blokkeren</a></li>
                    <li class="list-group-item"><a href="index.php?content=gebruikerVerwijderen">Gebruiker
                            verwijderen</a></li>
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