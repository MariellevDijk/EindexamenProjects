<?php
$rollen = array(
    "klant",
    "admin"
);
require_once("./security.php");
?>

<?php

if (isset($_POST['removeItemCart'])) {
    echo "<h3 style='text-align: center;' >Item is uit de winkelmand verwijderd.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    header("refresh:4;url=index.php?content=klantHomepage");
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

            th {
                min-width: 500px;
            }
        </style>
    </head>
    <body>
    <div class="section">
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-md-12"><h2>Winkelmand</h2></div>
                    <!-- <Wijzigingsopdracht> -->
                    <div class="col-md-12"><h3>Druk altijd op refresh winkelmandje voor u verder gaat met
                            bestllen.</h3></div>
                    <!-- </Wijzigingsopdracht> -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li><a href="index.php?content=klantHomepage">Winkelmand</a></li>
                            <li><a href="index.php?content=mijnBestellingen">Mijn bestellingen</a></li>
                            <li><a href="index.php?content=reserveringen">Reserveringen</a></li>
                            <li><a href="index.php?content=klachtIndienen">Klacht indienen</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                    <?php
                    require_once("classes/LoginClass.php");
                    require_once("classes/VerkoopClass.php");
                    require_once("classes/SessionClass.php");

                    $artikelen = ProductClass::selecteer_alle_winkelmand_items($_SESSION['idUser']);

                    if ($artikelen->num_rows > 0) {
                        while ($row = $artikelen->fetch_assoc()) {
                            print_r($row);
                            echo "

                        
                                
                        <table class=\"table table - responsive\">
                            <thead>
                            <tr>
                                <th>
                                        Naam:
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
                                        " . $row["prijs"] . "
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

                        echo "
                        <table class=\"table table - responsive\">
                            <thead>
                            <tr>
                                
                                <th>
                                <form role=\"form\" action='' method='post'>
                                <input type='hidden' name='klantid' value='" . $_SESSION['idUser'] . "'/>
                                <input type='hidden' name='idProduct' value='" . $row['idProduct'] . "'/>
                                <input type='hidden' name='titel' value='" . $row['naam'] . "'/>
                        <input type='submit' class='btn btn - info' name='refreshwinkelmandje' value='Refresh winkelmandje'>
                        </form>
                                
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

                    } else {


                        echo "
                                <form role=\"form\" action='' method='post'>
                                <input type='hidden' name='klantid' value='" . $_SESSION['idUser'] . "'/>
                        <input type='submit' class='btn btn - info' name='refreshwinkelmandje' value='Refresh winkelmandje'>
                        </form>";
                        // <input type='hidden' name='idProduct' value='" . $row['idProduct'] . "'/>
                        //   <input type='hidden' name='titel' value='" . $row['titel'] . "'/>
                        //<input type='hidden' name='prijs' value='" . $row['prijs'] . "'/>
                    }

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