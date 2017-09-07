<?php
$rollen = array("admin", "eigenaar");
require_once("./security.php");
?>

<?php
require_once("classes/VerkoopClass.php");
require_once("classes/SessionClass.php");

if (isset($_POST['create'])) {
    echo "<h3 style='text-align: center;' >Product is toegevoegd aan database.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    header("refresh:4;url=index.php?content=adminHomepage");
    require_once("./classes/ProductClass.php");
    ProductClass::insert_product_database($_POST);
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
        <div class="col-md-12"><h2>Product Toevoegen</h2></div>
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
                <li><a href="index.php?content=\beheerpaginas\gebruikerVerwijderen">Gebruiker verwijderen</a></li>
            </ul>
        </div>
    </div>
    <form role='form' action='' method='post'>
        <div class='form-group'>
            <label for='naam'>Titel:</label>
            <input type='text' class='form-control' name='naam' placeholder='Voer titel in.'>
        </div>
        <div class='form-group'>
            <label for='beschrijving'>Beschrijving:</label>
            <input type='text' class='form-control' name='beschrijving' placeholder='Voer beschrijving in.'>
        </div>
        <div class='form-group'>
            <label for='prijs'>Prijs:</label>
            <input type='text' class='form-control' name='prijs' placeholder='Voer prijs in.'>
        </div>
        <div class='form-group'>
            <label for='aantalBeschikbaar'>Aantal Beschikbaar:</label>
            <input type='text' class='form-control' name='aantalBeschikbaar' placeholder='Voer aantal beschikbaar in.'>
        </div>
        <div class='form-group'>
            <label for='isAccessoire'>Is accessoire:</label>
            <select class="form-control" name="isAccessoire">
                <option value="none" selected="selected" disabled="disabled">--- Kies een optie ---</option>
                    <option value="1">Is een accessoire</option>
                    <option value="0">Is geen accessoire</option>
            </select>
        </div>
        <?php
        require_once("classes/TypeClass.php");
        $type = TypeClass::get_all_type();
        ?>
        <div class='form-group'>
            <label for='type'>Type:</label>
            <select class="form-control" name="type">
                <option value="none" selected="selected" disabled="disabled">--- Kies een optie ---</option>
                <?php
                    while ($row = $type->fetch_assoc()) {
                        echo "<option value='" . $row['idType'] . "'>" . $row['naam'] . "</option>";
                    }
                ?>
            </select>
        </div>

        <div class='form-group'>
            <label for='foto'>Fotopad:</label>
            <input type='text' class='form-control' name='foto' placeholder='Voer fotopad in.'>
        </div>

        <button type='submit' name='create' class='btn btn-danger'>Submit</button>

    </form>
    <br>
    <?php
}
?>