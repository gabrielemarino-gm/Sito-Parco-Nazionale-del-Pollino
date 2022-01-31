<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <link href="../css/stile.css" rel="stylesheet" type="text/css">
        <script src = "../javascript/validation.js"></script>
        <link rel="icon" href="../foto/Logo_ParcoPollino2.png">

        <title>
            Conferma Login
        </title>
    </head>

    <body>
        <div class="titolo-profilo">
            <h1>
                Conferma Login
            </h1>
        </div>

        <?php
            session_start();
            include './connection.php';

            print('
                <div class="form-conferma-login">
                    <form method="POST" action="./confirm_login_process.php" onSubmit="return valida_login()">    
                        <div> 
                            <input id="username" name="username" type="text" placeholder="Inserisci username" size="40" maxlength="50" required/>
                            <input id="password" name="password" type="password" placeholder="Inserisci password" size="40" autocomplete="off" required/>
                            <input type="button" id="show" class="show" onclick="showPassword()" value=" ">
                        </div>

                        <input type="submit" name="login" value="Conferma">

                    </form>
                </div>
            ');

       
            if ( $_SESSION['msg'] != 'OK')
            {
                print('
                        <p class="errore-login">
                            '.$_SESSION['msg'] .'
                        </p>
                ');
            }

            $_SESSION['msg'] != '';
        ?>
    </body>
</html>