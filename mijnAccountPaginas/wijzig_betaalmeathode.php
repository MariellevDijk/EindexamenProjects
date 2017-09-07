<?php
$rollen = array("klant");
require_once("./security.php");
?>

<?php
    require_once("classes/LoginClass.php");
    require_once("classes/SessionClass.php");
            $betaalwijze = LoginClass::get_all_payment_methods();
            $result = LoginClass::get_klant_betaalmethode();
            $row2 = $result->fetch_assoc();


if (isset($_POST['changePaymentMethod'])) {
    if(!(empty($_POST['idBetaalmethode']))) {
        if ($_POST['idBetaalmethode'] == $row2['betaalwijze']) {
            echo "<h3 style='text-align: center;' >Kies een andere betaalmethode.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
            header("refresh:4;url=index.php?content=\mijnAccountPaginas\wijzig_betaalmeathode");
        } else {
            LoginClass::update_betaalmethode($_POST);
            echo "<h3 style='text-align: center;' >Uw wijzigingen zijn verwerkt.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
            header("refresh:4;url=index.php?content=\mijnAccountPaginas\wijzig_betaalmeathode");
        }
    } else {
            echo "<h3 style='text-align: center;' >Kies een betaalmethode.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
            header("refresh:4;url=index.php?content=\mijnAccountPaginas\wijzig_betaalmeathode");
    }
} else {
    ?>

    <html>
    <head>
        <link href="mijnAccountGegevens.css" rel="stylesheet" type="text/css">
        <style>
            .header {
                font-size: 24px;
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
                                <li><a href="index.php?content=\mijnAccountPaginas\mijnAccountGegevens">Gegevens Aanpassen</a></li>
                                <li><a href="index.php?content=\mijnAccountPaginas\wijzig_wachtwoord">Wachtwoord Veranderen</a></li>
                                <li><a href="index.php?content=\mijnAccountPaginas\wijzig_betaalmeathode">Wijzig betaalmethode</a></li>
                                <li><a href="index.php?content=\mijnAccountPaginas\klachtIndienen">Klacht indienen</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">


                    <div style=' margin-bottom: -20px;' class="col-md-3">
                        <?php
                            echo "Uw huidige betaalmethode is: " . $row2['naam'] . "<br>";
                        ?>
                        <br>
                        <form role=\"form\" action='' method='post'>
                            <select class="form-control" name="idBetaalmethode">
                                <option value="none" selected="selected" disabled="disabled">--- Kies een optie ---</option>
                                <?php
                                while ($row = $betaalwijze->fetch_assoc()) {

                                    echo "<option value='" . $row['idBetaalwijze'] . "'>" . $row['naam'] . "</option>";
                                }
                                ?>
                            </select>
                            <BR>
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