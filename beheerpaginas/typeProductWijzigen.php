<?php
$rollen = array("admin", "eigenaar");
require_once("./security.php");
?>
<html>
<head>
    <style>
        th {
            max-width: 100px !important;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body>
<div class="section">
    <div class="container">
        <?php
        require_once("classes/TypeClass.php");
        if (isset($_POST['updatetype'])) {
            TypeClass::update_type('typeSelect');
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
                                <li><a href="index.php?content=\beheerpaginas\rolWijzigen">Gebruikerrol veranderen</a></li>
                                <li><a href="index.php?content=\beheerpaginas\blokkeren">Gebruiker blokkeren</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-16">
                    <?php
                    require_once("classes/TypeClass.php");
                    require_once("classes/SessionClass.php");
                    require_once("classes/ProductClass.php");

                    $result = ProductClass::get_all_products();
                    $result2 = TypeClass::get_name_type();

                    $row2 = $result2->fetch_assoc();
                    $row3 = $result3->fetch_assoc();



                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "
                                <table class=\"table table - responsive\">
                                    <thead>
                                    <tr>
                                        <th>
                                                idProduct:
                                        </th>
                                        <th>
                                                Naam Product:
                                        </th>
                                        <th>
                                                Prijs
                                        </th>
                                        <th>
                                                Type:
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                                " . $row["idProduct"] . "
                                        </td>
                                        <td>
                                                " . $row['naam'] . "
                                        </td>
                                        <td>
                                                " . $row['prijs'] . "
                                        </td>
                                        <td>
                                                " . $row2['naam'] . "
                                        </td>
                                        <td>
                                                
                                        </td>
                                        <td>
                                        <form role=\"form\" action='' method='post'>
                                                        <select name='typeSelect'>
                                                            <option disabled='disabled'>--- Kies een optie ---</option>
                                            ";

                                            echo "
                                            <input type='hidden' class=\"btn btn-info\" name='idProduct' value='" . $row['idProduct'] . "'/>
                                            <input type='submit' class=\"btn btn-info\" name='updatetype' value='Update Type'>
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