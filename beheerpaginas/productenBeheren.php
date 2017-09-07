<?php
$rollen = array("admin", "eigenaar");
require_once("./security.php");
?>

<?php

require_once("classes/LoginClass.php");
if (isset($_POST['submit'])) {

    ProductClass::wijzig_gegevens_product($_POST);

    echo "<h3 style='text-align: center;' >Uw wijzigingen zijn verwerkt.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    header("refresh:4;url=index.php?content=\beheerpaginas\adminHomepage");


} else {
    ?>
    <html>
    <body>
        <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12"><h2>Video's beheren</h2></div>
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
                        <li><a href="index.php?content=\beheerpaginas\rolWijzigen">Gebruikerrol veranderen</a></li>
                        <li><a href="index.php?content=\beheerpaginas\blokkeren">Gebruiker blokkeren</a></li>
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

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "
                                <form role=\"form\" action=\"\" method=\"post\">
                                <div class=\"form-group\"><label class=\"control-label\" for=\"naam\">Naam<br></label>
                                    <input class=\"form-control\" id=\"naam\" placeholder=\"naam\" type=\"text\" name=\"naam\" value='" . $row['naam'] . "' required></div>
                                <div class=\"form-group\"><label class=\"control-label\" for=\"beschrijving\">Beschrijving<br></label>
                                    <input class=\"form-control\" id=\"beschrijving\" placeholder=\"Beschrijving\" type=\"text\" name=\"beschrijving\" value='" . $row['beschrijving'] . "' required></div>
                                <div class=\"form-group\"><label class=\"control-label\" for=\"foto\">Foto<br></label>
                                    <input class=\"form-control\" id=\"foto\" placeholder=\"Foto\" type=\"text\" name=\"foto\" value='" . $row['foto'] . "' required></div>
                                <div class=\"form-group\"><label class=\"control-label\" for=\"prijs\">Prijs<br></label>
                                    <input class=\"form-control\" id=\"prijs\" placeholder=\"Prijs\" type=\"text\" name=\"prijs\" value='" . $row['prijs'] . "' required></div>
                                <div class=\"form-group\"><label class=\"control-label\" for=\"aantalBeschikbaar\">Aantal Beschikbaar</label>
                                    <input class=\"form-control\" id=\"aantalBeschikbaar\" placeholder=\"Aantal Beschikbaar\" type=\"text\" name=\"aantalBeschikbaar\" value='" . $row['aantalBeschikbaar'] . "' required></div>
                                <!--<select name='acteurSelect'>-->";
        //                            $sql2 = "SELECT DISTINCT b.naam, a.idActeur FROM videoacteur AS a INNER JOIN acteur AS b ON a.idActeur = b.idActeur ORDER BY naam ASC";
        //                            $result2 = $conn2->query($sql2);
        //                            while ($row2 = mysqli_fetch_array($result2)) {
        //                                echo "<option value='" . $row2['idActeur'] . "'>" . $row2['naam'] . "</option>";
        //                            }
                            echo "
                                   <!-- </select> -->
                                <input type='hidden' name='idProduct' value='" . $row['idProduct'] . "'/>
                                <button type=\"submit\" class=\"btn btn-danger\" name=\"submit\">Verzend</button>
                            </form><br><hr>";

                        }
                        echo "
                                   <br><br><br><br><br><br><br><br>
                                    
                                    ";


                    } else {
                        echo "Geen resultaten<br><br><br><br><br><br><br><br><br><br><br>";
                    }
                    ?>
                </div>
            </div>
        </div>
        </div>
    </body>
    </html>
    <?php
}
?>