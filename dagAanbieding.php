<?php
require_once("/classes/ProductClass.php");
require_once("/classes/SessionClass.php");
require_once("/classes/LoginClass.php");

$current_time = date('H:i');
// $current_time = "13:10";
$beginDagProduct = "11:00";
$endDagProduct = "16:20";
$nu = DateTime::createFromFormat('H:i', $current_time);
$begin = DateTime::createFromFormat('H:i', $beginDagProduct);
$eind = DateTime::createFromFormat('H:i', $endDagProduct);




$resultDagProduct = ProductClass::get_Product_Van_De_Dag();

if ($resultDagProduct->num_rows > 0) {

    while ($row = $resultDagProduct->fetch_assoc()) {

        if ($nu >= $begin && $nu <= $eind){
            echo "<div class=\"col-md-12\"><h2>Product van de Dag</h2></div>";
            echo "Het product is met deze korting beschikbaar tot 1 uur 's middags. (Zolang de voorraad strekt)";
            if ($row["beschikbaar"]) {
                echo "
                                            <br><div style='height: 1000px; margin-bottom: -20px;' class=\"col-md-3\">
                                                        <img style='height: 400px' src=\"images/" . $row["foto"] . "\" class=\"img-responsive\">
                                                        <h3>" . $row["naam"] . "</h3>
                                                        <p class=\"videos\"><strike>" . $row["prijs"] . " euro</strike> " . $row["prijsDagProduct"] . " euro</p>
                                                       
                                                        <p class=\"videos\">" . $row["beschrijving"] . "</p>
            
                                                        <a href='index.php?content=productPagina&idProduct=" . $row["idProduct"] . "'>
                                                        <button type=\"button\" class=\"btn btn-info\">Meer Informatie</button></a>
                                                        
                                                        
                                                         <form role = \"form\" action='' method='post'>
                                                         <b>Aantal:     </b><input type='number' name='amount' max='" . $row["aantalBeschikbaar"] . "'/>
                                                        <input type='hidden' name='idProduct' value='" . $row['idProduct'] . "'>
                                                        <input type='hidden' name='idUser' value='" . $_SESSION['idUser'] . "'>
                                                        <input type='hidden' name='naam' value='" . $row['naam'] . "'>
                                                        <input type='hidden' name='prijs' value='" . $row['prijsDagProduct'] . "'>
                                                        <input type='hidden' name='dagProduct' value='" . $row['dagProduct'] . "'>
                
                                                        <button type='submit' name='submit' class='btn btn-info'>Toevoegen aan winkelmand<br></button>
                                                        </form>
                                                        
                                                        <form role=\"form\" action='' method='post'>
                                                            <input type='submit' class=\"btn btn-danger\" style='background: red;' name='favoriet' value='Voeg toe aan favoriete producten'>
                                                            <input type='hidden' class=\"btn btn-success\" name='idProduct' value='" . $row['idProduct'] . "'/>
                                                        </form>
                                                        
                                                        <br>
                                                    </div>
                                        ";
            }
        }
        else if ($nu < $begin) {
            echo "De dag product actie is van 11 uur 's ochtends tot 1 uur 's middags! Kom later of morgen terug.";
        }
    }
}
else if($current_time >= $endDagProduct) {
    ProductClass::remove_Product_Van_De_Dag();
    echo "De actie van vandaag is afgelopen, kom morgen terug voor een nieuwe kans op een mooie aanbieding!<br>";
}
else {
    echo "Op dit moment is er geen product van de dag.";

}