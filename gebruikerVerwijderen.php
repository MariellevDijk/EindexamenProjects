<?php
$userrole = array("admin", "eigenaar");
require_once("./security.php");
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
            min-width: 300px;
        }
    </style>
</head>
<body>
<div class="section">
    <div class="container">

        <?php

        require_once("classes/LoginClass.php");
        if (isset($_POST['removeUser'])) {
            include('connect_db.php');

            $sql = "DELETE FROM	`login` WHERE `idKlant` = " . $_POST['idKlant'] . " ";


            //echo $sql;
            $database->fire_query($sql);
            //$result = mysqli_query($connection, $sql);

            echo "<h3 style='text-align: center;' >Uw wijzigingen zijn verwerkt.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
            header("refresh:4;url=index.php?content=adminHomepage");

        } else {
        ?>
        <div class="row">
            <div class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12"><h2>Gebruiker verwijderen</h2></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li><a href="index.php?content=adminHomepage">Homepage</a></li>
                                <li><a href="index.php?content=videoToevoegen">Video's Toevoegen</a></li>
                                <li><a href="index.php?content=videosBeheren">Video's beheren</a></li>
                                <li><a href="index.php?content=verwijderFilm">Video's verwijderen</a></li>
                                <li><a href="index.php?content=beschikbaarMaken">Video's beschikbaar maken</a></li>
                                <li><a href="index.php?content=rolWijzigen">Gebruikerrol veranderen</a></li>
                                <li><a href="index.php?content=blokkeren">Gebruiker blokkeren</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <?php
                    require_once("classes/LoginClass.php");
                    require_once("classes/HireClass.php");
                    require_once("classes/SessionClass.php");

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    // <Wijzigingsopdracht>
                    $dbname = "Eindexamenopdracht";
                    // </Wijzigingsopdracht>

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }


                    $sql = "SELECT * FROM `login`";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                            echo "
                        <table class=\"table table - responsive\">
                            <thead>
                            <tr>
                                <th>
                                        Naam:
                                </th>
                                <th>
                                        E-mail:
                                </th>
                                <th>
                                        Rol:
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                        " . $row["naam"] . "
                                </td>
                                <td>
                                        " . $row['email'] . "
                                </td>
                                <td>
                                        " . $row['userrole'] . "
                                </td>
                                <td>
                                        <form role=\"form\" action='' method='post'>
                                            <input type='submit' class=\"btn btn-info\" name='removeUser' value='Verwijder Gebruiker'>
                                            <input type='hidden' class=\"btn btn-info\" name='idKlant' value='" . $row['idKlant'] . "'/>
                                        </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                            ";
                        }
                    } else {
                        echo "Geen resultaten<br><br><br><br><br><br><br>";
                    }
                    $conn->close();
                    ?>

                    <br><br>
                </div>
            </div>
            <?php

            }
            ?>
            </row>
        </div>
    </div>

</body>
</html>