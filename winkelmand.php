<?php
$rollen = array(
    "klant",
    "admin",
    "verkoopleidster"
);
require_once("./security.php");
?>

<?php

if (isset($_POST['removeItemCart'])) {
    echo "<h3 style='text-align: center;' >Item is uit de winkelmand verwijderd.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    header("refresh:4;url=index.php?content=winkelmand");
    require_once("./classes/VerkoopClass.php");
    VerkoopClass::remove_item_winkelmand($_POST);

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
        <link href="style.css" rel="stylesheet" type="text/css">
        <style>
            .header {
                font-size: 24px;
                padding: 20px;
            }
            .emptyBasket {
                margin-left: 20px;
            }
        </style>
    </head>
    <body>
    <div class="section">
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-md-12"><h2>Winkelmand</h2></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                    <?php
                    require_once("classes/LoginClass.php");
                    require_once("classes/VerkoopClass.php");
                    require_once("classes/SessionClass.php");

                    $artikelen = ProductClass::selecteer_alle_winkelmand_items($_SESSION['idUser']);
                    $dagProduct = VerkoopClass::dagProductAanwezig();


                    if ($artikelen->num_rows > 0) {
                        while ($row = $artikelen->fetch_assoc()) {
                            $checkDagProduct = ProductClass::check_if_product_van_de_dag($row['idProductWm']);
                            if ($checkDagProduct->num_rows > 0) {
                                $isDagProduct = true;
                                $rowDagProduct = $checkDagProduct->fetch_assoc();
                                $row['totaalPrijs'] = $rowDagProduct['prijsDagProduct'] * $row['aantalWm'];
                            }
                            else {
                                $isDagProduct = false;
                            }
                            // print_r($row);
                            echo "

                        
                                
                        <table class=\"table table - responsive\">
                            <thead>
                            <tr>
                                <th>
                                        Naam:
                                </th>
                                <th>
                                        Aantal
                                </th>
                                <th>
                                        Prijs:
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                        " . $row["naam"] . "
                                </td>
                                <td>
                                        " . $row["aantalWm"] . "
                                </td>
                                <td>
                                        " . $row['totaalPrijs'] . "
                                </td>
                                <td>
                                        <form role=\"form\" action='' method='post'>
                                            <input type='submit' class=\"btn btn-info\" name='removeItemCart' value='Verwijder Item'>
                                            <input type='hidden' class=\"btn btn-info\" name='idWinkelmand' value='" . $row['idWinkelmand'] . "'/>
                                        </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                            ";
                        }
                        if(!$dagProduct->num_rows > 0) {
                            echo "
                        <table class=\"table table - responsive\">
                            <thead>
                            <tr>
                                
                                <th>
                             
                                
                                        <form role=\"form\" action='index.php?content=betalen' method='post'>
                               <input type='hidden' name='klantid' value='" . $_SESSION['idUser'] . "'/>
                                <input type='hidden' name='idProduct' value='" . $row['idProduct'] . "'/>
                                <input type='hidden' name='titel' value='" . $row['naam'] . "'/>
                                <input type='submit' class='btn btn - info' name='betalen' value='betalen'>
                                        </form>
                                </th>
                            </tr>
                            </tbody>
                        </table>
                            ";
                        } else if ($artikelen->num_rows < 3){
                            echo "Om het product van de dat te mogen bestellen moet u minimaal 2 andere producten erbij bestellen";
                        } else {
                            echo "
                        <table class=\"table table - responsive\">
                            <thead>
                            <tr>
                                
                                <th>
                             
                                
                                        <form role=\"form\" action='index.php?content=betalen' method='post'>
                               <input type='hidden' name='klantid' value='" . $_SESSION['idUser'] . "'/>
                                <input type='hidden' name='idProduct' value='" . $row['idProduct'] . "'/>
                                <input type='hidden' name='titel' value='" . $row['naam'] . "'/>
                                <input type='submit' class='btn btn - info' name='betalen' value='betalen'>
                                        </form>
                                </th>
                            </tr>
                            </tbody>
                        </table>
                            ";
                        }

                    } else {
                        echo "<div class='emptyBasket'>Uw winkelmandje is leeg.</div>";
                    }
                    echo "<h1>Alle eerdere bestellingen</h1>";
                    $result = VerkoopClass::get_all_orders();
                    foreach ($result as $opgehaaldeOrders) {
                        $result2 = VerkoopClass::get_regels_by_order($opgehaaldeOrders);
                        echo "
                            <table class=\"table table-responsive\">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Bestellingsnummer:
                                                </th>
                                                <th>
                                                    Datum
                                                </th>
                                                <th>
                                                    Totaalprijs:
                                                </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                        " . $opgehaaldeOrders["idOrder"] . "
                                                </td>
                                                <td>
                                                        " . $opgehaaldeOrders["orderdatum"] . "
                                                </td>
                                                <td>
                                                        " . $opgehaaldeOrders["totaalPrijs"] . "
                                                </td>
                                            </tr>
                                        </tbody>
                                        
                            </table>
                                ";
                        foreach ($result2 as $opgehaaldeOrderregels) {
                            echo "<table class=\"table table-responsive\" style='margin-left: 25px;'>
                                        <thead>
                                            <tr>
                                                <th>
                                                    Productnummer:
                                                </th>
                                                <th>
                                                    Productnaam:
                                                </th>
                                                <th>
                                                    Prijs per stuk
                                                </th>
                                                <th>
                                                    Aantal
                                                </th>
                                                <th>
                                                    Totaalprijs:
                                                </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                        " . $opgehaaldeOrderregels["idProduct"] . "
                                                </td>
                                                <td>
                                                        " . $opgehaaldeOrderregels["naam"] . "
                                                </td>
                                                <td>
                                                        " . $opgehaaldeOrderregels["prijs"] . "
                                                </td>
                                                <td>
                                                        " . $opgehaaldeOrderregels["aantal"] . "
                                                </td>
                                                <td>
                                                        " . $opgehaaldeOrderregels["prijsOr"] . "
                                                </td>
                                            </tr>
                                        </tbody>
                                        
                            </table>";
                        }
                        echo "<hr style='border-bottom: 1px solid black; width: 100%;'>";
                    }

                    ////                        if ($result->num_rows > 0) {
                    ////                            while ($row = $result->fetch_assoc()) {
                    //                                print_r($row);
                    //                                echo $row2['idOrder'];
                    //                                echo "
                    //                                    <h1>Alle eerdere bestellingen</h1>
                    //                            <table class=\"table table - responsive\">
                    //                                <thead>
                    //                                <tr>
                    //                                    <th>
                    //                                        Bestelling:
                    //                                    </th>
                    //                                    <th>
                    //                                        Prijs per stuk:
                    //                                    </th>
                    //                                    <th>
                    //                                        Prijs per stuk:
                    //                                    </th>
                    //                                    <th>
                    //                                        Prijs per stuk:
                    //                                    </th>
                    //
                    //
                    //                                </tr>
                    //                                </thead>
                    //                                <tbody>
                    //                                <tr>
                    //                                    <td>
                    //                                            " . $row["idVideo"] . "
                    //                                    </td>
                    //                                    <td>
                    //                                            " . $row["prijs"] . "
                    //                                    </td>
                    //                                </tr>
                    //                                </tbody>
                    //                            </table>
                    //                                ";
                    ////                            }
                    ////                        } else {
                    ////                            echo "Geen resultaten<br><br><br><br><br><br><br><br><br><br><br>";
                    ////                        }

                    ?>
                    <br><br><br><br><br><br>
                </div>
            </div>

        </div>
    </div>
    </body>
    </html>
    <?php

}
?>