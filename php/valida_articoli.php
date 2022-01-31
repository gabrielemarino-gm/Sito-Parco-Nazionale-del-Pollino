<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <link href="../css/stile.css" rel="stylesheet" type="text/css">
        <script src = "../javascript/validation.js"></script>
        <link rel="icon" href="../foto/Logo_ParcoPollino2.png">

        <title>
            Valida Articoli
        </title>
    </head>

    <?php
        session_start();
        include './connection.php';

        if (isset($_SESSION['admin']) && $_SESSION['admin'] != 1)
        {
            header('Location: ./operazione_per_admin.php');
            exit;
        }
    ?>

    <body>
        <aside class="menu">
            <nav>
                <a href="../index.php"><img src="../foto/Logo_ParcoPollino2.png" alt="Logo"></a>
                <a href="./post.php">Post</a>
                <a href="./eventi.php">Eventi</a>
                <a href="./scrivi_articoli.php">Scrivi Articolo</a>
                <a href="./valida_guide.php">Valida Nuove Guide</a>
                <a href="./valida_post.php">Valida Nuovi Post</a>
                <a href="./areapersonale.php">Profilo</a>
                <a href="./logout.php">Logout</a>
            </nav>
        </aside>

        <h1 class="titolo-registrazione">
            Vaida Nuovi Articoli 
        </h1>

        <?php
            $query = "
                SELECT *
                FROM articoli a INNER JOIN utenti ON scrittore = username
                WHERE valido = 0
            ";
                
            $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
        
            while($row = $result->fetch_array())
            {
                
                print('
                    <div class="contenitore-articolo-valida">
                        <p class="Titolo Articolo">'.$row['titolo'].' | By: '.$row['nome'].' '.$row['cognome'].'</p>
                        <form action="valida_articoli_process.php">
                            <input type="hidden" name="id" value="'.$row['idarticoli'].'">
                            <input type="submit" name="bottone" class="accetta-articolo" value="Accetta">
                            <input type="submit" name="bottone" class="rifiuta-articolo" value="Rifiuta">
                        </form>
                        <form action="visualizza_articolo.php">
                            <input type="hidden" name="id-articolo" value="'.$row['idarticoli'].'">
                            <input type="submit" name="bottone" class="visualizza-articolo" value="Visualizza">
                        </form>
                    </div>
                ');
                
            }    
        ?>

    </body>
</html>