<?php
$rollen = array("klant", "admin");

require_once("./security.php");
require_once("classes/LoginClass.php");
require_once("classes/VerkoopClass.php");
require_once("classes/SessionClass.php");
require_once("classes/ProductClass.php");
$allItemsInBasket = ProductClass::selecteer_alle_winkelmand_items();

$totalePrijs = VerkoopClass::selecteer_totaal_prijs_winkelmand_items();
if ($totalePrijs["totaalPrijs"] > '50') {
    $priceTotal = $totalePrijs["totaalPrijs"];
} else {
    $priceTotal = ($totalePrijs["totaalPrijs"] + 2);
}

?>

<?php
if (isset($_POST['pay'])) {
    require_once("./classes/VerkoopClass.php");
    echo "<h3 style='text-align: center;' >Uw gegevens zijn verwerkt. Bedankt voor uw bestelling</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    VerkoopClass::clear_winkelmand($_POST);
    VerkoopClass::insert_bestelling_database($_POST, $priceTotal);

    if ($allItemsInBasket->num_rows > 0) {
        while ($row = $allItemsInBasket->fetch_assoc()) {
            VerkoopClass::insert_order_in_orderregel($row, $priceTotal);
             // print_r($row);
//            echo "<br>";
        }
    }
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

                body {
                    width: 100%;
                }

                th td {
                    min-width: 80%;
                    max-width: 100%;
                }
            </style>
        </head>
        <body>
        <div class="section">
            <div class="container">
                <h2>Betalen</h2>
                <br><br>
                <div class="row">
                    <div class="col-md-12">
                        <h3>Uw bestelling</h3>
                        <form role=\"form\" action='' method='post'>
                            <?php
                            if ($allItemsInBasket->num_rows > 0) {
                                while ($row = $allItemsInBasket->fetch_assoc()) {
                                    // print_r($row);
                                    // echo $allItemsInBasket;
                                    echo "
                                <table class=\"table table - responsive\">
                                    <thead>
                                    <tr>
                                        <th>
                                                Titel:
                                        </th>
                                        <th>
                                                Prijs per stuk:
                                        </th>
                                        <th>
                                                Aantal:
                                        </th>
                                        <th>
                                                Totaalprijs:
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                                " . $row["naam"] . "
                                        </td>
                                        <td>
                                                &euro; " . $row["prijs"] . "
                                        </td>
                                        <td>
                                                " . $row["aantalWm"] . "
                                        </td>
                                        <td>
                                                &euro; " . $row["totaalPrijs"] . "
                                        </td>                                
                                    </tr>
                                    </tbody>
                                </table>";
                                }
                            } else {
                                echo "Geen resultaten<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                            }
                            echo "<br><br>Tijdens het registratieproces heeft u de betaalmethode geselecteerd, deze kan altijd veranderd worden in 'Mijn account'";

                            switch ($_SESSION['betaalwijze']) {
                                case '1': // iDeal
                                    $betaalWijzeKlant = "iDeal";
                                    break;
                                case '2': // Mastercard
                                    $betaalWijzeKlant = "MasterCard";
                                    break;
                                case '3': // Paypal
                                    $betaalWijzeKlant = "Paypal";
                                    break;
                                case '4': // Overboeking
                                    $betaalWijzeKlant = "Overboeking";
                                    break;
                            }
                            if ($totalePrijs["totaalPrijs"] < 50) {
                                echo "    <table class=\"table table - responsive\">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                                Verzendkosten:
                                                        </th>
                                                        <th>
                                                                 &euro; 2.-
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                </table>";
                                $totalePrijs['totaalPrijs'] = ($totalePrijs['totaalPrijs'] + 2);
                            }
                            echo "<br><br> U heeft deze betaalmethode geselecteerd: " . $betaalWijzeKlant;
                            echo "
        <table class=\"table table - responsive\">
                                    <thead>
                                    <tr>
                                        <th>
                                                Totaal:
                                        </th>
                                        <th>
                                                 &euro; " . $totalePrijs['totaalPrijs'] . "
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                                
                                <input type='hidden' name='prijs' value='" . $row['totaalPrijs'] . "'/>
                                ";


                            if ($allItemsInBasket->num_rows > 0) {
                                while ($row = $allItemsInBasket->fetch_assoc()) {
                                    echo "
                                        <input type='hidden' name='idUser' value='" . $_SESSION['idUser'] . "'/>
                                        <input type='hidden' name='idProduct' value='" . $row['idProduct'] . "'/>
                                ";

                                }
                            }

                            echo "
        
                                <input type='submit' class='btn btn-info' name='pay' value='Betalen'>";

                            ?>

                        </form>
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