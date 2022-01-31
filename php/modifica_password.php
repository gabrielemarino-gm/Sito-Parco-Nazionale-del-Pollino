
<?php
    session_start();
    require_once('./connection.php');
    
    $username = $_SESSION['username'];
    $password = $_POST['password-mod'] == null ? '' : $_POST['password-mod'];
    $passwordRipeti = $_POST['ripeti-password-mod'] == null ? '' : $_POST['ripeti-password-mod'];

    $arePasswordEqual = ( $password === $passwordRipeti );

    if (empty($password) || empty($passwordRipeti)) 
    {
        $_SESSION['msg'] = 'Inserisci la nuova password!';
        //header('Location: ./modifica_profilo.php');
    }
    else if (!$arePasswordEqual)
    {
        $_SESSION['msg'] = 'Le due password non corrispondono';
        header('Location: ./modifica_profilo.php');
    }
    else
    {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $query = '
            UPDATE utenti
            SET password = "'.$password_hash . '"
            WHERE username = "'.$username . '"
        ';

        $dbCon->query($query);
    }
    
    
    header('Location: ./modifica_profilo.php');
?>
