<?php
$rollen = array(
    "klant",
    "admin"
);
require_once("./security.php");
?>

<?php

if (isset($_POST['favoriet'])) {
    echo "<h3 style='text-align: center;' >Item is verwijderd uit uw favorieten.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    header("refresh:4;url=index.php?content=favorieteProducten");
    require_once("./classes/FavorietClass.php");
    FavorietClass::remove_from_favorites($_POST);

} else if (isset($_POST['submit'])) {

        echo "<h3 style='text-align: center;' >Item toegevoegd aan winkelmand.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
        header("refresh:4;url=index.php?content=favorieteProducten");
        require_once("./classes/VerkoopClass.php");
        VerkoopClass::insert_winkelmanditem_database($_POST);
    } else {
        ?>
        <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <script type="text/javascript"
                    src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
            <script type="text/javascript"
                    src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
            <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css"
                  rel="stylesheet"
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
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li><a href="index.php?content=favorieteProducten">Favorieten</a></li>
                                <li><a href="index.php?content=wijzig_betaalmethode">Wijzig betaalmethode</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12"><h2>Favorieten</h2><br></div>
                    <div class="section ">
                        <div class="container">
                            <div class="row">
                                <?php
                                require_once("classes/FavorietClass.php");
                                require_once("classes/SessionClass.php");
                                $result = FavorietClass::get_favoriete_producten();
                                // <Wijzigingsopdracht>

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        if ($row["beschikbaar"]) {
                                            echo "
                                                    <div style='height: 800px; margin-bottom: -20px;' class=\"col-md-3\">
                                                        <img style='height: 400px' src=\"images/" . $row["foto"] . "\" class=\"img-responsive\">
                                                        <h3>" . $row["naam"] . "</h3>
                                                        <p class=\"videos\">" . $row["beschrijving"] . "</p>
            
                                                        <a href='index.php?content=productPagina&idProduct=" . $row["idProduct"] . "'>
                                                        <button type=\"button\" class=\"btn btn-primary\">Meer Informatie</button></a>
                                                        
                                                         <form role = \"form\" action='' method='post'>
                                                         <b>Aantal:     </b><input type='number' name='amount' max='" . $row["aantalBeschikbaar"] . "'/>
                                                        <input type='hidden' name='idProduct' value='" . $row['idProduct'] . "'>
                                                        <input type='hidden' name='idUser' value='" . $_SESSION['idUser'] . "'>
                                                        <input type='hidden' name='naam' value='" . $row['naam'] . "'>
                                                        <input type='hidden' name='prijs' value='" . $row['prijs'] . "'>
                
                                                        <button type='submit' name='submit' class='btn btn - info'>Toevoegen aan winkelmand<br></button>
                                                        </form>
                                                        
                                                        <form role=\"form\" action='' method='post'>
                                                            <input type='submit' class=\"btn btn-info\" name='favoriet' value='Verwijder uit favoriete producten'>
                                                            <input type='hidden' class=\"btn btn-info\" name='idProduct' value='" . $row['idProduct'] . "'/>
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
                                <!-- </Wijzigingsopdracht> -->
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