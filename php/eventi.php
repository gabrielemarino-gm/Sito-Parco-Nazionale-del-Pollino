<!DOCTYPE html>
<html lang="it">
    <head>
    <meta charset="utf-8">
    <link href="../css/stile.css" rel="stylesheet" type="text/css">
    <script src = "../javascript/post.js"></script>
    <script src = "../javascript/eventi.js"></script>
    <link rel="icon" href="../foto/Logo_ParcoPollino2.png">

        <title>
            Eventi
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

        if (isset($_SESSION['guida']) && $_SESSION['guida'] == 1)
        {
            $guida = 1;
        }

        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
        {
            $admin = 1;
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
                Eventi 
            </h1>
        </div>

        <?php
            if(isset($_SESSION['guida']) && $_SESSION['guida'] == 1 || isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
            {
                print('
                    <div class="box-nuovo-post" id="box-nuovo-post">
                        <input onclick="visualizzaBoxEventi()" type="button" id="bottone" name="nuovopost" value="Crea un nuovo evento!">
                        <div id="box-input-file" class="box-bottone-scegli-immagine">
                        </div>
                        <form method="POST" action="./eventi_process.php" enctype="multipart/form-data">
                            <input type="file" id="file-choosen" name="file[]" multiple style="display:none">
                            <div id="box-nome-evento" class="box-nome-evento">
                            </div>
                            <div id="box-data-evento" class="box-data-evento">
                            </div>
                            <div id="box-ora-evento" class="box-ora-evento">
                            </div>
                            <div id="box-luogo-evento" class="box-luogo-evento">
                            </div>
                            <div id="box-descrizione-evento" class="box-descrizione-evento">
                            </div>
                            <div id="box-posta-evento" class="box-bottone-posta-evento">
                            </div>
                        </form>
                    </div>

                    <p class="errore-post">'.$_SESSION['msg'].'</p>
                ');

                $_SESSION['msg'] = '';
            }

            // Devo generare i vari eventi
            // Se sono la guida che ha creato l'evento posso anche eliminarlo
            $query = '
                SELECT *
                FROM eventi INNER JOIN utenti ON username = organizzatore
                ORDER BY data DESC
            ';
    
            $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
            
            while ($rowEventi = $result->fetch_array())
            {
                $button = '<input type="submit" class="button-organizzatore" name="bottone" value="Iscriviti">
                            <input type="submit" class="button-organizzatore" name="bottone" value="Elimina Iscrizione">';
                if ((isset($_SESSION['username']) && $_SESSION['username'] == $rowEventi['organizzatore']) || $admin == 1)
                    $button = '<input type="submit" class="button-organizzatore" name="bottone" value="Lista iscritti">
                                <input type="submit" class="button-organizzatore" name="bottone" value="Elimina">';

                // Controllo se c'è un percorso per immagini
                $immagini = '';
                if($rowEventi['img_path'] != null)
                {
                    $dir = '../foto/eventi/'.$rowEventi['ideventi'].'/';
                    $handler = opendir($dir);

                    if (false !== $handler) 
                    {
                        $immagini = $immagini.'<div class="slideshow-container">';
                        $i = 0;
                        while ($fileName = readdir($handler)) 
                        {
                            if ($fileName != '.' && $fileName != '..')
                            {
                                if ($i == 0)
                                {
                                    $immagini = $immagini.'
                                                        <div class="mySlides-'.$rowEventi['ideventi'].' fade" style="display:block"> 
                                                            <img src="'.$dir.$fileName.'" alt="Immagine '.$i.'" style="height:100%" class="img-slider"> 
                                                        </div>';
                                }
                                else
                                {
                                    $immagini = $immagini.'
                                                        <div class="mySlides-'.$rowEventi['ideventi'].' fade" style="display:none"> 
                                                            <img src="'.$dir.$fileName.'" alt="Immagine '.$i.'" style="height:100%" class="img-slider"> 
                                                        </div>';
                                }
                                
                                $i++;
                            }
                        }

                        if ($i > 1)
                        {
                            $immagini = $immagini.' <a class="prev" onclick="plusSlides(-1, '.$row['idpost'].')">&#10094;</a>
                                                    <a class="next" onclick="plusSlides(1, '.$row['idpost'].')">&#10095;</a>
                                                    ';
                        }

                        $immagini = $immagini.'</div>';

                    }
                    closedir($handler);
                }


                print('
                    <div class="contenitore-post">
                        <div class="contenitore-foto-post">
                            <img src="'.$rowEventi['imgPath'].'" alt="Immagine del profilo di '.$rowEventi['nome'].'">
                        </div>
                        <p class="nome-utente-post">'.$rowEventi['nome'].' '.$rowEventi['cognome'].'</p>
                        <div class="contenitore-badge-post">
                            <img src="../foto/guida.png" alt="Badge guida">
                        </div>
                        <h3 class="nome-evento">'.$rowEventi['nome_evento'].'</h3>
                        <p class="data-caricamento-evento">'.$rowEventi['data_caricamento'].'</p>
                        <p class="data-evento"> il '.$rowEventi['data'].' </p>
                        <p class="ora-evento"> alle '.$rowEventi['ora'].':'.$rowEventi['minuti'].' </p>
                        <p class="luogo-evento"> presso '.$rowEventi['luogo'].' </p>
                        <div class="testo-evento">'.$rowEventi['descrizione'].'</div>
                        
                            '.$immagini.'
                        
                        <form action="./gestione_evento_process.php">
                            <div class="box-bottoni-post">
                                <input type="hidden" name="id-evento" value="'.$rowEventi['ideventi'].'">
                                '.$button.'
                            </div>
                        </form>
                    </div>
                ');
            }
        ?>

        <br><br><br>
        <footer>
            <details>
                <summary>&copy; Copyright 2022.</summary>
                <p> - by Gabriele Marino. All Rights Reserved.</p>
                <p>All content and graphics on this web site are the property of Parco Nazionale Del Pollino.</p>
            </details>
        </footer>
    </body>
</html>