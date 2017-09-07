<?php
require_once("MySqlDatabaseClass.php");

class TypeClass
{
    //Fields
    private $idType;
    private $naam;
    private $beschrijving;

    public function getIdType()                     { return $this->idType; }
    public function getNaam()                       { return $this->naam; }
    public function getBeschrijving()               { return $this->beschrijving; }


    public function setIdType($idType)             { $this->idType = $idType; }
    public function setNaam($naam)                  { $this->naam = $naam; }
    public function setBeschrijving($beschrijving)  { $this->beschrijving = $beschrijving; }

    //Constructor
    public function __construct()
    {
    }

    //Methods
    public static function find_by_sql($query)
    {
        global $database;

        $result = $database->fire_query($query);

        $object_array = array();

        while ($row = mysqli_fetch_array($result)) {
            $object = new TypeClass();

            $object->idType = $row['idType'];
            $object->naam = $row['naam'];
            $object->beschrijving = $row['beschrijving'];


            $object_array[] = $object;
        }
        return $object_array;
    }
    public static function get_all_type()
    {
        global $database;

        $query = "SELECT * FROM `type`";


        return $database->fire_query($query);
    }
    public static function create_type($post)
    {
        global $database;

        $query = "INSERT INTO `type` (`idType`,
                                           `naam`,
                                           `beschrijving`)
                      VALUES			 (NULL,
                                           '" . $post['naam'] . "',
                                           '" . $post['beschrijving'] . "')";

        $database->fire_query($query);
    }
    public static function update_type($post)
    {
        global $database;

        $query = "UPDATE	`producten` 
                     SET 		`type`		=	'" . $_POST['type_select'] . "'
                     WHERE	    `idProduct`			=	 " . $_POST['idProduct'] . " ";

        $database->fire_query($query);
    }
    public static function get_name_type()
    {
        global $database;

        $query = "SELECT type.naam FROM `type` 
                  INNER JOIN `producten` on `idType` = `type`
                  WHERE `idType` = `type`";

        $result = $database->fire_query($query);

        return $result;
    }
}

?>