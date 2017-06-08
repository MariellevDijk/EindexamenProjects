<?php
require_once('MySqlDatabaseClass.php');

class BalieMedewerkerClass
{
    //Fields
    private $idVideo;
    private $titel;
    private $beschrijving;
    private $genres;
    private $acteurs;
    private $fotopad;


    public function __construct()
    {
    }

    public static function update_aantal_beschikbaar($post)
    {
        // </Wijzigingsopdracht>
        date_default_timezone_set("Europe/Amsterdam");

		$date = date('Y-m-d'); 
        $datumreactie = date('Y-m-d', strtotime("+2 days"));
        global $database;
        // <Wijzigingsopdracht>
        
        //echo "123";
        
        $query = "UPDATE `video`
					  SET	 `aantalBeschikbaar` = `aantalBeschikbaar` + 1 
					  WHERE	 `idVideo`		=	'" . $_POST['idVideo'] . "'";
        // <Wijzigingsopdracht>
        $query2 = "UPDATE `reservering`
                    SET `datumVideoBeschikbaar` = '".$date."'
                    WHERE `idVideo` = '".$_POST['idVideo']."'";
        $query3 = "UPDATE `reservering`
                    SET `reactieDatumKlant` = '".$datumreactie."'
                    WHERE `idVideo` = '".$_POST['idVideo']."'";
        //  </Wijzigingsopdracht>
        // echo $query;
        // echo $query2;
        $database->fire_query($query);
        // </Wijzigingsopdracht>
        $database->fire_query($query2);
        $database->fire_query($query3);
                
        $sql1 = "Select * from video";
        $result = $database->fire_query($sql1);

        $row = $result->fetch_assoc();
        if ($row['aantalBeschikbaar'] >= 1){
            // </Wijzigingsopdracht>
            self::send_email();
            // <Wijzigingsopdracht>
        }
        // </Wijzigingsopdracht>
        

    }
    private static function send_email()
	{
		$to = "klant@mail.com";
		$subject = "Activatiemail Videotheek Maurik";
		$message = "Dear sir/madam <br> ";

		$message .= '<style>a { color:red;}</style>';
		$message .= "Your reserved video is available<br>";
		$message .= "Log in on your account to hire the video"."<br>";
		$message .= "Your reservation ends in 2 days."."<br>";
		$message .= "Greetings,"."<br>";
		$message .= "Marielle van Dijk"."<br>";

		$headers = 'From: no-reply@videotheekMaurik.nl'."\r\n";
		$headers .= 'Reply-To: webmaster@videotheekMaurik.nl'."\r\n";
		$headers .= 'Bcc: accountant@videotheekMaurik.nl'."\r\n";
		//$headers .= "MIME-version: 1.0"."\r\n";
		//$headers .= "Content-type: text/plain; charset=iso-8859-1"."\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1"."\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();



		mail( $to, $subject, $message, $headers);
	}
        
    public static function remove_item_reservering($post)
    {
        global $database;


        $query =    "DELETE FROM `reservering` WHERE `idKlant` = " . $_SESSION['idKlant'] . "
                                                    AND `idReservering` = " . $post["idReservering"]. " ";
        //echo $query;


        $database->fire_query($query);
    }

    public function getIdVideo()
    {
        return $this->idVideo;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getTitel()
    {
        return $this->titel;
    }

    public function setTitel($value)
    {
        $this->titel = $value;
    }

    //setters

    public function getBeschrijving()
    {
        return $this->beschrijving;
    }

    public function setBeschrijving($value)
    {
        $this->beschrijving = $value;
    }

    public function getGenres()
    {
        return $this->genres;
    }

    public function setGenres($value)
    {
        $this->genres = $value;
    }

    public function getActeurs()
    {
        return $this->acteurs;
    }

    public function setActeurs($value)
    {
        $this->acteurs = $value;
    }


    //Constuctor

    public function getFotopad()
    {
        return $this->fotopad;
    }

    public function setFotopad($value)
    {
        $this->fotopad = $value;
    }
}