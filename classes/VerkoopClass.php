+<?php
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

    public function getIdWinkelmand()
    {
        return $this->idWinkelmand;
    }

    public function getIdUserWm()
    {
        return $this->idUserWm;
    }

    public function getIdProductWm()
    {
        return $this->idProductWm;
    }

    public function getAantalWm()
    {
        return $this->aantalWm;
    }

    //setters
    public function setIdWinkelmand($value)
    {
        $this->idWinkelmand = $value;
    }

    public function setIdUserWm($value)
    {
        $this->idUserWm = $value;
    }

    public function setIdProductWm($value)
    {
        $this->idProductWm = $value;
    }

    public function setAantalWm($value)
    {
        $this->aantalWm = $value;
    }

    public function __construct()
    {
    }

    //Methods
    public static function insert_winkelmanditem_database($post)
    {
        global $database;
        $query = "INSERT INTO `winkelmand` (`idWinkelmand`, `idUserWm`, `idProductWm`, `aantalWm`) 
                                    VALUES (NULL, '" . $_SESSION['idUser'] . "', '" . $post['idProductWm'] . "', " . $post['aantalWm'] . ")";
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
        $query = "DELETE FROM `winkelmand` WHERE `idUser` = " . $_SESSION['idUser'] . "
                                                    AND `idWinkelmand` = " . $post["idWinkelmand"] . " ";
        // echo $query;
        $database->fire_query($query);
    }

    public static function insert_bestelling_database($post)
    {
        global $database;
        $afleverdatum = $post['afleverdatum'];
        $date = $afleverdatum;

        $ophaaldatum = date('Y-m-d H:i', strtotime($date . ' + 7 days'));

        $titelList = null;


        $sql = "SELECT idWinkelmand, GROUP_CONCAT(titel, ', ') 
                AS titel_list 
                FROM winkelmand 
                WHERE `idUser` = " . $_SESSION['idUser'] . "
                GROUP BY idUser";
        // echo $sql;
        $result = $database->fire_query($sql);
        $row = $result->fetch_assoc();
        $titelList = $row['titel_list'];
        //echo $row['titel_list'];

        $query = "INSERT INTO `bestelling` (`idBestelling`, 
                                            `idVideo`, 
                                            `videoTitel`, 
                                            `idUser`, 
                                            `afleverdatum`, 
                                            `aflevertijd`, 
                                            `ophaaldatum`, 
                                            `ophaaltijd`, 
                                            `prijs`) 
                  VALUES                    (NULL, 
                                              " . $post['idVideo'] . ", 
                                             '" . $titelList . "', 
                                              " . $_SESSION['idUser'] . ", 
                                             '" . $post['afleverdatum'] . "', 
                                             '" . $post['aflevertijd'] . "', 
                                             '" . $ophaaldatum . "', 
                                             '" . $post['ophaaltijd'] . "', 
                                             '" . $post['prijs'] . "')";

        // echo $query . "<br>";

        $ophaaldatum = date('Y-m-d', strtotime($date . ' + 7 days'));

        $database->fire_query($query);
        $last_id = mysqli_insert_id($database->getDb_connection());
        self::lower_amount_Artikelen($post);
        self::send_email($post, $last_id, $ophaaldatum);
        self::increase_amount_hired($post);
        self::update_beschikbaar();
    }

    public static function lower_amount_Artikelen($post)
    {
        global $database;
        $idVideo = $_POST['idVideo'];

        $query = "UPDATE `video`
					  SET `aantalBeschikbaar` = `aantalBeschikbaar` - 1
					  WHERE `idVideo` = '" . $idVideo . "'";
        //echo $query;
        $database->fire_query($query);

    }

    public static function increase_amount_hired($post)
    {
        global $database;
        $idVideo = $_POST['idVideo'];

        $query = "UPDATE `video`
					  SET `aantalVerhuurd` = `aantalVerhuurd` + 1
					  WHERE `idVideo` = '" . $idVideo . "'";
        //echo $query;
        $database->fire_query($query);

    }

    private static function send_email($post, $idBestelling, $ophaaldatum)
    {
        $to = $_SESSION['emailAdres'];
        $subject = "Bevestigingsmail Bestelling Webshop AutoTrader";
        $message = "Geachte heer/mevrouw<br>";

        $message .= "Hartelijk dank voor het bestellen bij Webshop AutoTrader" . "<br>";

        $message .= "Uw bestellingsnummer is: " . $idBestelling . "<br>";
        $message .= "U kunt in uw account de bestelling verlengen als u de video langer wilt huren." . "<br>";
        $message .= "Als u de video niet verlengt maar de ophaaldatum is verlopen, kost dit u iedere dag 10% van uw prijs extra. " . "<br>";

        $message .= "De video wordt bij u gebracht op: " . $post['afleverdatum'] . " om " . $post['aflevertijd'] . ".<br>";
        $message .= "De video wordt bij u gehaald op: " . $ophaaldatum . " om " . $post['ophaaltijd'] . ".<br><br>";

        $message .= "Wij wensen u veel kijkplezier.<br>";
        $message .= "Met vriendelijke groet," . "<br>";
        $message .= "Marielle van Dijk" . "<br>";

        $headers = 'From: no-reply@WebshopAutoTrader.nl' . "\r\n";
        $headers .= 'Reply-To: webmaster@webshopAutoTrader.nl' . "\r\n";
        $headers .= 'Bcc: accountant@webshopAutoTrader.nl' . "\r\n";
        //$headers .= "MIME-version: 1.0"."\r\n";
        //$headers .= "Content-type: text/plain; charset=iso-8859-1"."\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();


        mail($to, $subject, $message, $headers);
    }

    public static function check_if_date_exists($afleverdatum)
    {
        global $database;

        $query = "SELECT `afleverdatum`
					  FROM	 `bestelling`
					  WHERE	 `afleverdatum` = '" . $afleverdatum . "'";

        $result = $database->fire_query($query);
        //echo $query;
        return (mysqli_num_rows($result) > 3) ? true : false;
    }

    //Constuctor

    public static function update_beschikbaar()
    {
        global $database;

        $query = "UPDATE `video` SET `beschikbaar`= 0 WHERE `aantalVerhuurd` = 30";

        $database->fire_query($query);
    }

    public static function check_if_deleveryDate_deleveryTime_exists($post)
    {
        global $database;

        $query = "SELECT `afleverdatum`,`aflevertijd`
					  FROM	 `bestelling`
					  WHERE	 `afleverdatum` = '" . $post['afleverdatum'] . "'
					  AND    `aflevertijd` = '" . $post['aflevertijd'] . "'";

        $result = $database->fire_query($query);
        //echo $query;
        return (mysqli_num_rows($result) > 0) ? true : false;
    }

    public static function check_if_collectDate_collectTime_exists($post)
    {
        global $database;

        $afleverdatum = $post['afleverdatum'];
        $date = $afleverdatum;

        $ophaaldatum = date('Y-m-d H:i', strtotime($date . ' + 7 days'));

        $query = "SELECT `ophaaldatum`,`ophaaltijd`
					  FROM	 `bestelling`
					  WHERE	 `ophaaldatum` = '" . $ophaaldatum . "'
					  AND    `ophaaltijd` = '" . $post['ophaaltijd'] . "'";

        $result = $database->fire_query($query);
        //echo $query;
        return (mysqli_num_rows($result) > 0) ? true : false;
    }

    public static function bestelling_verlengen_day($post)
    {
        global $database;

        $ophaaldatum = null;
        $prijs = null;

        $sql = "SELECT * FROM bestelling WHERE `idBestelling` = " . $_POST['idVanBestelling'] . " ";

        $result = $database->fire_query($sql);
        if ($row = $result->fetch_assoc()) {
            $ophaaldatum = $row['ophaaldatum'];
            $prijs = $row['prijs'];
        }

        $verlengdeDatum = date('Y-m-d', strtotime($ophaaldatum . ' + 1 day'));
        $verhoogdePrijs = ($prijs . ' + ' . round(($prijs * 0.10), 2));

        $query = "UPDATE `bestelling` 
                  SET `ophaaldatum` = '" . $verlengdeDatum . "',
                      `prijs` = " . $verhoogdePrijs . " 
                  WHERE `idBestelling` = " . $_POST['idVanBestelling'] . " ";

        $result = $database->fire_query($query);
        //echo $query;
    }

    public static function bestelling_verlengen_week($post)
    {
        global $database;

        $ophaaldatum = null;
        $prijs = null;

        $sql = "SELECT * FROM bestelling WHERE `idBestelling` = " . $_POST['idVanBestelling'] . " ";

        $result = $database->fire_query($sql);
        if ($row = $result->fetch_assoc()) {
            $ophaaldatum = $row['ophaaldatum'];
            $prijs = $row['prijs'];
        }

        $verlengdeDatum = date('Y-m-d', strtotime($ophaaldatum . ' + 7 day'));
        $verhoogdePrijs = ($prijs . ' + ' . round(($prijs * 0.70), 2));

        $query = "UPDATE `bestelling` 
                  SET `ophaaldatum` = '" . $verlengdeDatum . "',
                      `prijs` = " . $verhoogdePrijs . " 
                  WHERE `idBestelling` = " . $_POST['idVanBestelling'] . " ";

        $result = $database->fire_query($query);
        //echo $query;

    }

    public static function send_memory_email_3_weeks_after_mail($email)
    {
        $to = $email;
        $subject = "Bevestigingsmail Bestelling webshop AutoTrader";
        $message = "Geachte heer/mevrouw<br>";

        $message .= "Uw bestelling is al 3 weken verlopen, uw acount zal nu geblokeerd worden.<br>";

        $message .= "Met vriendelijke groet," . "<br>";
        $message .= "Marielle van Dijk" . "<br>";

        $headers = 'From: no-reply@webshopAutoTrader.nl' . "\r\n";
        $headers .= 'Reply-To: webmaster@webshopAutoTrader.nl' . "\r\n";
        $headers .= 'Bcc: accountant@webshopAutoTrader.nl' . "\r\n";
        //$headers .= "MIME-version: 1.0"."\r\n";
        //$headers .= "Content-type: text/plain; charset=iso-8859-1"."\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();


        mail($to, $subject, $message, $headers);
    }

    public static function blokeer_user_na_3_weken($id)
    {
        global $database;
        $sql = "UPDATE	`login` 
                     SET 		`geblokkeerd`		=	1
                     WHERE	    `idUser`			=	 " . $id . " ";
        $database->fire_query($sql);
    }
}
?>