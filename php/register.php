<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <link href="../css/stile.css" rel="stylesheet" type="text/css">
        <script src = "../javascript/validation.js"></script>
        <link rel="icon" href="../foto/Logo_ParcoPollino2.png">

        <title>
            Registrazione
        </title>
    </head>

    <?php
        session_start();
        include './connection.php';

        if(isset($_SESSION['guida']) || isset($_SESSION['utente']))
        {
            header('location: ./areapersonale.php');
            exit;
        }
    ?>

    <body>
        <aside class="menu">
            <nav>
                <a href="../index.php"><img src="../foto/Logo_ParcoPollino2.png" alt="Logo"></a>
                <a href="./post.php">Post</a>
                <a href="./eventi.php">Eventi</a>
                <a href="login.php">Login</a>
            </nav>
        </aside>

        <h1 class="titolo-registrazione">
            Registrazione 
        </h1>

        <div class="form-registrazione">
            <form method="POST" action="./register_process.php" onSubmit='return valida_registrazione()'>
                <div>
                    <input id="name" name="name" type="text" placeholder="Inserisci il tuo nome" size="40" maxlength="50" required/> <br>
                    <input id="surname" name="surname" type="text" placeholder="Inserisci il tuo cognome" size="40" maxlength="50" required/> <br>
                    <input id="username" name="username" type="text" placeholder="Inserisci il tuo username" size="40" maxlength="50" required/> <br>
                    <input id="email" name="email" type="text" placeholder="Inserisci la tua email" size="40" maxlength="50" required/> <br>

                    <input id="password" name="password"  type="password" placeholder="Inserisci la tua password" size="40" autocomplete="off" required/> 
                    <input type="button" id="show" class="show" onclick="showPassword()" value=" ">
                    
                    <div class="ripetuta">
                        <input id="ripeti_password" name="ripeti-password" type="password" placeholder="Ripeti la tua password" size="40" autocomplete="off" required/> 
                        <input type="button" id="show-ripetuta" class="show" onclick="showPasswordRipetuta()" value=" ">
                    </div>

                    <label class="data_nascita">Data di nascita: 
                        <input type="date" id="data_nascita" name="data_nascita" required>
                    </label>
                    <br><br>

                    <div class="container-checkbox">
                        <label> 
                            Sono una guida <input type="checkbox"  id="guida" name="guida" value="guida">
                        </label>       
                    </div>

                    <br>
                    <input type="submit" class="regbutton" id="registrazione" name="register" value="Registra">
                </div>
            </form> 
            <?php
                print('
                        <p style="color:red">
                            '.$_SESSION['msg'] .'
                        </p>
                ');

                print('
                        <p style="color:green">
                            '.$_SESSION['info'] .'
                        </p>
                    ');

                $_SESSION['msg'] = '';
                $_SESSION['info'] = '';
            ?>
        </div>

        
            
    </body>
</html>