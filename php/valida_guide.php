<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <link href="../css/stile.css" rel="stylesheet" type="text/css">
        <script src = "../javascript/validation.js"></script>
        <link rel="icon" href="../foto/Logo_ParcoPollino2.png">

        <title>
            Valida Guide
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
                <a href="./scrivi_articolo.php">Scrivi Articolo</a>
                <a href="./valida_post.php">Valida Nuovi Post</a>
                <a href="./valida_articoli.php">Valida Nuovi Articoli</a>
                <a href="./areapersonale.php">Profilo</a>
                <a href="./logout.php">Logout</a>
            </nav>
        </aside>

        <h1 class="titolo-registrazione">
            Vaida Nuove Guide 
        </h1>

        <?php
            $query = "
                SELECT *
                FROM guide_da_validare
            ";
                
            $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
        
            while($row = $result->fetch_array())
            {
                if($row['non_validata'] != 1)
                {
                    print('
                        <div class="contenitore-guida">
                            <p class="nome-guida">'.$row['nome'] .' ' .$row['cognome'] .'</p>
                            <p class="email-guida">E-mail: ' .$row['email'] .'</p>
                            <p class="username-guida">Username: ' .$row['username'] .'</p>
                            <form action="valida_guide_process.php">
                                <input type="hidden" name="id" value="'.$row['id_guida_da_validare'].'">
                                <input type="hidden" name="bottone" value="accetta">
                                <input type="submit" class="accetta-guida" value="Accetta">
                            </form>
                            <form action="valida_guide_process.php">
                                <input type="hidden" name="id" value="'.$row['id_guida_da_validare'].'">
                                <input type="hidden" name="bottone" value="rifiuta">
                                <input type="submit" class="rifiuta-guida" value="Rifiuta">
                            </form>
                        </div>
                    ');
                }
            }    
        ?>

    </body>
</html>