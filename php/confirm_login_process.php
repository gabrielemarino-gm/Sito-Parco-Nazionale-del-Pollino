<?php
    session_start();
    $_SESSION['verificato'] = 'NO';
    require_once('./connection.php');
    require_once('print_console.php');

    if (isset($_POST['login'])) 
    {
        // Prendo le strigne passate dall'utente nel form
        $username = $_POST['username'] == null ? '' : $_POST['username'];
        $password = $_POST['password'] == null ? '' : $_POST['password'];
        
        // Creo un formato che posso usare in MySQL
        $username = $dbCon->real_escape_string($username);
        $password = $dbCon->real_escape_string($password);

        if (empty($username) || empty($password)) 
        {
            $_SESSION['msg'] = 'Inserisci Username e Password';
            header('Location: ./confirm_login.php');
        } 
        else 
        {
            $_SESSION['username'] = $username;
            $query = "
                SELECT username, password, guida, nome, cognome, email, admin
                FROM utenti
                WHERE username = '$username'
            ";
            
            $loggato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
            $utenteLoggato = $loggato->fetch_array();
            $numeroRisultati = $loggato->num_rows;
            $password_da_validare = $utenteLoggato['password'];
            

            if ( ($numeroRisultati != 0) && 
                 ((password_verify($password, $password_da_validare) === true) || ($_SESSION['admin'] == 1)))  // Esiste una corrispondenza
            {
                $_SESSION['msg'] = 'OK';
                $_SESSION['verificato'] = 'OK';
                header('Location: ./modifica_profilo.php');
            } 
            else 
            {
                $_SESSION['msg'] ='Nome Utente o Password errati. Riprovare!';
                header('Location: ./confirm_login.php');
            }
        }
    }
?>