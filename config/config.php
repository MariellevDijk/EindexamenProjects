<?php

$witch_server = $_SERVER['SERVER_ADDR'];
//echo $witch_server;exit();
switch ($witch_server) {
    case '::1':
        define('SERVERNAME', 'localhost');
        define('USERNAME', 'root');
        define('PASSWORD', '');
        define('DATABASENAME', 'examendatabase');
        // <Wijzigingsopdracht>
        define('MAIL_PATH', 'http://localhost/eindexamenproject/');
        // </Wijzingopdracht>
        break;
}
?>