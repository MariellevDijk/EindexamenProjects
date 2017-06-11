<?php
require_once('MySqlDatabaseClass.php');


class ProductClass
{
    //Fields
    private $idProduct;
    private $naam;
    private $beschrijving;
    private $prijs;
    private $foto;
    private $beschikbaar;
    private $aantal;

    //Properties
    //getters
    public function getIdProduct(){ return $this->idProduct; }
    public function getNaam(){ return $this->naam; }
    public function getBeschrijving(){ return $this->beschrijving; }
    public function getPrijs(){ return $this->prijs; }
    public function getFoto(){ return $this->foto; }
    public function getBeschikbaar(){ return $this->beschikbaar; }
    public function getAantal(){ return $this->aantal; }


    //setters
    public function setIdProduct($value){ $this->idProduct = $value; }
    public function setNaam($value){ $this->naam = $value; }
    public function setBeschrijving($value){ $this->beschrijving = $value; }
    public function setPrijs($value){ $this->prijs = $value; }
    public function setFoto($value){ $this->foto = $value; }
    public function setBeschikbaar($value){ $this->beschikbaar = $value; }
    public function setAantal($value){ $this->aantal = $value; }

    //Constuctor
    public function __construct() {}

    //Methods
    public static function find_by_sql($query)
    {
        // Maak het $database-object vindbaar binnen deze method
        global $database;

        // Vuur de query af op de database
        $result = $database->fire_query($query);
        // Maak een array aan waarin je ProductClass-objecten instopt
        $object_array = array();

        // Doorloop alle gevonden records uit de database
        while ($row = mysqli_fetch_array($result)) {
            // Een object aan van de ProductClass (De class waarin we ons bevinden)
            $object = new ProductClass();

            // Stop de gevonden recordwaarden uit de database in de fields van een ProductClass-object
            $object->id = $row['idProduct'];
            $object->naam = $row['naam'];
            $object->beschrijving = $row['beschrijving'];
            $object->prijs = $row['prijs'];
            $object->foto = $row['foto'];
            $object->beschikbaar = $row['beschikbaar'];
            $object->aantal = $row['aantal'];

            $object_array[] = $object;
        }
        return $object_array;
    }

    public static function find_info_by_id($idProduct)
    {
        $query = "SELECT 	*
					  FROM 		`producten`
					  WHERE		`idProduct`	=	" . $idProduct;
        $object_array = self::find_by_sql($query);
        $ProductclassObject = array_shift($object_array);

        return $ProductclassObject;
    }

    public static function insert_product_database($post)
    {
        global $database;

        $query = "INSERT INTO `product` (`idProduct`,
										   `naam`,
										   `beschrijving`,
										   `prijs`,
                                           `foto`,
                                           `beschikbaar`,
                                           `aantal`)
					  VALUES			  (NULL,
										   '" . $post['naam'] . "',
										   '" . $post['beschrijving'] . "',
										   '" . $post['prijs'] . "',
                                           '" . $post['foto'] . "',
                                           '" . '1' . "',
                                           '" . $post['aantal'] . "')";

        echo $query;

        $database->fire_query($query);
        $last_id = mysqli_insert_id($database->getDb_connection());
    }

    public static function delete_product($post)
    {
        global $database;

        $sql = "DELETE FROM `producten` WHERE `idProduct` = " . $_POST['idProduct'] . " ";

        $database->fire_query($sql);
        $last_id = mysqli_insert_id($database->getDb_connection());

    }

    public static function wijzig_gegevens_product($post)
    {
        global $database;

        $sql = "UPDATE	`producten`  SET 	`naam`		=	'" . $_POST['naam'] . "',
											`beschrijving`	= 	'" . $_POST['beschrijving'] . "',
											`prijs`	= 	'" . $_POST['prijs'] . "',
											`foto`	= 	'" . $_POST['foto'] . "',
											`beschikbaar`	= 	'" . $_POST['beschikbaar'] . "',
											`aantal`	= 	'" . $_POST['aantal'] . "'
									WHERE	`idProduct`			=	'" . $_POST['idProduct'] . "'";

//			echo $sql;

        $database->fire_query($sql);
        $last_id = mysqli_insert_id($database->getDb_connection());

    }

    public static function get_available_products () {
        global $database;

        $query = "SELECT * FROM producten where `beschikbaar` = '1'";
        $result = $database->fire_query($query);

        // echo $query;

        return $result;
    }

    public static function get_product_detail ($idProduct) {
        global $database;

        $query = "SELECT * FROM `producten` 
                                 WHERE `idProduct` = '" . $idProduct . "'";
        $result = $database->fire_query($query);

        return $result;
    }

    public static function selecteer_alle_winkelmand_items($idUser)
    {
        global $database;
        $sql = "select `idWinkelmand`, `idProductWm`, `aantalWm`,`aantalWm` * `prijs` as prijs, `naam`  from `winkelmand`
                INNER JOIN `producten` on winkelmand.idProductWm = producten.idProduct
                where `idUserWm` = " . $_SESSION['idUser'] . " ";

        $result = $database->fire_query($sql);

        return $result;
    }

    //$database->fire_query($sql);
    //$result = mysqli_query($connection, $sql);

}

?>