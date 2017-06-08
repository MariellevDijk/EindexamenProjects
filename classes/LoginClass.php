<!DOCTYPE html>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title></title>
</head>
</html>

<?php
require_once("MySqlDatabaseClass.php");
require_once("UsersClass.php");
require_once("ArtikelClass.php");

class LoginClass
{
    //Fields
    private $idKlant;
    private $naam;
    private $emailAdres;
    private $wachtwoord;
    private $adres;
    private $woonplaats;
    private $betaalwijze;
    private $rol;
    private $geactiveerd;
    private $activatiedatum;
    private $geblokkeerd;


    //Properties
    public function getIdKlant()                { return $this->idKlant; }
    public function getNaam()                   { return $this->naam; }
    public function getEmailAdres()             { return $this->emailAdres; }
    public function getWachtwoord()             { return $this->wachtwoord; }
    public function getAdres()                  { return $this->adres; }
    public function getWoonplaats()             { return $this->woonplaats; }
    public function getBetaalwijze()            { return $this->betaalwijze; }
    public function getRol()                    { return $this->rol; }
    public function getGeactiveerd()            { return $this->geactiveerd; }
    public function getActivatiedatum()         { return $this->activatiedatum; }
    public function getGeblokkeerd()            { return $this->geblokkeerd; }

    public function setIdKlant($value)          { $this->idKlant = $value; }
    public function setNaam($value)             { $this->naam = $value; }
    public function setEmailAdres($value)       { $this->emailAdres = $value; }
    public function setWachtwoord($value)       { $this->wachtwoord = $value; }
    public function setAdres($value)            { $this->adres = $value; }
    public function setWoonplaats($value)       { $this->woonplaats = $value; }
    public function setBetaalwijze($value)      { $this->betaalwijze = $value; }
    public function setRol($value)              { $this->rol = $value; }
    public function setGeactiveerd($value)      { $this->geactiveerd = $value; }
    public function setActivatiedatum($value)   { $this->activatiedatum = $value; }
    public function setGeblokkeerd($value)      { $this->geblokkeerd = $value; }

    //Constructor
    public function __construct()
    {
    }

    //Methods
    /* Hier komen de methods die de informatie in/uit de database stoppen/halen
    */
    public static function find_by_sql($query)
    {
        // Maak het $database-object vindbaar binnen deze method
        global $database;

        // Vuur de query af op de database
        $result = $database->fire_query($query);

        // Maak een array aan waarin je LoginClass-objecten instopt
        $object_array = array();

        // Doorloop alle gevonden records uit de database
        while ($row = mysqli_fetch_array($result)) {
            // Een object aan van de LoginClass (De class waarin we ons bevinden)
            $object = new LoginClass();

            // Stop de gevonden recordwaarden uit de database in de fields van een LoginClass-object
            $object->idKlant = $row['idKlant'];
            $object->naam = $row['naam'];
            $object->emailAdres = $row['emailAdres'];
            $object->wachtwoord = $row['wachtwoord'];
            $object->adres = $row['adres'];
            $object->woonplaats = $row['woonplaats'];
            $object->betaalwijze = $row['betaalwijze'];
            $object->rol = $row['rol'];
            $object->geactiveerd = $row['geactiveerd'];
            $object->activatiedatum = $row['activatiedatum'];
            $object->geblokkeerd = $row['geblokkeerd'];

            $object_array[] = $object;
        }
        return $object_array;
    }

    public static function find_login_by_email_password($emailAdres, $wachtwoord)
    {
        $query = "SELECT *
					  FROM `users`
					  WHERE `emailAdres` 	= '" . $emailAdres . "'
					  AND	`wachtwoord`	= '" . $wachtwoord . "'";

        $loginClassObjectArray = self::find_by_sql($query);
        $loginClassObject = array_shift($loginClassObjectArray);
        return $loginClassObject;
    }


    public static function insert_into_database($post)
    {
        global $database;

        date_default_timezone_set("Europe/Amsterdam");

        $datum = date('Y-m-d');
        $betaalwijze = 1;
        $rol = 1;

        $wachtwoord = MD5($post['emailAdres'] . date('Y-m-d H:i:s'));

        $query = "INSERT INTO `users` (`idKlant`,
									   `naam`,
									   `emailAdres`,
									   `wachtwoord`,
									   `adres`,
									   `woonplaats`,
									   `betaalwijze`,
									   `rol`,
									   `geactiveerd`,
									   `activatiedatum`,
									   `geblokkeerd`)
				  VALUES			 (NULL,
				  					   '" . $post['naam'] . "',
									   '" . $post['emailAdres'] . "',
									   '" . $wachtwoord . "',
									   '" . $post['adres'] . "',
									   '" . $post['woonplaats'] . "',
									   '" . $betaalwijze . "',
									   '" . $rol . "',
									   '" . '0' . "',
									   '" . $date . "',
									   '" . '0' . "')";
        // echo $query;
        $database->fire_query($query);

        $last_id = mysqli_insert_id($database->getDb_connection());

