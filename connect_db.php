<?php
// Definieer severname, usernaam, wachtwoord en databasenaam
$servername = 'localhost';
$username = 'root';
$password = '';
// <Wijzigingsopdracht>
$databasename = 'examendatabase';
// </Wijzigingsopdracht>

// Maak contact met de server waarop de database draait.
$connection = mysqli_connect($servername, $username, $password, $databasename);
?>