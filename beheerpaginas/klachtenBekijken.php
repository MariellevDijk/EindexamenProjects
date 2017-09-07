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
                        <div class="col-md-12"><h2>Klachten</h2></div>
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
                    require_once("classes/KlachtClass.php");
                    require_once("classes/SessionClass.php");

                    $result = KlachtClass::get_all_klachten();


                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $result2 = KlachtClass::get_email_klant_with_klacht($row);
                            $row2 = $result2->fetch_assoc();

                            $emailAdresKlant = $row2['emailAdres'];
                            echo "
                        <table class=\"table table - responsive\">
                            <thead>
                            <tr>
                                <th>
                                        Klant emailadres:
                                </th>
                                <th>
                                        Klacht:
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                                <td>
                                        <a href='mailto:" . $row2['emailAdres'] . "'/>Klik om te mailen</a>
                                </td>
                                <td>
                                        " . $row['klacht'] . "
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