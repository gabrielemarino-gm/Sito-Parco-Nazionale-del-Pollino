<?php
    session_start();
    require_once('./connection.php');
    require_once('./print_console.php');
    $uploadDir = '../foto/profilo/';

    foreach ($_FILES as $file) 
    {
        if (UPLOAD_ERR_OK === $file['error'])
        {
            $fileName = basename($file['name']);
            
            move_uploaded_file($file['tmp_name'], $uploadDir.$fileName);
            
            // Rinominazione del file
            $estensione = ($file['type'] == 'image/jpg')? '.jpg':'.png';
            $nuovo_nome = $_SESSION['username'];
            rename($uploadDir.$file['name'], $uploadDir.$nuovo_nome.$estensione);
            
            $query = '
                UPDATE utenti
                SET imgPath = "'.$uploadDir.$nuovo_nome.$estensione . '"
                WHERE username = "'.$_SESSION['username']. '"
            ';
            
            $dbCon->query($query);
        }
    }

    header('Location: ./modifica_profilo.php');
?>