<h1 class="search_sort"><a href="index.php?content=meestVerkocht">Meest verkochte producten</a></h1>
    <?php
        require_once("classes/VerkoopClass.php");
        require_once("classes/SessionClass.php");

        $result = VerkoopClass::get_most_popular_products();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row["beschikbaar"]) {
                    echo " <div style='height: 800px;' class=\"col-md-3\">
           <h4 class=\"videos\"> Aantal keer verkocht: " . $row["aantalVerkocht"] . "</h4>
           <img style='height: 400px' src=\"images/" . $row["foto"] . "\" class=\"img-responsive\">
           <h3>" . $row["naam"] . "</h3>
           <p class=\"videos\">" . $row["beschrijving"] . "</p>

           <a href='index.php?content=productPagina&idProduct=" . $row["idProduct"] . "'><button type=\"button\" class=\"btn btn-primary\">Meer Informatie</button></a>

           <br><br><br></div>
         ";
                }
            }
        } else {
            echo "0 results";
        }
    ?>