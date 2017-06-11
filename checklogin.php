<?php
require_once("classes/LoginClass.php");
require_once("classes/SessionClass.php");
if (!empty($_POST['emailAdres']) && !empty($_POST['wachtwoord'])) {
    // Als email/password combi bestaat en geactiveerd....
    if (LoginClass::check_if_email_password_exists($_POST['emailAdres'],
        MD5($_POST['wachtwoord']),
        '1')
    ) {
        $session->login(LoginClass::find_login_by_email_password($_POST['emailAdres'],
            MD5($_POST['wachtwoord'])));

        switch ($_SESSION['rol']) {
            case '2':
                header("location:index.php?content=algemeneHomepage");
                break;
            case '1':
                header("location:index.php?content=adminHomepage");
                break;
            default :
                header("location:index.php?content=inloggen_Registreren");
        }
    } else {
        echo "<h3 style='text-align: center;' >Uw email/password combi bestaat niet of uw account is niet geactiveerd.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
        header("refresh:5;url=index.php?content=inloggen_Registreren");
    }
} else {
    echo "<h3 style='text-align: center;' >U heeft een van beide velden niet ingevuld, u wordt doorgestuurd naar de inlogpagina.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    // header("refresh:5;url=index.php?content=inloggen_Registreren");
}
?>