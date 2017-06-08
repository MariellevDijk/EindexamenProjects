<?php
$userrole = array("klant", "bezorger", "admin", "baliemedewerker", "eigenaar");
require_once("./security.php");
?>

<?php

require_once("./classes/GenreClass.php");
if (isset($_POST['submit-Genre'])) {

    GenreClass::insert_genre_into_database($_POST['genre']);
    echo "<h3 style='text-align: center;' >U heeft een nieuw genre toegevoegd.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    header("refresh:4;url=index.php?content=adminHomepage");
} else {
    ?>
    <html>
    <head>
        <?php
            require_once("./Head.php");
        ?>
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
            <div class="row">
                <div class="col-md-12"><h2>Genre toevoegen</h2></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li><a href="index.php?content=adminHomepage">Video's beheren</a></li>
                                <li><a href="index.php?content=rolWijzigen">Gebruikerrol veranderen</a></li>
                                <li><a href="index.php?content=blokkeren">Gebruiker Blokkeren</a></li>
                                <li><a href="index.php?content=gebruikerVerwijderen">Gebruiker verwijderen</a></li>
                                <li><a href="index.php?content=verwijderFilm">Film verwijderen</a></li>
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
                                <div class="form-group"><input class="form-control" name="genre" placeholder="Genre"
                                                               type="text"></div>

                                <button type="submit" class="btn btn-primary" name="submit-Genre">Verzend</button>

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