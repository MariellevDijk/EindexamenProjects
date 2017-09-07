<?php
$rollen = array("klant", "admin");
require_once("./security.php");
?>

<?php
    if (isset($_POST['submit'])) {

        echo "<h3 style='text-align: center;' >Meest verkocht Item toegevoegd aan winkelmand.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
        header("refresh:4;url=index.php?content=favorieteProducten");
        require_once("./classes/VerkoopClass.php");
        VerkoopClass::insert_most_sold_in_winkelmand($_POST);
    } else {
        ?>
        <html>
        <body>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12"><h2>Productdetailpagina</h2><br><br></div>
                </div>
                <div class="row">
                    <?php
                    require_once("classes/LoginClass.php");
                    require_once("classes/SessionClass.php");

                    $idProduct = $_GET['idProduct'];
                    $result = ProductClass::get_product_detail($idProduct);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // var_dump($row);
                            echo "
                            <div class=\"container\">
                                <div class=\"row\">
                                    <div class=\"col-md-4\">
                                        <img style='height: 400px' src=\"images/" . $row["foto"] . "\" class=\"img-responsive\">
                                    </div>
                                    <div class=\"col-md-6\">
                                        <h3>" . $row["naam"] . "</h3>
                                        
                                                            </p><br><b>Beschrijving: </b>
                                                            " . $row["beschrijving"] . "<br><br>
                            
                                    <b>Prijs: </b>
                                        &euro; " . $row["prijs"] . "</p >
                                    
                                    <p><form role = \"form\" action='' method='post'>
                                        <b>Aantal:     </b><input type='number' required placeholder='1' name='amount' max='" . $row["aantalBeschikbaar"] . "'/><br><br><br>
                                        <input type='hidden' name='idProduct' value='" . $row['idProduct'] . "'/>
                                        <input type='hidden' name='idUser' value='" . $_SESSION['idUser'] . "'/>
                                        <input type='hidden' name='naam' value='" . $row['naam'] . "'/>
                                        <input type='hidden' name='prijs' value='" . $row['prijs'] . "'/>
                                        <input type='hidden' name='dagProduct' value='" . $row['dagProduct'] . "'>
                                        
                                        
                                    ";
                            }
                            if ($row["aantalBeschikbaar"] < 1) {
                                echo "
                                <button type='submit' name='submit' class='btn btn - info'>Toevoegen aan winkelmand<br></button>
                                </form>
                                </div>
                                </div>
                            </div>";

                            } else {
                                echo "Dit product is momenteel niet beschikbaar";
                            }


                        }
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