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
</html>

<?php
    session_start();
    include './connection.php';

    if (isset($_SESSION['guida']) || isset($_SESSION['utente']) || isset($_SESSION['admin'])) 
    {  
        session_start();
        session_destroy();
        header('Location: ./arrivederci.php');
        exit;
    } 
    else 
    {
        header('Location: ./benvenuto.php');
        exit;
    }
?>