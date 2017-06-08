<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css" rel="stylesheet" type="text/css">
    <style>
        .header {
            visibility: hidden;
        }
    </style>
</head>
<body>
<?php
require_once("./classes/LoginClass.php");

if (isset($_GET['idKlant']) && isset($_GET['email']) && isset($_GET['password']))
{
    if (LoginClass::check_if_activated($_GET['email'],$_GET['password']))
    {
        $action = "index.php?content=activate&idKlant=".$_GET['idKlant']."&email=".$_GET['email']."&password=".$_GET['password'];
        

        if (LoginClass::check_if_email_password_exists($_GET['email'], $_GET['password'], '0'))
        {
            if (isset($_POST['submit']))
            {
                // 1. Check of de twee ingevoerde passwords correct zijn.
                if ( !strcmp($_POST['password_1'], $_POST['password_2']))
                {
                    // 2. Activeer het account en update het oude password naar het nieuwe password.
                    LoginClass::activate_account_by_id($_GET['idKlant']);

                    echo "<h3 style='text-align: center;' >Uw wachtwoord is succesvol gewijzigd.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                    header("refresh:4;url=index.php?content=inloggen_Registreren");
                    LoginClass::update_password($_GET['idKlant'],$_POST['password_1']);
                }
                else
                {
                    echo "<h3 style='text-align: center;' >Wachtwoorden komen niet overeen, probeer het nog een keer.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                    header("refresh:4;url=".$action);
                }
            }
            else
            {
                echo "<h3 style='text-align: center;' >Uw account wordt geactiveerd.<br>
								Kies een nieuw password</h3><br>";
                ?>
                <div class="section">
                <div class="container">
                <form  action="<?php echo $action; ?>" method='post' style="width: 50%;">
                    <div class="form-group"><label class="control-label" for="password_1">Typ hier uw nieuwe wachtwoord</label>
                        <input class="form-control" id="password_1" placeholder="Wachtwoord" type="password" name="password_1" required></div>

                    <div class="form-group"><label class="control-label" for="password_2">Typ nogmaals uw wachtwoord (controle)</label>
                        <input class="form-control" id="password_2" placeholder="Wachtwoord" type="password" name="password_2" required></div>
                    <input type='hidden' name='idKlant' value='<?php echo $_GET['idKlant']; ?>'/>

                    <button type="submit" name="submit" class="btn btn-primary">Verstuur</button>

                </form>
                </div>
                </div>
                <br><br><br><br><br><br><br><br>
                <?php
            }
        }
        else
        {
            echo "<h3 style='text-align: center;' >U heeft geen rechten op deze pagina. Uw email/password combi is niet correct of uw account is al geactiveerd. U wordt doorgestuurd naar de registratiepagina</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
            header("refresh:4;url=index.php?content=inloggen_Registreren");
        }
    }
    else
    {
        echo "<h3 style='text-align: center;' >Uw account is all geactiveerd of uw email/password combi is niet correct u heeft daarom geen rechten op deze pagina. U wordt doorgestuurd naar de registratiepagina</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
        header("refresh:4;url=index.php?content=inloggen_Registreren");
    }
}
else
{
    echo "<h3 style='text-align: center;' >Uw url is niet correct en daarom heeft u geen rechten op deze pagina. U wordt doorgestuurd naar de registratiepagina</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    header("refresh:4;url=index.php?content=inloggen_Registreren");
}
?>
</body>
</html>