        self::send_email($last_id, $post, $wachtwoord);
    }

    public static function check_if_email_exists($emailAdres)
    {
        global $database;

        $query = "SELECT `emailAdres`
					  FROM	 `users`
					  WHERE	 `emailAdres` = '" . $emailAdres . "'";

        $result = $database->fire_query($query);

        //ternary operator
        return (mysqli_num_rows($result) > 0) ? true : false;
    }


    public static function check_if_email_password_exists($emailAdres, $wachtwoord, $geactiveerd)
    {
        global $database;

        $query = "SELECT `emailAdres`, `wachtwoord`, `activated`
					  FROM	 `users`
					  WHERE	 `emailAdres` = '" . $emailAdres . "'
					  AND	 `wachtwoord` = '" . $wachtwoord . "'";

        $result = $database->fire_query($query);

        $record = mysqli_fetch_array($result);

        return (mysqli_num_rows($result) > 0 && $record['geactiveerd'] == $geactiveerd) ? true : false;
    }

    public static function check_if_activated($emailAdres, $wachtwoord)
    {
        global $database;

        $query = "SELECT `geactiveerd`
					  FROM	 `users`
					  WHERE	 `emailAdres` = '" . $emailAdres . "'
					  AND	 `wachtwoord` = '" . $wachtwoord . "'";

        $result = $database->fire_query($query);
        $record = mysqli_fetch_array($result);

        return ($record['geactiveerd'] == '0') ? true : false;
    }

    public static function check_if_geblokkeerd($idKlant)
    {
        global $database;

        $query = "SELECT `geblokkeerd`
					  FROM	 `users`
					  WHERE	 `idKlant` = '" . $idKlant . "'";

        $result = $database->fire_query($query);
        $record = mysqli_fetch_array($result);
        return $geblokt = ($record['geblokkeerd'] == '0') ? true : false;

    }

    private static function send_email($idKlant, $post, $wachtwoord)
    {
        $to = $post['emailAdres'];
        $subject = "Activatiemail Webshop";
        $message = "Geachte heer/mevrouw " . $post['naam'] . " <br> ";

        $message .= '<style>a { color:red;}</style>';
        $message .= "Hartelijk dank voor het registreren" . "<br>";
        $message .= "Uw registratienummer is: " . $idKlant . "<br>";
        $message .= "U kunt de registratie voltooien door op de onderstaande" . "<br>";
        $message .= "activatielink te klikken:" . "<br>";

        $message .= "klik <a href='" . MAIL_PATH . "index.php?content=activate&idKlant=" . $idKlant . "&emailAdres=" . $post['emailAdres'] . "&wachtwoord=" . $wachtwoord . "'><b>Hier</b></a> om uw account te activeren" . "<br>";

        $message .= "U kunt dan vervolgens een nieuw wachtwoord instellen." . "<br>";
        $message .= "Met vriendelijke groet," . "<br>";
        $message .= "Het Webshopteam" . "<br>";

        $headers = 'From: no-reply@Webshopteam.nl' . "\r\n";
        $headers .= 'Reply-To: webmaster@Webshopteam.nl' . "\r\n";
        $headers .= 'Bcc: accountant@Webshopteam.nl' . "\r\n";
        //$headers .= "MIME-version: 1.0"."\r\n";
        //$headers .= "Content-type: text/plain; charset=iso-8859-1"."\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();


        mail($to, $subject, $message, $headers);
    }

    public static function activate_account_by_id($idKlant)
    {
        global $database;
        $query = "UPDATE `users`
					  SET `geactiveerd` = '1'
					  WHERE `idKlant` = '" . $idKlant . "'";

        $database->fire_query($query);

    }

    public static function update_password($idKlant, $wachtwoord)
    {
        global $database;
        $query = "UPDATE `users` 
					  SET	 `wachtwoord` =	'" . MD5($wachtwoord) . "'
					  WHERE	 `idKlant`		=	'" . $idKlant . "'";
        $database->fire_query($query);

    }

    public static function check_old_password($oud_wachtwoord)
    {
        $query = "SELECT *
					  FROM	 `users`
					  WHERE	 `idKlant`	=	'" . $_SESSION['idKlant'] . "'";
        $arrayLoginClassObjecten = self::find_by_sql($query);
        $loginClassObject = array_shift($arrayLoginClassObjecten);
        //var_dump($loginClassObject);
        //echo $loginClassObject->getPassword()."<br>";
        //echo MD5($old_password);
        if (!strcmp(MD5($oud_wachtwoord), $loginClassObject->getWachtwoord())) {
            return true;
        } else {
            return false;
        }
    }

    public static function update_database($post)
    {
        global $database;
        $query = "UPDATE `users` SET `naam`='" . $post['naam'] . "' where `idKlant`='" . $_SESSION['idKlant'] . "'";
        //echo"users update";
        $database->fire_query($query);
    }

    public static function find_info_by_id($idKlant)
    {
        $query = "SELECT 	*
					  FROM 		`users`
					  WHERE		`idKlant`	=	" . $idKlant;
        $object_array = self::find_by_sql($query);
        $usersclassObject = array_shift($object_array);
        //var_dump($usersclassObject); exit();
        return $usersclassObject;
    }
}

?>