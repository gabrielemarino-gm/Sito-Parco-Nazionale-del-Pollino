<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <link href="../css/stile.css" rel="stylesheet" type="text/css">
        <script src = "../javascript/validation.js"></script>
        <link rel="icon" href="../foto/Logo_ParcoPollino2.png">

        <title>
            Arrivederci
        </title>
    </head>

<body>
<?php
    session_start();
    include './connection.php';

    printf( '<div class="arrivederci_div">
                <p class="arrivederci_p">Arriverderci! Torna a trovarci!</p>
                <br>
                <form action="../index.php"> 
                    <input class="bottone-ciao" id="bottone-ciao" type="submit" value="Torna alla home"> 
                </form>
            </div>');
?>
</body>
</html>