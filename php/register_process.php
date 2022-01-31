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
</html>

<?php
    session_start();
    require_once('./connection.php');

    if (isset($_SESSION['guida']) || isset($_SESSION['utente'])) 
    {
        header('Location: ./areapersonale.php');
        exit;
    }

    if (isset($_POST['register'])) 
    {
        $name = ($_POST['name'] == null) ? '' :  $_POST['name'];
        $surname = ($_POST['surname'] == null) ? '' :  $_POST['surname'];
        $username = ($_POST['username'] == null) ? '' :  $_POST['username'];
        $password = ($_POST['password'] == null) ? '' :  $_POST['password'];
        $email = ($_POST['email'] == null) ? '' :  $_POST['email'];
        $passwordripetuta = ($_POST['ripeti-password'] == null) ? '' :  $_POST['ripeti-password'];
        $datanascita = ($_POST['data_nascita'] == null) ? '' :  $_POST['data_nascita'];

        $name = $dbCon->real_escape_string($name);
        $surname = $dbCon->real_escape_string($surname);
        $username = $dbCon->real_escape_string($username);
        $password = $dbCon->real_escape_string($password);
        $email = $dbCon->real_escape_string($email);
        $passwordripetuta = $dbCon->real_escape_string($passwordripetuta);
        $datanascita = $dbCon->real_escape_string($datanascita);
        
        $guida = 0;
        $errore = 1;

        if (isset($_POST['guida'])) {
            $guida = 1;
        }
        

        $isUsernameValid = filter_var
        (
            $username,
            FILTER_VALIDATE_REGEXP, [
                "options" => [
                    "regexp" => "/^[a-z\d_]{3,20}$/i"
                ]
            ]
        );

        $isEmailValid = filter_var($email, FILTER_VALIDATE_EMAIL);
        
        $arePasswordEqual = ( $password === $passwordripetuta );

        $pwdLenght = mb_strlen($password);
        
        if (empty($username) || empty($password)) 
        {
            echo 'Compila tutti i campi';
            $_SESSION['msg'] = 'Compila tutti i campi';
            header('Location: ./register.php');
            exit;
        } 
        elseif (false === $isUsernameValid) 
        {
            echo 'Lo username non è valido. Sono ammessi solamente caratteri alfanumerici e l\'underscore. Lunghezza minina 3 caratteri.';
            $_SESSION['msg'] = 'Lo username non è valido. Sono ammessi solamente caratteri alfanumerici e l\'underscore. Lunghezza minina 3 caratteri.';
            
            header('Location: ./register.php');
            exit;
        } 
        elseif ($pwdLenght < 8) 
        {
            echo 'Lunghezza minima password 8 caratteri.';
            $_SESSION['msg'] = 'Lunghezza minima password 8 caratteri.';
            header('Location: ./register.php');
            exit;
        } 
        else if (false === $isEmailValid) 
        {
            echo "Indirizzo email non valido.";
            $_SESSION['msg'] = "Indirizzo email non valido.";
            header('Location: ./register.php');
            exit;
        } 
        else if (false === $arePasswordEqual) 
        {
            echo "Le due password non corrispondono.";
            $_SESSION['msg'] = "Le due password non corrispondono.";
            header('Location: ./register.php');
            exit;
        }
        else if ($guida == 1)
        {
            // Le guide devono essere approvate dall'amministratore
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            $query = "
                SELECT id
                FROM utenti
                WHERE username = '$username'
                    OR email = '$email'
            ";
            
            $risultato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
            $numeroRisultati = $risultato->num_rows;
             
            if ($numeroRisultati > 0) // Se ci sono altri utenti con lo stesso nome o email, fallisce
            {
                echo 'Username o email già in uso';
                $_SESSION['msg'] = 'Username o email già in uso';
                header('Location: ./register.php');
                exit;
            } 
            else 
            {
                $query = "
                    INSERT INTO guide_da_validare (nome, cognome, email, username, password)
                    VALUES ('$name' , '$surname', '$email', '$username', '$password_hash')
                ";
            
                $risultato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
                
                if ($risultato) 
                {
                    echo "Registrazione eseguita con successo. In attesa di validazione";
                    $_SESSION['msg'] = "Registrazione eseguita con successo. In attesa di validazione";
                    header('Location: ./register.php');
                    exit;
                } 
                else 
                {
                    echo 'Problemi con l\'inserimento dei dati';
                    $_SESSION['msg'] = 'Problemi con l\'inserimento dei dati';
                    header('Location: ./register.php');
                    exit;
                }
            }   
        } 
        else 
        {
            // Tutti i campi sono stati compilati correttamante
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            $query = "
                SELECT id
                FROM utenti
                WHERE username = '$username'
                    OR email = '$email'
            ";
            
            $risultato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
            $numeroRisultati = $risultato->num_rows;
            
            if ($numeroRisultati > 0) 
            {
                echo 'Username o email già in uso';
                $_SESSION['msg'] = 'Username o email già in uso';
                header('Location: ./register.php');
                //exit;
            } 
            else 
            {
                $query = "
                    INSERT INTO utenti(username, password, email, guida, nome, cognome, admin, imgPath, data_nascita)
                    VALUES ('$username' , '$password_hash', '$email', '$guida', '$name', '$surname', 0, '../foto/profilo/default.png', $datanascita)
                ";
            
                $risultato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
                
                if ($risultato) 
                {
                    echo 'Registrazione avvenuta con successo. Effettua il login!';
                    $_SESSION['msg'] = '';
                    $_SESSION['info'] = 'Registrazione avvenuta con successo. Effettua il login!';
                    header('Location: ./login.php');
                    exit;
                } 
                else 
                {
                    echo 'Problemi con l\'inserimento dei dati';
                    $_SESSION['msg'] = 'Problemi con l\'inserimento dei dati';
                    header('Location: ./register.php');
                    exit;
                }
            }
        }
    } 

?>