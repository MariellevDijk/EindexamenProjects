<?php
    require_once('MySqlDatabaseClass.php');
    require_once("LoginClass.php");
    require_once("SessionClass.php");

    class VerkoopClass
    {
        //Fields
        private $idWinkelmand;
        private $idUserWm;
        private $idProductWm;
        private $aantalWm;

        //Properties
        public function getIdWinkelmand()       { return $this->idWinkelmand; }
        public function getIdUserWm()           { return $this->idUserWm; }
        public function getIdProductWm()        { return $this->idProductWm; }
        public function getAantalWm()           { return $this->aantalWm; }

        public function setIdWinkelmand($value) { $this->idWinkelmand = $value; }
        public function setIdUserWm($value)     { $this->idUserWm = $value; }
        public function setIdProductWm($value)  { $this->idProductWm = $value; }
        public function setAantalWm($value)     { $this->aantalWm = $value; }

        // Constructor
        public function __construct()
        {
        }

        //Methods
        public static function insert_winkelmanditem_database($post)
        {
            // Deze functie insert het winkelmand item die van de product pagina komt, in de winkelmand tabel zodat de klant zijn eigen winkelmand bijhoud.
            $idUserWm = $_POST['idUser'];
            $idProductWm = $_POST['idProduct'];
            $idAantalWm = $_POST['amount'];

            global $database;

            $query = "INSERT INTO `winkelmand` (`idWinkelmand`, `idUserWm`, `idProductWm`, `aantalWm`, `dagProductWm`) 
                                        VALUES (NULL, '" . $idUserWm . "', '" . $idProductWm . "', " . $idAantalWm . ", " . $_POST['dagProduct'] . ")";

            $database->fire_query($query);

            $last_id = mysqli_insert_id($database->getDb_connection());
        }
        public static function clear_winkelmand()
        {
            // Deze functie haalt de winkelmand leeg nadat de order in de database zit
            global $database;

            $query = "DELETE FROM `winkelmand` WHERE `idUserWm` = " . $_SESSION['idUser'] . " ";

            $database->fire_query($query);
        }
        public static function remove_item_winkelmand($post)
        {
            // Deze functie haalt een item uit de winkelmand als de klant hem niet meer wilt kopen
            global $database;

            $query = "DELETE FROM `winkelmand` WHERE `idUserWm` = " . $_SESSION['idUser'] . "
                                                        AND `idWinkelmand` = " . $post["idWinkelmand"] . " ";

            $database->fire_query($query);
        }
        public static function insert_bestelling_database($post, $priceTotal)
        {
            // Deze functie insert de bestelling vanuit de winkelmand in de tabel met orders.
            global $database;

            $datetime = date('Y-m-d');

            $query = "INSERT INTO `order` (`idOrder`, 
                                                `idUser`, 
                                                `totaalPrijs`,
                                                `orderdatum`) 
                      VALUES                    (NULL, 
                                                '" . $_SESSION['idUser'] . "', 
                                                '" . $priceTotal . "',
                                                '" . $datetime . "')";

            $database->fire_query($query);

            self::send_email();
        }
        public static function insert_order_in_orderregel($row, $priceTotal)
        {
            // Voor elk verkochte afzonderlijke product in een order komt er een nieuwe orderregel. Hier zit ook mijn extra opdracht in.
            global $database;

            $sql = "SELECT `idOrder` from `order` WHERE `idUser` = '" . $_SESSION['idUser']. "' AND `totaalPrijs` = '" . $priceTotal . "'";

            $idOrderVoorRegels = $database->fire_query($sql);
            $idOrderVoorRegel = $idOrderVoorRegels->fetch_assoc();


            $queryMeestVerkocht = "SELECT `fromMeestVerkocht` FROM `winkelmand` WHERE `idProductWm` ='" . $row['idProductWm'] . "'";

            $resultMeestVerkocht = $database->fire_query($queryMeestVerkocht);

            $resultsMeestVerkocht = $resultMeestVerkocht->fetch_assoc();

            if ($resultsMeestVerkocht['fromMeestVerkocht'] == '1') {
//                echo ">>>>>123<<<<<";
                $query = "INSERT INTO `orderregel` (`idOrderregel`, 
                                        `idProductOr`,
                                         `idOrder`,
                                        `prijsOr`,
                                        `aantal`,
                                        `verkochtViaMeestVerkocht`) 
              VALUES                    (NULL, 
                                        '" . $row['idProductWm'] . "',
                                        '" . $idOrderVoorRegel['idOrder'] . "', 
                                        '" . $row['totaalPrijs'] . "', 
                                        '" . $row['aantalWm'] . "',
                                        '" . '1' ."')";
                //echo $query;
            } else {
//                echo ">>>> ABC <<<<<";
                $query = "INSERT INTO `orderregel` (`idOrderregel`, 
                                        `idProductOr`,
                                         `idOrder`,
                                        `prijsOr`,
                                        `aantal`) 
              VALUES                    (NULL, 
                                        '" . $row['idProductWm'] . "',
                                        '" . $idOrderVoorRegel['idOrder'] . "', 
                                        '" . $row['totaalPrijs'] . "', 
                                        '" . $row['aantalWm'] . "')";
                // echo $query;
            }
            // echo $query;
            $database->fire_query($query);

            self::lower_amount_Artikelen($row);
            self::increase_amount_sold($row);
        }
        public static function lower_amount_Artikelen($row)
        {
            // Nadat er een product verkocht is moet er natuurlijk ook het aantal wat beschikbaar is omlaag gehaald worden.
            global $database;

            $query = "UPDATE `producten`
                          SET `aantalBeschikbaar` = `aantalBeschikbaar` - '" . $row['aantalWm'] . "'
                          WHERE `idProduct` = '" . $row['idProductWm'] . "'";
            //echo $query;
            $database->fire_query($query);

        }
        private static function send_email()
        {
            // Een Email naar de klant zenden wegens de aankoop bij de webshop
            $to = $_SESSION['emailAdres'];

            $subject = "Bevestigingsmail Bestelling Webshop AutoTrader";

            $message = "Geachte heer/mevrouw<br>";
            $message .= "Hartelijk dank voor het bestellen bij Webshop AutoTrader" . "<br>";
            $message .= "Wij wensen u veel plezier met uw aankoop.<br>";
            $message .= "Met vriendelijke groet," . "<br>";
            $message .= "Team AutoTrader" . "<br>";

            $headers = 'From: no-reply@WebshopAutoTrader.nl' . "\r\n";
            $headers .= 'Reply-To: webmaster@webshopAutoTrader.nl' . "\r\n";
            $headers .= 'Bcc: accountant@webshopAutoTrader.nl' . "\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
            $headers .= 'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);
        }
        public static function increase_amount_sold($row)
        {
            // Haal het aantal verkocht omhoog
            global $database;

            $query = "UPDATE `producten` SET `aantalVerkocht` =  `aantalVerkocht` + '" .$row['aantalWm'] . "' WHERE `idProduct` = '" . $row['idProductWm'] ."'";

            $database->fire_query($query);
        }
        public static function get_all_orders()
        {
            // Alle orders binnenhalen
            global $database;

            $sql = "SELECT * FROM `order` WHERE `idUser` = " . $_SESSION['idUser'] . " ";

            $result = $database->fire_query($sql);

            return $result;
        }
        public static function get_regels_by_order($opgehaaldeOrders)
        {
            // Alle regels bij alle orders binnenhalen
            global $database;

            $sql = "SELECT * FROM `orderregel` INNER JOIN `producten` on orderregel.idProduct = producten.idProduct WHERE `idOrder` = " . $opgehaaldeOrders["idOrder"] . " ";

            $result2 = $database->fire_query($sql);

            foreach ($result2 as $opgehaaldeOrders2) {
                return $result2;
            }
        }
        public static function get_total_price_with_shipping()
        {
            // Totale prijs met verzendkosten ophalen
            global $database;
            $sql = "select `idWinkelmand`, `idProductWm`, `prijs`, `aantalWm`,`aantalWm` * `prijs` as totaalPrijs, `naam`  from `winkelmand`
                    INNER JOIN `producten` on winkelmand.idProductWm = producten.idProduct
                    where `idUserWm` = " . $_SESSION['idUser'] . " ";

            $priceWithShipping = $database->fire_query($sql);

            return $priceWithShipping;
        }
        public static function selecteer_totaal_prijs_winkelmand_items()
        {
            // Totale prijs van alle winkelmand items ophalen
            global $database;

            $sql =  "select sum(`aantalWm` * `prijs`) as totaalPrijs  from `winkelmand`
                    INNER JOIN `producten` on winkelmand.idProductWm = producten.idProduct
                    where `idUserWm` = " . $_SESSION['idUser'] . " ";

            $result = $database->fire_query($sql);

            $totalePrijs = $result->fetch_assoc();

            return $totalePrijs;
        }
        public static function get_most_popular_products()
        {
            // Haal de meest populaire producten op ( Extra opdracht )
            global $database;

            $query = "SELECT * FROM producten 
                    ORDER BY aantalVerkocht DESC LIMIT 4";

            $result = $database->fire_query($query);

            return $result;
        }
        public static function get_most_popular_products_extra_page()
        {
            // Haal de meest populaire producten op ( Extra opdracht )
            global $database;

            $query = "SELECT * FROM producten 
                    ORDER BY aantalVerkocht DESC LIMIT 10";

            $result = $database->fire_query($query);

            return $result;
        }
        public static function dagProductAanwezig()
        {
            // Checken of er een dag product aanwezig is in de winkelmand. ( Wijzigingsopdracht )
            global $database;

            $query = "SELECT * FROM `winkelmand` where `dagProductWm` = 1 AND `idUserWm` =  ".$_SESSION['idUser']." ";
            // echo $query;
            $result = $database->fire_query($query);

            return $result;
        }
        public static function selecteer_totaal_prijs_niet_dagproduct_winkelmand_items()
        {
            // Het selecteren van de totaal prijs van alle niet dagproducten in het winkelmandje ( Wijzigingsopdracht )
            global $database;

            $sql =  "select `dagProduct`, sum(`aantalWm` * `prijs`) as totaalPrijs  from `winkelmand`
                    INNER JOIN `producten` on winkelmand.idProductWm = producten.idProduct
                    where `idUserWm` = " . $_SESSION['idUser'] . " AND `dagProduct` = 0 ";

            $result = $database->fire_query($sql);

            $totalePrijs = $result->fetch_assoc();

            return $totalePrijs;
        }
        public static function selecteer_totaal_prijs_dagproduct_winkelmand_items()
        {
            // Totaal prijs van de dagproducten in de winkelmand
            global $database;

            $sql =  "select sum(`aantalWm` * (`prijs` * 0.5)) as totaalPrijs, `dagProduct`  from `winkelmand`
                    INNER JOIN `producten` on winkelmand.idProductWm = producten.idProduct
                    where `idUserWm` = " . $_SESSION['idUser'] . " AND `dagProduct` = 1 ";

            $result = $database->fire_query($sql);

            $totalePrijs = $result->fetch_assoc();

            return $totalePrijs;
        }

        // Extra Opdracht
        public static function insert_most_sold_in_winkelmand($post)
        {
            // Insert een product van de homepagina van Meest verkocht in het winkelmandje
            $idUserWm = $_POST['idUser'];
            $idProductWm = $_POST['idProduct'];
            $idAantalWm = $_POST['amount'];

            global $database;

            $query = "INSERT INTO `winkelmand` (`idWinkelmand`, `idUserWm`, `idProductWm`, `aantalWm`, `fromMeestVerkocht`) 
                                        VALUES (NULL, '" . $idUserWm . "', '" . $idProductWm . "', " . $idAantalWm . ", '1')";

            $database->fire_query($query);

            $last_id = mysqli_insert_id($database->getDb_connection());
        }
        public static function meestVerkochteProducten()
        {
            // Haal alle verkochte meestverkochte producten op voor een overzicht voor de admin
            global $database;

            $query = "SELECT *, producten.naam FROM `producten` INNER JOIN `orderregel` on `idProductOr` = `idProduct` WHERE `verkochtViaMeestVerkocht` = '1'";

            $result = $database->fire_query($query);

            return $result;
        }

    }
?>