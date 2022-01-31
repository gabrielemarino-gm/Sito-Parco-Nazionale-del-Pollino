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

<body>
    <?php
        session_start();
        include './connection.php';

        if (isset($_SESSION['guida']) || isset($_SESSION['utente'])) 
        {  
            header('Location: ../index.php');
            exit;
        } 
        else 
        {
            printf( '<div class="arrivederci_div">
                <p class="arrivederci_p">Non hai fatto il login</p>
                <br>
                <form action="../php/login.php"> 
                    <input class="bottone-ciao" id="bottone-ciao" type="submit" value="Fai il Login"> 
                </form>
            </div>');
        }
    ?>
</body>
</html>