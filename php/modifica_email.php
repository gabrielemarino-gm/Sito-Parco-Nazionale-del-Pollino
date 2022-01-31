
<?php
    session_start();
    require_once('./connection.php');
    
    $username = $_SESSION['username'];
    $email = $_POST['email-mod'] == null ? '' : $_POST['email-mod'];

    if (empty($email)) 
    {
        $_SESSION['msg'] = 'Inserisci E-mail!';
        header('Location: ./modifica_profilo.php');
    }
    else
    {
        $query = '
            UPDATE utenti
            SET email = "'.$email . '"
            WHERE username = "'.$username . '"
        ';

        $dbCon->query($query);
        $_SESSION['email'] = $email;
    }
    
    
    header('Location: ./modifica_profilo.php');
?>
