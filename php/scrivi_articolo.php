<!DOCTYPE html>
<html lang="it">
    <head>
    <meta charset="utf-8">
    <link href="../css/stile.css" rel="stylesheet" type="text/css">
    <script src = "../javascript/post.js"></script>
    <script src = "../javascript/eventi.js"></script>
    <link rel="icon" href="../foto/Logo_ParcoPollino2.png">

        <title>
            Scrivi Articolo
        </title>
    </head>

    <?php
        session_start();
        include './connection.php';
        $admin = 0;  
        $guida = 0;    

        $personale = "Login";
        $link = "login.php";
        if(isset($_SESSION['guida']) || isset($_SESSION['utente']))
        {
            $personale = "Profilo";
            $link = "areapersonale.php";
        }      

        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
        {
            $admin = 1;
        }
        
        if (isset($_SESSION['guida']) && $_SESSION['guida'] == 1)
        {
            $guida = 1;
        }
    ?>

    <body>
        <aside class="menu">
            <nav>
                <a href="../index.php"><img src="../foto/Logo_ParcoPollino2.png" alt="Logo"></a>
                <a href="./post.php">Post</a>
                <?php
                    
                    if ($guida == 1)
                    {
                        print('<a href="php/scrivi_articolo.php">Scrivi Articolo</a>');    
                    }                    

                    if ($admin == 1)
                    {
                        print('<a href="./scrivi_articolo.php">Scrivi Articolo</a>');  
                        print('<a href="./valida_guide.php">Valida Nuove Guide</a>');
                        print('<a href="./valida_post.php">Valida Nuovi Post</a>');    
                        print('<a href="./valida_articoli.php">Valida Nuovi Articoli</a>');
                    }

                    if ($personale == "Login")
                        print('<a href="register.php">Registrazione</a>'); // Registrazione

                    print('<a href="' . $link .'">' . $personale . '</a>'); // Login / Profilo

                    if ($personale == "Profilo")
                        print('<a href="logout.php">Logout</a>'); 
                    
                ?>
            </nav>
        </aside>
    
        <div class="titolo-post">
            <h1>
                Scrivi Articolo 
            </h1>
        </div>


        <div class="box-inserimento-articolo">
            <form  method="POST" action="./scrivi_articolo_process.php" enctype="multipart/form-data">
                <input type="text" name="titolo-articolo" class="titolo-articolo" placeholder="Inserisci il titolo"> <br><br>
                <textarea class="testo-articolo" name="testo-articolo" placeholder="Inserisci il testo"></textarea><br>
                <input type="file" id="file-choosen" name="file[]" style="display:none">
                <input type="submit" value="Invia" class="bottone-invia-articolo" name="bottone-post">
            </form>
            <input type="submit" value="Scegli copertina" onclick="document.getElementById('file-choosen').click()" class="bottone-segli-immagine-articolo" name="bottone-segli-immagine">
        </div>

        <?php
            print('<p class="info-articolo">'.$_SESSION['info'].'</p>');
            $_SESSION['info'] = '';
        ?>
    </body>
</html>