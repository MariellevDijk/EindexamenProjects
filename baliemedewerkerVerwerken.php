<?php
$userrole = array("admin", "baliemedewerker");
require_once("./security.php");
?>

<?php
if (isset($_POST['update'])) {
    echo "<h3 style='text-align: center;' >Film is beschikbaar <gezet></gezet> aan database.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    header("refresh:10;url=index.php?content=baliemedewerkerHomepage");
    require_once("./classes/BalieMedewerkerClass.php");
    BalieMedewerkerClass::update_aantal_beschikbaar($_POST);
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
                min-width: 300px;
            }
        </style>
    </head>
    <body>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12"><h2>Baliemedewerker Pagina</h2></div>
            </div>
            <row class="row">
                <h3>Video</h3>
                <form role="form" action='' method='post'>
                    <div class="form-group">
                        <label for="id">VideoId</label>
                        <input type="text" class="form-control" name="idVideo" placeholder="Voer videoid in.">
                    </div>

                    <button type="submit" name="update" class="btn btn-primary">Update</button>

                </form>
                <br>
            </row>
    <?php
}