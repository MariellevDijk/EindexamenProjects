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
    </style>
</head>
<body>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12"><h2>Nieuwe Video's!</h2><br></div>
            <div class="section ">
                <div class="container">
                    <div class="row">
                        <?php
                        require_once("classes/LoginClass.php");
                        require_once("classes/SessionClass.php");

                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "Eindexamenopdracht";

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        // <Wijzigingsopdracht>
                        $sql = "SELECT * FROM video where `nieuw` = '1'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                if ($row["beschikbaar"]) {
                                    echo " <div style='height: 650px;' class=\"col-md-3\"><img style='height: 400px' src=\"images/" . $row["fotopad"] . "\" class=\"img-responsive\">
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
                        <!-- </Wijzigingsopdracht> -->
                    </div>
                </div>
            </div>
            <div class="col-md-12"><h2>Video's</h2><br></div>
            <div class="section ">
                <div class="container">
                    <div class="row">
                        <?php
                        require_once("classes/LoginClass.php");
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

                        $sql = "SELECT * FROM video where `nieuw` = '0'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                if ($row["beschikbaar"]) {
                                    echo " <div style='height: 650px;' class=\"col-md-3\"><img style='height: 400px' src=\"images/" . $row["fotopad"] . "\" class=\"img-responsive\">
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

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<!--&" . $row["titel"] . "-->