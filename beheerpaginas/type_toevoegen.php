<?php
$rollen = array("admin", "eigenaar");
require_once("./security.php");
?>

<?php

require_once("./classes/TypeClass.php");
if (isset($_POST['submit-Type'])) {

    TypeClass::create_type($_POST);
    echo "<h3 style='text-align: center;' >U heeft een nieuw type toegevoegd.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    header("refresh:4;url=index.php?content=\beheerpaginas\adminHomepage");
} else {
    ?>
    <html>
    <body>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12"><h2>Type toevoegen</h2></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
<!--                                <li><a href="index.php?content=\beheerpaginas\adminHomepage">Video's beheren</a></li>-->
<!--                                <li><a href="index.php?content=rolWijzigen">Gebruikerrol veranderen</a></li>-->
<!--                                <li><a href="index.php?content=blokkeren">Gebruiker Blokkeren</a></li>-->
<!--
<!--                                <li><a href="index.php?content=verwijderFilm">Film verwijderen</a></li>-->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 text-left">
                            <form role="form" action="" method="post">
                                <div class="form-group">
                                    <input class="form-control" name="naam" placeholder="Type" type="text">
                                    <input class="form-control" name="beschrijving" placeholder="Beschrijving" type="text">
                                </div>

                                <button type="submit" class="btn btn-primary" name="submit-Type">Verzend</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br>
    </body>
    </html>

    <?php
}
?>