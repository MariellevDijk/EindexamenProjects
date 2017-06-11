<?php
    $rollen = array("klant");
    require_once("./security.php");
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
    <link href="style.css" rel="stylesheet" type="text/css">
    <style>
        .header {
            font-size: 24px;
            padding: 20px;
        }

        th {
            min-width: 250px;
        }
    </style>
</head>
    <body>
        <div class="section">
            <div class="container">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12"><h2>Mijn Bestellingen</h2></div>
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
                        require_once("classes/VerkoopClass.php");

                        $result = VerkoopClass::get_all_orders();

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "
                            <table class=\"table table - responsive\">
                                <thead>
                                <tr>
                                    <th>
                                        Product:
                                    </th>
                                    <th>
                                        Prijs per stuk:
                                    </th>
                                    <th>
                                        Prijs per stuk:
                                    </th>
                                    <th>
                                        Prijs per stuk:
                                    </th>
                                    
                                    
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                            " . $row["idVideo"] . "
                                    </td>
                                    <td>
                                            " . $row["prijs"] . "
                                    </td>
                                    <td>
                                            <form role=\"form\" action='' method='post'>
                                                <input type='hidden' class=\"btn btn-info\" name='idVanBestelling' value='" . $row['idBestelling'] . "'/>
                                                <input type='submit' class=\"btn btn-info\" name='addAday' value='Verleng Bestelling met een Dag'>
                                            </form><BR>
                                            <form role=\"form\" action='' method='post'>
                                                <input type='hidden' class=\"btn btn-info\" name='idVanBestelling' value='" . $row['idBestelling'] . "'/>
                                                <input type='submit' class=\"btn btn-info\" name='addAWeek' value='Verleng Bestelling met een Week'>
                                            </form>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                                ";
                            }
                        } else {
                            echo "Geen resultaten<br><br><br><br><br><br><br><br><br><br><br>";
                        }
                        $conn->close();
                        ?>
                        <br><br><br><br><br><br>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
