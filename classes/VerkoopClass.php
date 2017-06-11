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
    //getters

    public function getIdWinkelmand(){ return $this->idWinkelmand; }
    public function getIdUserWm(){ return $this->idUserWm; }
    public function getIdProductWm(){ return $this->idProductWm; }
    public function getAantalWm(){ return $this->aantalWm; }

    //setters
    public function setIdWinkelmand($value){ $this->idWinkelmand = $value; }
    public function setIdUserWm($value){ $this->idUserWm = $value; }
    public function setIdProductWm($value){ $this->idProductWm = $value; }
    public function setAantalWm($value){ $this->aantalWm = $value; }

    public function __construct(){}

    //Methods
    public static function insert_winkelmanditem_database($post)
    {
        $idUserWm = $_POST['idUser'];
        $idProductWm = $_POST['idProduct'];
        $idAantalWm = $_POST['amount'];
        global $database;
        $query = "INSERT INTO `winkelmand` (`idWinkelmand`, `idUserWm`, `idProductWm`, `aantalWm`) 
                                    VALUES (NULL, '" . $idUserWm . "', '" . $idProductWm . "', " . $idAantalWm . ")";
//            echo $query;
        $database->fire_query($query);
        $last_id = mysqli_insert_id($database->getDb_connection());
    }

    public static function clear_winkelmand()
    {
        global $database;
        $query = "DELETE FROM `winkelmand` WHERE `idUserWm` = " . $_SESSION['idUser'] . " ";
//            echo $query;
        $database->fire_query($query);
    }

    public static function remove_item_winkelmand($post)
    {
        global $database;
        $query = "DELETE FROM `winkelmand` WHERE `idUserWm` = " . $_SESSION['idUser'] . "
                                                    AND `idWinkelmand` = " . $post["idWinkelmand"] . " ";
        // echo $query;
        $database->fire_query($query);
    }

    public static function insert_bestelling_database($post, $priceTotal)
    {
        global $database;

        $query = "INSERT INTO `order` (`idOrder`, 
                                            `idUser`, 
                                            `totaalPrijs`) 
                  VALUES                    (NULL, 
                                            '" . $_SESSION['idUser'] . "', 
                                            '" . $priceTotal . "')";

        // echo $query . "<br>";

        $database->fire_query($query);

        self::send_email();
//        self::lower_amount_Artikelen($post);
//        self::send_email($post, $last_id, $ophaaldatum);
//        self::increase_amount_hired($post);
//        self::update_beschikbaar();
    }

    public static function insert_order_in_orderregel($row, $priceTotal)
    {
        global $database;
//        idOrderregel, idProduct, idOrder, prijs, aantal;
        $sql = "SELECT `idOrder` from `order` WHERE `idUser` = '" . $_SESSION['idUser']. "' AND `totaalPrijs` = '" . $priceTotal . "'";
        // echo $sql;
        $idOrderVoorRegels = $database->fire_query($sql);

        // echo $idOrderVoorRegel . "<<<";
        $idOrderVoorRegel = $idOrderVoorRegels->fetch_assoc();

        $query = "INSERT INTO `orderregel` (`idOrderregel`, 
                                    `idProduct`,
                                     `idOrder`,
                                    `prijs`,
                                    `aantal`) 
          VALUES                    (NULL, 
                                    '" . $row['idProductWm'] . "',
                                    '" . $idOrderVoorRegel['idOrder'] . "', 
                                    '" . $row['totaalPrijs'] . "', 
                                    '" . $row['aantalWm'] . "')";

        // echo $query . "<br>";
        $database->fire_query($query);
        self::lower_amount_Artikelen($row);
        self::increase_amount_hired($row);
    }

    public static function lower_amount_Artikelen($row)
    {
        global $database;

        $query = "UPDATE `producten`
					  SET `aantal` = `aantal` - '" . $row['aantalWm'] . "'
					  WHERE `idProduct` = '" . $row['idProductWm'] . "'";
        //echo $query;
        $database->fire_query($query);

    }

    private static function send_email()
    {
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
        //$headers .= "MIME-version: 1.0"."\r\n";
        //$headers .= "Content-type: text/plain; charset=iso-8859-1"."\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();


        mail($to, $subject, $message, $headers);
    }

    public static function increase_amount_hired($row)
    {
        global $database;

        $query = "UPDATE `producten` SET `aantalVerkocht` =  `aantalVerkocht` + '" .$row['aantalWm'] . "' WHERE `idProduct` = '" . $row['idProductWm'] ."'";

        // echo $query;

        $database->fire_query($query);
    }

    public static function get_all_orders()
    {
        global $database;

        $sql = "SELECT * FROM `order` WHERE `idUser` = " . $_SESSION['idUser'] . " ";

        $database->fire_query($sql);
    }

    public static function get_total_price_with_shipping()
    {
        global $database;
        $sql = "select `idWinkelmand`, `idProductWm`, `prijs`, `aantalWm`,`aantalWm` * `prijs` as totaalPrijs, `naam`  from `winkelmand`
                INNER JOIN `producten` on winkelmand.idProductWm = producten.idProduct
                where `idUserWm` = " . $_SESSION['idUser'] . " ";

        // echo $sql;

        $priceWithShipping = $database->fire_query($sql);

        return $priceWithShipping;

    }

    public static function selecteer_totaal_prijs_winkelmand_items(){
        global $database;
        $sql =  "select sum(`aantalWm` * `prijs`) as totaalPrijs  from `winkelmand`
                INNER JOIN `producten` on winkelmand.idProductWm = producten.idProduct
                where `idUserWm` = " . $_SESSION['idUser'] . " ";

        $result = $database->fire_query($sql);

        $totalePrijs = $result->fetch_assoc();

        return $totalePrijs;
    }
}
?>