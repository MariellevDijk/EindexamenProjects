<?php
$rollen = array("klant", "admin");
require_once("./security.php");
?>

<?php
if (isset($_POST['reserveer'])) {

    require_once("./classes/ReserveClass.php");
    if (!ReserveClass::check_if_reservering_exists($_POST)) {
        echo "<h3 style='text-align: center;' >Item toegevoegd aan reserveringen.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
        header("refresh:4;url=index.php?content=reserveringen");

        ReserveClass::insert_reserveringitem_database($_POST);
    } else {
        echo "<h3 style='text-align: center;' >U heeft deze video al gereserveerd.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
        header("refresh:4;url=index.php?content=reserveringen");
    }

} else {
    if (isset($_POST['submit'])) {

        echo "<h3 style='text-align: center;' >Item toegevoegd aan winkelmand.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
        header("refresh:4;url=index.php?content=klantHomepage");
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
                  rel="stylesheet" type="text/css">
            <link href="videoPagina.css" rel="stylesheet" type="text/css">
            <style>
                .header {
                    padding: 20px;
                }
            </style>
        </head>
        <body>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12"><h2>Productdetailpagina</h2><br><br></div>
                </div>
                <div class="row">
                    <?php
                    require_once("classes/LoginClass.php");
                    require_once("classes/SessionClass.php");

                    $idProduct = $_GET['idProduct'];
                    $result = ProductClass::get_product_detail($idProduct);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "
                            <div class=\"container\">
                                <div class=\"row\">
                                    <div class=\"col-md-4\">
                                        <img style='height: 400px' src=\"images/" . $row["foto"] . "\" class=\"img-responsive\">
                                    </div>
                                    <div class=\"col-md-6\">
                                        <h3>" . $row["naam"] . "</h3>
                                        
                                                            </p><br><b>Beschrijving: </b>
                                                            " . $row["beschrijving"] . "<br><br>";
                            if ($row["aantal"] > 0) {
                                echo "<b>Aantal beschikbaar: </b>" . $row["aantal"] . "<br><br>";
                            } else {
                                echo "<b>Deze video is helaas uitverkocht. Plaats een reservering om de video te kunnen huren als die weer beschikbaar is.<br><br></b>";
                            }
                            echo "
                            <b>Prijs: </b>
                            &euro; " . $row["prijs"] .
                                " </p >
                                           
                                        <p ><form role = \"form\" action='' method='post'>
                                        <input type='hidden' name='idProduct' value='" . $row['idProduct'] . "'/>
                                        <input type='hidden' name='idUser' value='" . $_SESSION['idUser'] . "'/>
                                        <input type='hidden' name='naam' value='" . $row['naam'] . "'/>
                                        <input type='hidden' name='aantal' value='" . $row['aantal'] . "'/>
                                        <input type='hidden' name='prijs' value='" . $row['prijs'] . "'/>
                                        
                                        
                                    ";
                            if ($row["aantal"] > 0) {

                                echo "
                                <button type='submit' name='submit' class='btn btn - info'>Toevoegen aan winkelmand<br></button>
                                </form>
                                </div>
                                </div>
                            </div>";

                            } else {
                                echo "
                                
                                <button type='submit' name='reserveer' class='btn btn - info'>Plaats Reservatie<br></button>
                                </form>
                                </div>
                                </div>
                            </div>";
                            }


                        }
                    } else {
                        echo "Geen resultaten<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                    }
                    ?>
                    <br><br>
                </div>
            </div>
        </div>
        </body>
        </html>
        <?php
    }
}
?>