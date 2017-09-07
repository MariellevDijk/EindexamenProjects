<?php
$rollen = array("admin", "eigenaar");
require_once("./security.php");
?>


<html>
<body>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12"><h2>Meest verkochte producten verkocht</h2></div>
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
                </div>

                <div class="col-md-6">
                    <?php
                    require_once("classes/LoginClass.php");
                    require_once("classes/VerkoopClass.php");
                    require_once("classes/SessionClass.php");

                    $result = VerkoopClass::meestVerkochteProducten();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                            echo "
                        <table class=\"table table - responsive\">
                            <thead>
                            <tr>
                                <th>
                                        id Order
                                </th>
                                <th>
                                        id Product
                                </th>
                                <th>
                                        Naam Product
                                </th>
                                <th>
                                        Prijs
                                </th>
                                <th>
                                        Aantal
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                        " . $row['idOrder'] . "
                                </td>
                                <td>
                                        " . $row['idProductOr'] . "
                                </td>
                                <td>
                                        " . $row['naam'] . "
                                </td>
                                <td>
                                        " . $row['prijsOr'] . "
                                </td>
                                <td>
                                        " . $row['aantal'] . "
                                </td>
                            </tr>
                            </tbody>
                        </table>
                            ";
                        }
                    } else {
                        echo "Geen resultaten<br><br><br><br><br><br><br>";
                    }
                    ?>

                    <br><br>
                </div>
            </div>
            </row>
        </div>
    </div>

</body>
</html>