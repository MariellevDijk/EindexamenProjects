<?php

$switch_server = $_SERVER['SERVER_ADDR'];
//echo $switch_server;exit();
switch ($switch_server) {
    case '::1':
        define('SERVERNAME', 'localhost');
        define('USERNAME', 'root');
        define('PASSWORD', '');
        define('DATABASENAME', 'examendatabase');
        define('MAIL_PATH', 'http://localhost/Eindexamenproject/');
        break;
}
?>