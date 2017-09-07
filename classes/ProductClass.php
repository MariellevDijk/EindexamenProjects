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
        private $aantalBeschikbaar;
        private $aantalVerkocht;
        private $isAccessoire;
        private $type;
        private $dagProduct;

        //Properties
        public function getIdProduct()                  { return $this->idProduct; }
        public function getNaam()                       { return $this->naam; }
        public function getBeschrijving()               { return $this->beschrijving; }
        public function getPrijs()                      { return $this->prijs; }
        public function getFoto()                       { return $this->foto; }
        public function getBeschikbaar()                { return $this->beschikbaar; }
        public function getAantalBeschikbaar()          { return $this->aantalBeschikbaar; }
        public function getAantalVerkocht()             { return $this->aantalVerkocht; }
        public function getisAccessoire()               { return $this->isAccessoire; }
        public function getType()                       { return $this->type; }
        public function getDagProduct()                 { return $this->dagProduct; }

        public function setIdProduct($value)            { $this->idProduct = $value; }
        public function setNaam($value)                 { $this->naam = $value; }
        public function setBeschrijving($value)         { $this->beschrijving = $value; }
        public function setPrijs($value)                { $this->prijs = $value; }
        public function setFoto($value)                 { $this->foto = $value; }
        public function setBeschikbaar($value)          { $this->beschikbaar = $value; }
        public function setAantalBeschikbaar($value)    { $this->aantalBeschikbaar = $value; }
        public function setAantalVerkocht($value)       { $this->aantalVerkocht = $value; }
        public function setisAccessoire($value)         { $this->isAccessoire = $value; }
        public function setType($value)                 { $this->type = $value; }
        public function setDagProduct($value)           { $this->dagProduct = $value; }

        //Constuctor
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
                $object = new ProductClass();

                $object->id = $row['idProduct'];
                $object->naam = $row['naam'];
                $object->beschrijving = $row['beschrijving'];
                $object->prijs = $row['prijs'];
                $object->foto = $row['foto'];
                $object->beschikbaar = $row['beschikbaar'];
                $object->aantalBeschikbaar = $row['aantalBeschikbaar'];
                $object->aantalVerkocht = $row['aantalVerkocht'];
                $object->isAccessoire = $row['isAccessoire'];
                $object->type = $row['type'];
                $object->dagProduct = $row['dagProduct'];

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

            $query = "INSERT INTO `producten` (`idProduct`,
                                               `naam`,
                                               `beschrijving`,
                                               `prijs`,
                                               `foto`,
                                               `beschikbaar`,
                                               `aantalBeschikbaar`,
                                               `aantalVerkocht`,
                                               `isAccessoire`,
                                               `type`)
                          VALUES			  (NULL,
                                               '" . $post['naam'] . "',
                                               '" . $post['beschrijving'] . "',
                                               '" . $post['prijs'] . "',
                                               '" . $post['foto'] . "',
                                               '" . '1' . "',
                                               '" . $post['aantalBeschikbaar'] . "',
                                               '" . '1' . "',
                                               '" . $post['isAccessoire'] ."',
                                               '" . $post['type'] . "')";

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
                                                `type`	= 	'" . $_POST['type'] . "',
                                                `aantalBeschikbaar`	= 	'" . $_POST['aantalBeschikbaar'] . "'
                                        WHERE	`idProduct`			=	'" . $_POST['idProduct'] . "'";

            $database->fire_query($sql);

            $last_id = mysqli_insert_id($database->getDb_connection());
        }
        public static function get_available_products ()
        {
            global $database;

            $query = "SELECT * FROM producten where `beschikbaar` = '1' and `isAccessoire` = '0' AND `dagProduct` = '0'";

            $result = $database->fire_query($query);

            return $result;
        }
        public static function get_product_detail($idProduct)
        {
            global $database;

            $query = "SELECT * FROM `producten` 
                                     WHERE `idProduct` = '" . $idProduct . "'";

            $result = $database->fire_query($query);

            return $result;
        }
        public static function selecteer_alle_winkelmand_items()
        {
            global $database;

            $sql = "select `idWinkelmand`, `idProductWm`, `prijs`, `aantalWm`,`aantalWm` * `prijs` as totaalPrijs, `naam`, `dagProduct`  from `winkelmand`
                    INNER JOIN `producten` on winkelmand.idProductWm = producten.idProduct
                    where `idUserWm` = " . $_SESSION['idUser'] . " ";

            $result = $database->fire_query($sql);

            return $result;
        }
        public static function selecteer_accessoires()
        {
            global $database;

            $query = "SELECT * FROM `producten` 
                                     WHERE `isAccessoire` = '1' AND `dagProduct` = '0'";

            $result = $database->fire_query($query);

            return $result;
        }
        public static function get_products_by_description($post)
        {
            global $database;

            $query = "SELECT * FROM producten where `beschikbaar` = '1' AND beschrijving LIKE "."'%". $_POST['zoekterm'] ."%'" . " ";

            return $database->fire_query($query);
        }
        public static function get_products_by_id($post)
        {
            global $database;

            $query = "SELECT * FROM producten where `beschikbaar` = '1' AND idProduct = '" . $_POST['artikelcode'] ."' ";

            return $database->fire_query($query);
        }
        public static function get_products_by_type($post)
        {
            global $database;

            $query = "SELECT * FROM producten where `beschikbaar` = '1' AND `type` = '" . $_POST['type'] ."' ";

            return $database->fire_query($query);
        }
        public static function get_products_by_prijs($post)
        {
            global $database;

            $query = "SELECT * FROM producten where `beschikbaar` = '1' AND prijs >= '" . $_POST['hogerDan'] ."' AND prijs <= '" . $_POST['lagerDan'] . "'";

            return $database->fire_query($query);
        }
        public static function set_Product_Van_De_Dag($idProduct)
        {
            global $database;

            $query = "UPDATE `producten` SET `dagProduct` = 1 WHERE `idProduct` = $idProduct";

            $database->fire_query($query);

            self::remove_andere_producten_van_de_dag($idProduct);
        }
        public static function remove_andere_producten_van_de_dag($idProduct)
        {
            global $database;

            $query = "UPDATE `producten` SET `dagProduct` = 0 WHERE `idProduct` != $idProduct";

            $database->fire_query($query);
        }
        public static function get_Product_Van_De_Dag()
        {
            global $database;

            $query = "SELECT *, `prijs` * 0.5 as prijsDagProduct 
                      FROM `producten`
                      WHERE `dagProduct` = '1'";

            $result = $database->fire_query($query);

            return $result;
        }
        public static function remove_Product_Van_De_Dag()
        {
            global $database;

            $query = "UPDATE `producten` SET `dagProduct` = '0' WHERE `dagProduct` = '1'";

            $database->fire_query($query);
        }
        public static function check_if_product_van_de_dag($idProduct)
        {
            global $database;

            $query = "SELECT *, `prijs` * 0.5 as prijsDagProduct FROM `producten` WHERE `idProduct` = $idProduct AND `dagProduct` = '1'";

            $result = $database->fire_query($query);

            return $result;
        }
    }
?>