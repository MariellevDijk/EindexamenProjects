<?php
require_once("classes/LoginClass.php");
require_once("classes/SessionClass.php");

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    // Als email/password combi bestaat en geactiveerd....
    if (LoginClass::check_if_email_password_exists($_POST['email'],
        MD5($_POST['password']),
        '1')
    ) {
        $session->login(LoginClass::find_login_by_email_password($_POST['email'],
            MD5($_POST['password'])));

        switch ($_SESSION['userrole']) {
            case 'klant':
                header("location:index.php?content=klantHomepage");
                break;
            case 'eigenaar':
                header("location:index.php?content=adminHomepage");
                break;
            case 'geblokkeerd':
                header("location:index.php?content=algemeneHomepage");
                break;
            case 'baliemedewerker':
                header("location:index.php?content=baliemedewerkerHomepage");
                break;
            case 'admin':
                header("location:index.php?content=adminHomepage");
                break;
            case 'bezorger':
                header("location:index.php?content=bezorgerHomepage");
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
    header("refresh:5;url=index.php?content=inloggen_Registreren");
}
?>