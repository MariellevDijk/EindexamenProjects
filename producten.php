<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <link href="Videos.css" rel="stylesheet" type="text/css">
    <style>
        .header {
            font-size: 24px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12"><h2>Producten</h2><br></div>
            <div class="section ">
                <div class="container">
                    <div class="row">
                        <?php
                        require_once("classes/LoginClass.php");
                        require_once("classes/SessionClass.php");
                        $result = ProductClass::get_available_products();
                        // <Wijzigingsopdracht>

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                if ($row["beschikbaar"]) {
                                    echo "
                                                    <div style='height: 650px;' class=\"col-md-3\">
                                                        <img style='height: 400px' src=\"images/" . $row["foto"] . "\" class=\"img-responsive\">
                                                        <h3>" . $row["naam"] . "</h3>
                                                        <p class=\"videos\">" . $row["beschrijving"] . "</p>
            
                                                        <a href='index.php?content=productPagina&idProduct=" . $row["idProduct"] . "'>
                                                        <button type=\"button\" class=\"btn btn-primary\">Meer Informatie</button></a>
                                                        <br><br><br>
                                                    </div>
                                                ";
                                }
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
                        <!-- </Wijzigingsopdracht> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<!--&" . $row["titel"] . "-->