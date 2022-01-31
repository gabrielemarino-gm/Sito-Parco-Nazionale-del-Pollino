<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <link href="../css/stile.css" rel="stylesheet" type="text/css">
        <script src = "../javascript/validation.js"></script>
        <link rel="icon" href="../foto/Logo_ParcoPollino2.png">

        <title>
            Login
        </title>
    </head>

    <?php
        session_start();
        include './connection.php';

        $admin = 0;
        $personale = "Login";
        $link = "php/login.php";
        if(isset($_SESSION['guida']) || isset($_SESSION['utente']))
        {
            $personale = "Profilo";
            $link = "php/areapersonale.php";
        }

        if (isset($_SESSION['admin']))
        {
            $admin = 1;
        }
    ?>

    <body>
        <aside class="menu">
            <nav>
                <a href="../index.php"><img src="../foto/Logo_ParcoPollino2.png" alt="Logo"></a>
                <a href="./post.php">Post</a>
                <a href="./eventi.php">Eventi</a>
                <a href="./register.php">Registrazione</a>
            </nav>
        </aside>

        <div class="titolo-login">
            <h1>
                Login 
            </h1>
        </div>
        
        
        <div class="form-login">
            <form method="POST" action="./login_process.php" onSubmit="return valida_login()">
                <div> 
                    <input id='username' name="username" type="text" placeholder="Inserisci username" size="40" maxlength="50" required/>
                    <input id='password' name="password" type="password" placeholder="Inserisci password" size="40" autocomplete="off" required/>
                    <input type="button" id="show" class="show" onclick="showPassword()" value=" "> <br>
                </div>

                <input type="submit" name="login" value="Login">

                <div class="passDimendicata">
                    <br>
                    <span> <a class="psw" href="./register.php"> Non sei registrato? </a> </span>       
                </div>                 
            </form>  
            
            <br><br>
            <?php
            
                if ( $_SESSION['msg'] != 'OK')
                {
                    print('
                            <p style="color:red">
                                '.$_SESSION['msg'] .'
                            </p>
                    ');
                }

                print('
                        <p style="color:green">
                            '.$_SESSION['info'] .'
                        </p>
                    ');

                $_SESSION['msg'] = ' ';
                $_SESSION['info'] = '';
            ?>

        </div> 
        
    </body>
</html>

