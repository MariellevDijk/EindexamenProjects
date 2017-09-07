<?php
$rollen = array(
    "klant",
    "admin",
    "verkoopleidster"
);
require_once("./security.php");

?>

<?php

if (isset($_POST['submit'])) {
    echo "<h3 style='text-align: center;' >Meest verkocht Item toegevoegd aan winkelmand.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    header("refresh:4;url=index.php?content=winkelmand");
    require_once("./classes/VerkoopClass.php");
    VerkoopClass::insert_most_sold_winkelmanditem_database($_POST);
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
        <link href="Videos.css" rel="stylesheet" type="text/css">
        <style>
            header {
                font-size: 24px;
                padding: 20px;
            }

        </style>
    </head>
    <body>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="section ">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12"><h2>Zoeken</h2><br></div>
                            <div style=' margin-bottom: -20px;' class="col-md-3">
                                <form role=\"form\" action='' method='post'>
                                    Zoek op beschrijving:
                                    <input type='text' name='zoekterm' id="zoekterm"/>
                                    <button type='submit' name='zoekBeschrijving' class='btn btn-success'>Zoek<br>
                                    </button>
                                </form>

                                <br><br><br>
                            </div>
                            <div style=' margin-bottom: -20px;' class="col-md-3">
                                <form role=\"form\" action='' method='post'>
                                    Zoek op artikel code:
                                    <input type='text' name='artikelcode' id="artikelcode"/>
                                    <button type='submit' name='zoekArtikelcode' class='btn btn-success'>Zoek<br>
                                    </button>
                                </form>

                                <br><br><br>
                            </div>
                            <?php
                            require_once("classes/TypeClass.php");
                            $type = TypeClass::get_all_type();
                            ?>
                            <div style=' margin-bottom: -20px;' class="col-md-3">
                                <form role=\"form\" action='' method='post'>
                                    Zoek op type:
                                    <select class="form-control" name="type">
                                        <?php
                                        while ($row = $type->fetch_assoc()) {
                                            echo "<option value='" . $row['idType'] . "'>" . $row['naam'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <button type='submit' name='zoekType' class='btn btn-success'>Zoek<br></button>
                                </form>

                                <br><br><br>
                            </div>
                            <div style=' margin-bottom: -20px;' class="col-md-3">
                                <form role=\"form\" action='' method='post'>
                                    Sorteer op prijs<br>
                                    Meer dan   <input type="number" name="hogerDan" min="1" max="2000"><br>
                                    Minder dan<input type="number" name="lagerDan" min="1" max="2000"><br>
                                    <button type='submit' name='zoekPrijs' class='btn btn-success'>Zoek<br></button>
                                </form>

                                <br><br><br>
                            </div>
                            <?php
                            if (isset($_POST['zoekBeschrijving'])) {
                                echo "<div class=\"col-md-12\"><h2>Gevonden producten op Beschrijving</h2>";
                            } else if (isset($_POST['zoekArtikelcode'])) {
                                echo "<div class=\"col-md-12\"><h2>Gevonden producten op Artikelcode</h2>";
                            } else if (isset($_POST['zoekType'])) {
                                echo "<div class=\"col-md-12\"><h2>Gevonden producten op Type</h2>";
                            } else if (isset($_POST['zoekPrijs'])) {
                                echo "<div class=\"col-md-12\"><h2>Gevonden producten op Prijs</h2>";
                            } else {
                                echo "<div class=\"col-md-12\"><h2>Producten</h2>";
                            }
                            ?>
                            <form role=\"form\" action='' method='post'>
                                <button type='submit' name='reset' class='btn btn-success'>Reset<br></button>
                            </form>
                            <br>
                        </div>
                        <?php
                        require_once("classes/LoginClass.php");
                        require_once("classes/SessionClass.php");

                        if (isset($_POST['zoekBeschrijving'])) {
                            $result = ProductClass::get_products_by_description($_POST);
                        } else if (isset($_POST['zoekArtikelcode'])) {
                            $result = ProductClass::get_products_by_id($_POST);
                        } else if (isset($_POST['zoekType'])) {
                            $result = ProductClass::get_products_by_type($_POST);
                        } else if (isset($_POST['zoekPrijs'])) {
                            $result = ProductClass::get_products_by_prijs($_POST);
                        } else if (isset($_POST['reset'])) {
                            $result = ProductClass::get_available_products();
                        } else {
                            $result = ProductClass::get_available_products();
                        }
                        // <Wijzigingsopdracht>

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                if ($row["beschikbaar"]) {
                                    echo "
                                                    <div style='height: 1000px; margin-bottom: -20px;' class=\"col-md-3\">
                                                        <img style='height: 400px' src=\"images/" . $row["foto"] . "\" class=\"img-responsive\">
                                                        <h3>" . $row["naam"] . "</h3>
                                                        <p class=\"videos\">" . $row["prijs"] . "</p>
                                                        <p class=\"videos\">" . $row["beschrijving"] . "</p>
            
                                                        <a href='index.php?content=productPagina&idProduct=" . $row["idProduct"] . "'>
                                                        <button type=\"button\" class=\"btn btn-info\">Meer Informatie</button></a>
                                                        
                                                        
                                                         <form role = \"form\" action='' method='post'>
                                                         <b>Aantal:     </b><input type='number' name='amount' max='" . $row["aantalBeschikbaar"] . "'/>
                                                        <input type='hidden' name='idProduct' value='" . $row['idProduct'] . "'>
                                                        <input type='hidden' name='idUser' value='" . $_SESSION['idUser'] . "'>
                                                        <input type='hidden' name='naam' value='" . $row['naam'] . "'>
                                                        <input type='hidden' name='prijs' value='" . $row['prijs'] . "'>
                
                                                        <button type='submit' name='submit' class='btn btn-info'>Toevoegen aan winkelmand<br></button>
                                                        </form>
                                                        
                                                        <form role=\"form\" action='' method='post'>
                                                            <input type='submit' class=\"btn btn-danger\" style='background: red;' name='favoriet' value='Voeg toe aan favoriete producten'>
                                                            <input type='hidden' class=\"btn btn-success\" name='idProduct' value='" . $row['idProduct'] . "'/>
                                                        </form>
                                                        
                                                        <br><br><br>
                                                    </div>
                                                ";
                                }
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
                        <div class="col-md-12"><h2>Accessoires</h2><br></div>

                        <?php
                        require_once("classes/LoginClass.php");
                        require_once("classes/SessionClass.php");
                        require_once("classes/ProductClass.php");

                        $result1 = ProductClass::selecteer_accessoires();


                        if ($result1->num_rows > 0) {
                            while ($row = $result1->fetch_assoc()) {
                                if ($row["beschikbaar"]) {
                                    echo "
                                                    <div style='height: 1000px; margin-bottom: -20px;' class=\"col-md-3\">
                                                        <img style='height: 400px' src=\"images/" . $row["foto"] . "\" class=\"img-responsive\">
                                                        <h3>" . $row["naam"] . "</h3>
                                                        <p class=\"videos\">" . $row["prijs"] . "</p>
                                                        <p class=\"videos\">" . $row["beschrijving"] . "</p>
            
                                                        <a href='index.php?content=productPagina&idProduct=" . $row["idProduct"] . "'>
                                                        <button type=\"button\" class=\"btn btn-info\">Meer Informatie</button></a>
                                                        
                                                        
                                                         <form role = \"form\" action='' method='post'>
                                                         <b>Aantal:     </b><input type='number' name='amount' max='" . $row["aantalBeschikbaar"] . "'/>
                                                        <input type='hidden' name='idProduct' value='" . $row['idProduct'] . "'>
                                                        <input type='hidden' name='idUser' value='" . $_SESSION['idUser'] . "'>
                                                        <input type='hidden' name='naam' value='" . $row['naam'] . "'>
                                                        <input type='hidden' name='prijs' value='" . $row['prijs'] . "'>
                
                                                        <button type='submit' name='submit' class='btn btn-info'>Toevoegen aan winkelmand<br></button>
                                                        </form>
                                                        
                                                        <form role=\"form\" action='' method='post'>
                                                            <input type='submit' class=\"btn btn-danger\" style='background: red;' name='favoriet' value='Voeg toe aan favoriete producten'>
                                                            <input type='hidden' class=\"btn btn-success\" name='idProduct' value='" . $row['idProduct'] . "'/>
                                                        </form>
                                                        
                                                        <br><br><br>
                                                    </div>
                                                ";
                                }
                            }
                        } else {
                            echo "Geen accessoires";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </body>
    </html>

    <?php

}
?>