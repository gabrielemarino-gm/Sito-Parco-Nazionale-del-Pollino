
<?php
    session_start();
    require_once('./connection.php');
    
    $usernameOriginale = $_SESSION['username'];
    print('<p>'.$usernameOriginale .'</p>');
    $usernameNew = $_POST['username-mod'] == null ? '' : $_POST['username-mod'];

    if (empty($usernameNew)) 
    {
        $_SESSION['msg'] = 'Inserisci username!';
        header('Location: ./modifica_profilo.php');
    }
    else
    {
        $query = '
            UPDATE utenti
            SET username = "'.$usernameNew . '"
            WHERE username = "'.$usernameOriginale . '"
        ';

        $dbCon->query($query);
        $_SESSION['username'] = $usernameNew;
    }
    
    
    header('Location: ./modifica_profilo.php');
?>
