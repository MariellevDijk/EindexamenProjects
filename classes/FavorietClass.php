<?php
require_once("MySqlDatabaseClass.php");

    class FavorietClass
    {
        //Fields
        private $idFavorieten;
        private $idProduct;
        private $idUser;

        public function getIdFavorieten()                     { return $this->idFavorieten; }
        public function setIdFavoriet($idFavorieten)          { $this->idFavorieten = $idFavorieten; }
        public function getIdProduct()                      { return $this->idProduct; }
        public function setIdProduct($idProduct)            { $this->idProduct = $idProduct; }
        public function getIdUser()                         { return $this->idUser; }
        public function setIdUser($idUser)                  { $this->idUser = $idUser; }

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
                $object = new FavorietClass();

                $object->idfavorieten = $row['idfavorieten'];
                $object->idProduct = $row['idProduct'];
                $object->idUser = $row['idUser'];


                $object_array[] = $object;
            }
            return $object_array;
        }
        public static function check_if_exists($post)
        {
            global $database;

            $query = "SELECT *
                          FROM	 `favorieten`
                          WHERE	 `idProduct` = '" . $post['idProduct'] . "' and `idUser` = '" . $_SESSION['idUser'] . "'";
            // echo $query;
            $result = $database->fire_query($query);

            // echo $query;
            //ternary operator
            return (mysqli_num_rows($result) > 0) ? true : false;
        }
        public static function add_to_favorites($post)
        {

            global $database;

            $query = "INSERT INTO `favorieten` (`idFavorieten`,
                                           `idProduct`,
                                           `idUser`)
                      VALUES			 (NULL,
                                           '" . $post['idProduct'] . "',
                                           '" . $_SESSION['idUser'] . "')";

            echo $query;

            $database->fire_query($query);
        }
        public static function remove_from_favorites($post)
        {

            global $database;

            $query = "DELETE FROM favorieten WHERE idProduct = ".$_POST['idProduct']." AND idUser = ". $_SESSION['idUser'] ." ";

            $database->fire_query($query);
        }
        public static function get_favoriete_producten()
        {
            global $database;

            $query = "SELECT * FROM favorieten
                      INNER JOIN producten ON favorieten.idProduct = producten.idProduct";
            $result = $database->fire_query($query);

            // echo $query;

            return $result;
        }
    }
?>