<?php
require_once('MySqlDatabaseClass.php');
require_once("LoginClass.php");
require_once("SessionClass.php");

class GenreClass
{
    //Fields
    private $idGenre;
    private $genre;
    
    public function getIdGenre(){ return $this->idGenre; }
    public function getGenre(){ return $this->genre; }

    //setters
    public function setIdGenre($value){ $this->idGenre = $value;}
    public function setGenre($value){ $this->genre = $value;}

    public function __construct(){  }

    //Methods


    public static function insert_genre_into_database($genre)
    {
        global $database;

        $sql = "SELECT idGenre FROM genre ORDER BY idGenre DESC LIMIT 1";
        $result = $database->fire_query($sql);
        while ($row = $result->fetch_assoc()) {
            $lastGenreID = ($row['idGenre'] + 1);
        }

        $query = "INSERT INTO `Genre` (`idGenre`, `Genre`) 
                      VALUES ($lastGenreID, '" .$genre. "')";
        //echo $query;

        //echo "<br>";
        $database->fire_query($query);
        $last_id = mysqli_insert_id($database->getDb_connection());
    }

}

?>