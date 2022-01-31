<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <link href="../css/stile.css" rel="stylesheet" type="text/css">
        <script src = "../javascript/validation.js"></script>
        <link rel="icon" href="../foto/Logo_ParcoPollino2.png">

        <title>
            Modifica Profilo
        </title>
    </head>

    <?php

        session_start();
        if ($_SESSION['verificato'] != 'OK')
            header('Location: ./confirm_login.php');

    ?>

    <body>
        <div class="titolo-modifica">
            <h1>
                Modifica Profilo
            </h1>
        </div>

        <div class="contenitore-mod">
            <div class="form-modifica">
                <form method="POST" action="./modifica_username.php" onSubmit="return valida_registrazione()"> 
                    <input id="username-mod" name="username-mod" type="text" placeholder="Modifica Username" size="40" maxlength="50" required/> <br>
                    <input type="submit" name="modUsername" class="modUsername" value="Modifica Username">
                </form>
                
                <form method="POST" action="./modifica_email.php" onSubmit="return valida_registrazione()">    
                    <input id="email" name="email-mod" type="text" placeholder="Modifica E-mail" size="40" maxlength="50" required/> <br>
                    <input type="submit" class="modEmail" value="Modifica E-mail">
                </form>

                <form method="POST" action="./modifica_password.php" onSubmit="return valida_registrazione()">
                    <input id="password" name="password-mod"  type="password" placeholder="Modifica Password" size="40" autocomplete="off" required/> 
                    <input type="button" id="show" class="show" onclick="showPassword()" value=" ">

                    <div class="ripetuta-mod">
                        <input id="ripeti_password" name="ripeti-password-mod" type="password" placeholder="Ripeti nuova password" size="40" autocomplete="off" required/> 
                        <input type="button" id="show-ripetuta" class="show" onclick="showPasswordRipetuta()" value=" ">
                    </div>
                    
                    <input type="submit" class="modPass" value="Modifica Password">
                </form>


                <div class="form-img-profilo">
                    <label>Carica la tua foto profilo:</label><br>
                    <input class="scegli-foto-button" type="submit" onclick="document.getElementById('file-choosen').click()" value="Scegli Foto">
                    <form method="POST" action="./modifica_foto.php" enctype="multipart/form-data">
                        <input id="file-choosen" type="file" name="file-choosen" style="display:none;">
                        <input class="carica-foto-button" type="submit" name="upload" value="Carica Foto">
                    </form>
                </div>
                
                <form method="POST" action="./areapersonale.php" onSubmit="return valida_registrazione()">    
                    <input type="submit" class="home-mod" value="Torna al Profilo">
                </form>
            </div>
            <?php
                require_once('./connection.php');

                $query = '
                    SELECT *
                    FROM utenti
                    WHERE username = "'.$_SESSION['username'] .'"
                ';

                $loggato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
                $utenteLoggato = $loggato->fetch_array();
                $foto = $utenteLoggato['imgPath'];

                print
                    (
                        '<div class="img-mod">
                            <img src="' .$foto .'" alt="Immagine del profilo">
                        </div>'
                    );
                
                $_SESSION['verificato'] = 'NO';
            ?>
        </div>
    </body>
</html>