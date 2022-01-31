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
                <a href="./eventi.php">Eventi</a>
                <?php
                    if ($guida == 1)
                    {
                        print('<a href="./scrivi_articolo.php">Scrivi Articolo</a>');    
                    }

                    if ($admin == 1)
                    {
                        print('<a href="./scrivi_articolo.php">Scrivi Articolo</a>');  
                        print('<a href="./valida_post.php">Valida Nuovi Post</a>');    
                        print('<a href="./valida_guide.php">Valida Nuove Guide</a>');
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
            </h1>
        </div>

        <?php
            $query = '
                SELECT *
                FROM articoli INNER JOIN utenti ON username = scrittore
                WHERE idarticoli = '.$_GET['id-articolo'].'
            ';

            $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
            $row = $result->fetch_array();
                
            print('
                    <div class="titolo-post">
                        <h1>
                            '.$row['titolo'].' 
                        </h1>
                    </div>
                ');
            
            // Vado a ripescare la foto
            $immagini = '';
            $i=0;
            if($row['img_path_articolo'] != null)
            {
                $dir = '../foto/articoli/'.$row['idarticoli'].'/';
                $handler = opendir($dir);

                if (false !== $handler) 
                {
                    while ($fileName = readdir($handler)) 
                    {
                        if ($fileName != '.' && $fileName != '..')
                        {
                            
                            $immagini = '<img src="'.$dir.$fileName.'" alt="Immagine '.$i.'" style="height:100%" class="img-slider"> ';
                 
                        }
                    }
                }
                closedir($handler);
            }

            print('
                    <div class="foto-articolo">
                            '.$immagini.' 
                    </div>

                    
                    <article class="testo-articolo">
                        <p class="data-articolo">'.$row['data_articolo'].'</p>
                        '.$row['testo_articolo'].' 
                        <p class="scrittore-articolo">'.$row['nome'].' '.$row['cognome'].'</p>
                    </article>

            ');

        ?>

    <br><br><br><br><br><br>
    <footer>
        <details>
            <summary>&copy; Copyright 2022.</summary>
            <p> - by Gabriele Marino. All Rights Reserved.</p>
            <p>All content and graphics on this web site are the property of Parco Nazionale Del Pollino.</p>
        </details>
    </footer>
    </body>
</html>