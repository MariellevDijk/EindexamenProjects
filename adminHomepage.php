<?php
$rollen = array("admin");
require_once("./security.php");

require_once("./classes/HireClass.php");
    if (isset($_POST['mail'])) {

//        HireClass::send_memory_email_day_before();
//        HireClass::send_memory_email_3_days_after();
//        HireClass::send_memory_email_3_weeks_after();
//        HireClass::set_video_not_new();
//        echo "<h3 style='text-align: center;' >Herinnering mails worden verstuurd.</h3><br><br><br><br><br><br><br><br>         <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
//        header("refresh:4;url=index.php?content=adminHomepage");
    } else {
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <link href="style.css" rel="stylesheet" type="text/css">
    <style>
        .header {
            font-size: 24px;
            padding: 20px;
        }

        th {
            min-width: 300px;
        }
    </style>
</head>
<body>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12"><h2>Admin Homepage</h2></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ul class="list-group">
                    <li class="list-group-item"><a href="index.php?content=adminHomepage">Admin Homepage</a></li>
                    <li class="list-group-item"><a href="index.php?content=videoToevoegen">Video's Toevoegen</a></li>
                    <li class="list-group-item"><a href="index.php?content=videosBeheren">Video's beheren</a></li>
                    <li class="list-group-item"><a href="index.php?content=verwijderFilm">Video's verwijderen</a></li>
                    <!-- <Wijzigingsopdracht>  -->
                    <li class="list-group-item"><a href="index.php?content=nieuweFilms">Nieuwe video's</a></li>
                    <!-- </Wijzigingsopdracht> -->
                    <li class="list-group-item"><a href="index.php?content=beschikbaarMaken">Video's beschikbaar
                            maken</a></li>
                    <li class="list-group-item"><a href="index.php?content=rolWijzigen">Gebruikerrol veranderen</a></li>
                    <li class="list-group-item"><a href="index.php?content=blokkeren">Gebruiker blokkeren</a></li>
                    <li class="list-group-item"><a href="index.php?content=gebruikerVerwijderen">Gebruiker
                            verwijderen</a></li>
                </ul>
                <br><br>
                <div class="row">
                <div class="col-md-12"><h3>Stuur herinnering mails</h3></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form role=\"form\" action='' method='post'>
                        <input type='submit' class="btn btn-info" name='mail' value='Stuur herrinering mails'>
                    </form>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12"><h3>Meest gewilde video's</h3></div>
        </div>
        <div class="row">
            <?php
            require_once("classes/LoginClass.php");
            require_once("classes/HireClass.php");
            require_once("classes/SessionClass.php");

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "examendatabase";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }


            $sql = "SELECT * FROM video WHERE `datumToegevoegd` >= (DATE_SUB(CURDATE(), INTERVAL 4 MONTH)) ORDER BY aantalverhuurd DESC LIMIT 4";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row["beschikbaar"]) {
                        echo " <div style='height: 650px;' class=\"col-md-3\">
               <h4 class=\"videos\"> Aantal keer verhuurd: " . $row["aantalverhuurd"] . "</h4>
               <img style='height: 400px' src=\"images/" . $row["fotopad"] . "\" class=\"img-responsive\">
               <h3>" . $row["titel"] . "</h3>
               <p class=\"videos\">" . $row["beschrijving"] . "</p>

               <a href='index.php?content=videoPagina&idVideo=" . $row["idVideo"] . "'><button type=\"button\" class=\"btn btn-primary\">Meer Informatie</button></a>

               <br><br><br></div>
             ";
                    }
                }
            } else {
                echo "0 results";
            }

            $conn->close();
            ?>

            <br><br>
        </div>

    </div>
</div>
</body>
</html>
<?php
    }
?>