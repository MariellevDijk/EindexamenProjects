<?php

//session_start();
    class SessionClass
    {
        //Fields
        private $idUser;
        private $emailAdres;
        private $betaalwijze;
        private $rol;
        private $geblokkeerd;

        //Properties
        public function getrol(){ return $this->rol; }

        //Constructor
        public function ___construct()
        {
        }

        // Methods
        public function login($loginObject)
        {
            $this->idUser = $_SESSION['idUser'] = $loginObject->getidUser();
            $this->emailAdres = $_SESSION['emailAdres'] = $loginObject->getEmailAdres();
            $this->rol = $_SESSION['rol'] = $loginObject->getRol();
            $this->geblokkeerd = $_SESSION['geblokkeerd'] = $loginObject->getGeblokkeerd();
            $this->betaalwijze = $_SESSION['betaalwijze'] = $loginObject->getBetaalwijze();

            $usersObject = LoginClass::find_info_by_id($_SESSION['idUser']);
        }
        public function logout()
        {
            session_unset('idUser');
            session_unset('emailAdres');
            session_unset('rol');
            session_unset('geblokkeerd');
            session_unset('betaalwijze');

            session_destroy();

            unset($this->idUser);
            unset($this->emailAdres);
            unset($this->rol);
            unset($this->geblokkeerd);
            unset($this->betaalwijze);
        }
    }
    $session = new SessionClass();
?>