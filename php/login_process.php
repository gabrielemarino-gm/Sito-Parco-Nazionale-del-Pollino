<!DOCTYPE html>
<html lang="it">
    <meta charset="utf-8">
    <link href="../css/stile.css" rel="stylesheet" type="text/css">
    <script src = "../javascript/validation.js"></script>
    <link rel="icon" href="../foto/Logo_ParcoPollino2.png">

    <head>
        <title>
            Login
        </title>
    </head>
</html>

<?php
    session_start();
    require_once('./connection.php');

    if (isset($_SESSION['guida']) || isset($_SESSION['utente'])) 
    {
        header('Location: ./areapersonale.php');
        exit;
    } 

    
    if (isset($_POST['login'])) 
    {
        $username = $_POST['username'] == null ? '' : $_POST['username'];
        $password = $_POST['password'] == null ? '' : $_POST['password'];
        
        
        $username = $dbCon->real_escape_string($username);
        $password = $dbCon->real_escape_string($password);

        if (empty($username) || empty($password)) 
        {
            $_SESSION['msg'] = 'Inserisci username e password %s';
        }
        else 
        {
            // Controllo la tabella utenti
            $query = "
                SELECT *
                FROM utenti
                WHERE username = '$username'
            ";
            
            $loggato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
            $utenteLoggato = $loggato->fetch_array();
            $numeroRisultati = $loggato->num_rows;
            
            if($numeroRisultati == 0) // Non esiste questo utente
            {
                $_SESSION['msg'] = 'Utente non registrato. Registrati!';

                // Magari è una Guida da validare
                $query = "
                    SELECT *
                    FROM guide_da_validare
                    WHERE username = '$username'
                ";
                
                $loggato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
                $utenteLoggato = $loggato->fetch_array();
                $numeroRisultati = $loggato->num_rows;
                $guidaVerifica = 1;

                if($numeroRisultati != 0)
                {
                    if($utenteLoggato['non_validata'] == 1)
                    {
                        $_SESSION['msg'] = 'La tua richiesta di registrazione non è stata validata, prova a registrarti come utente semplice';
                        
                        $query = "
                            DELETE FROM guide_da_validare
                            WHERE username = '$username'
                        ";
                        
                        $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
                        //print($msg);
                        //print("<br>");
                        //print('<a href="./register.php">torna indietro</a>');
                        exit;
                    }
                    else
                    {
                        $_SESSION['msg'] = 'La tua richiesta di registrazione non è stata ancora validata validata, riprova più tardi';
                        //print($msg);
                        //print("<br>");
                        //print('<a href="./login.php">torna indietro</a>');
                        exit;
                    }
                }
                
                header('Location: ./login.php');
                exit;
            }


            $password_da_validare = $utenteLoggato['password'];
            // Imposto le variabili di sessione
            $_SESSION['username'] = $utenteLoggato['username'];
            $_SESSION['nome'] = $utenteLoggato['nome'];
            $_SESSION['cognome'] = $utenteLoggato['cognome'];
            $_SESSION['email'] = $utenteLoggato['email'];
    
            $_SESSION['admin'] = ($utenteLoggato['admin'] == 1)? 1:0;

            if ( ($numeroRisultati != 0) && 
                 (password_verify($password, $password_da_validare) === true))
            {
                session_regenerate_id();

                if($utenteLoggato['guida'] == 1) 
                {                                     
                    $_SESSION['guida'] = 1;   
                    $_SESSION['utente'] = 0;
                } 
                else 
                {
                    $_SESSION['guida'] = 0;   
                    $_SESSION['utente'] = 1;                                       
                }

                header('Location: ./areapersonale.php');
                exit;
            }
            else 
            {
                $_SESSION['msg'] = 'Credenziali utente errate';
            }
        }

        $_SESSION['msg'] = 'Password errata!';
        header('Location: ./login.php');
        exit;
        //print($msg);
        //print("<br>");
        //print('<a href="./login.php">torna indietro</a>');
    }
?>