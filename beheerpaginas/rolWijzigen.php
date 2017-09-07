<?php
$rollen = array("admin", "eigenaar");
require_once("./security.php");
?>
<html>
<body>
<div class="section">
    <div class="container">
        <?php
        require_once("classes/LoginClass.php");
        if (isset($_POST['updaterol'])) {
            include('connect_db.php');

            $sql = "UPDATE	`users` 
                     SET 		`rol`		=	'" . $_POST['rolSelect'] . "'
                     WHERE	    `idUser`			=	 " . $_POST['idUser'] . " ";

            //echo $sql;
            $database->fire_query($sql);
            //$result = mysqli_query($connection, $sql);

            echo "<h3 style='text-align: center;' >Uw wijzigingen zijn verwerkt.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
            header("refresh:4;url=index.php?content=\beheerpaginas\adminHomepage");

        } else {
        ?>
        <div class="row">
            <div class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12"><h2>Gebruikerrol Wijzigen</h2></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li><a href="index.php?content=\beheerpaginas\adminHomepage">Admin Homepage</a></li>
                                <li><a href="index.php?content=\beheerpaginas\productenToevoegen">Producten Toevoegen</a></li>
                                <li><a href="index.php?content=\beheerpaginas\productVanDeDag">Product van de dag</a></li>
                                <li><a href="index.php?content=\beheerpaginas\productenBeheren">Producten beheren</a></li>
                                <li><a href="index.php?content=\beheerpaginas\verwijderProduct">Producten verwijderen</a></li>
                                <li><a href="index.php?content=\beheerpaginas\beschikbaarMaken">Producten beschikbaar maken</a></li>
                                <li><a href="index.php?content=\beheerpaginas\meestVerkochtProductOverview">Meest Verkochte Producten Overview</a></li>
                                <li><a href="index.php?content=\beheerpaginas\rolWijzigen">Gebruikerrol veranderen</a></li>
                                <li><a href="index.php?content=\beheerpaginas\blokkeren">Gebruiker blokkeren</a></li>
                                <li><a href="index.php?content=\beheerpaginas\klachtenBekijken">Klachten Bekijken</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <?php
                    require_once("classes/LoginClass.php");
                    require_once("classes/VerkoopClass.php");
                    require_once("classes/SessionClass.php");

                    $result = LoginClass::get_all_users();

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
                                        E-mailadres:
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
                                        " . $row['emailAdres'] . "
                                </td>
                                <td>
                                        " . $row['rol'] . "
                                </td>
                                <td>
                                        <form role=\"form\" action='' method='post'>
                                            <select name='rolSelect'>
                                                <option disabled='disabled'>--- Kies een optie ---</option>
                                                <option value='2'>Klant</option>
                                                <option value='1'>Admin</option>
                                            <input type='hidden' class=\"btn btn-info\" name='idUser' value='" . $row['idUser'] . "'/>
                                            <input type='submit' class=\"btn btn-info\" name='updaterol' value='Update Rol'>
                                            
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