<?php
$rollen = array("klant");
require_once("./security.php");
?>

<?php

require_once("classes/LoginClass.php");
if (isset($_POST['changePaymentMethod'])) {
    LoginClass::update_betaalmethode($_POST);

    echo "<h3 style='text-align: center;' >Uw wijzigingen zijn verwerkt.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    header("refresh:4;url=index.php?content=mijnAccountGegevens");


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
        <link href="mijnAccountGegevens.css" rel="stylesheet" type="text/css">
        <style>
            .header {
                font-size: 24;
                padding: 20px;
            }
        </style>
    </head>
    <body>
    <div class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12"><h1>Wijzig gegevens</h1></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li><a href="index.php?content=mijnAccountGegevens">Gegevens Aanpassen</a></li>
                                <li><a href="index.php?content=wijzig_wachtwoord">Wachtwoord Veranderen</a></li>
                                <li><a href="index.php?content=wijzig_betaalmethode">Wijzig betaalmethode</a></li>
                                <li><a href="index.php?content=klachtIndienen">Klacht indienen</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    require_once("classes/LoginClass.php");
                    require_once("classes/SessionClass.php");
                            $betaalwijze = LoginClass::get_all_payment_methods();
                            $result = LoginClass::get_klant_betaalmethode();
                            $row2 = $result->fetch_assoc();
                            ?>
                    <div style=' margin-bottom: -20px;' class="col-md-3">
                        <?php
                            echo "Uw huidige betaalmethode is: " . $row2['naam'];
                        ?>
                        <form role=\"form\" action='' method='post'>
                            <select class="form-control" name="idBetaalmethode">
                                <option value="none" selected="selected" disabled="disabled">--- Kies een optie ---</option>
                                <?php
                                while ($row = $betaalwijze->fetch_assoc()) {
                                    echo "<option value='" . $row['idBetaalwijze'] . "'>" . $row['naam'] . "</option>";
                                }
                                ?>
                            </select>
                            <button type='submit' name='changePaymentMethod' class='btn btn-success'>Verander betaalmethode</button>
                        </form>

                        <br><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container"></div>
    </div>
    </body>
    </html>
    <?php
}
?>