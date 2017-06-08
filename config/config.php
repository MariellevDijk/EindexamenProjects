<?php

$witch_server = $_SERVER['SERVER_ADDR'];
//echo $witch_server;exit();
switch ($witch_server) {
    case '::1':
        define('SERVERNAME', 'localhost');
        define('USERNAME', 'root');
        define('PASSWORD', '');
        define('DATABASENAME', 'videotheek');
        // <Wijzigingsopdracht>
        define('MAIL_PATH', 'http://localhost/VidoeProject/');
        // </Wijzingopdracht>
        break;
}
?>