<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <link href="../css/stile.css" rel="stylesheet" type="text/css">
        <script src = "../javascript/post.js"></script>
        <link rel="icon" href="../foto/Logo_ParcoPollino2.png">

        <title>
            Area Personale
        </title>
    </head>

    
    <?php
        session_start();
        include './connection.php';
        $admin = 0;     
        $guida = 0;   

        $personale = "Login";
        $link = "login.php";


        if( (isset($_SESSION['utente'])) || (isset($_SESSION['guida'])) ) 
        {
            $session_user = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');
            $session_id = (isset($_SESSION['utente']))? htmlspecialchars($_SESSION['utente']) : htmlspecialchars($_SESSION['guida']);
            $personale = "Profilo";
            $link = "areapersonale.php";
        } 
        else 
        {
            $session_user = "nobody";
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

        <div class="titolo-profilo">
            <h1>
                Area Personale 
            </h1>
        </div>
        
        <?php
            if ($session_user == "nobody")
            {
                printf( '<div class="arrivederci_div">
                            <p class="arrivederci_p">Non hai fatto il login</p>
                            <br>
                            <form action="../php/login.php"> 
                                <input class="bottone-ciao" id="bottone-ciao" type="submit" value="Fai il Login"> 
                            </form>
                        </div>');
            }
            else
            {
                $query = "
                            SELECT *
                            FROM utenti
                            WHERE username ='" .$_SESSION['username'] ."' 
                        ";
                
                // Oggetto mysqli_result
                $res = $dbCon->query($query);
                
                
                $row = $res->fetch_array() or trigger_error($dbCon->error."[$query]");
                
                print
                (
                    '<div class="contenitore-profilo">

                        <div class="img-profilo">
                            <img src="' .$row['imgPath'] .'" alt="Immagine del profilo di '.$row['nome'].'">
                        </div>
                
                        <div class="info-profilo">
                            <p>Username: ' .$row['username'] .'</p>
                            <p>Nome: ' .$row['nome'] .'</p>
                            <p>Cognome: ' .$row['cognome'] .'</p>
                            <p>E-mail: ' .$row['email'] .'</p>
                            <form action="confirm_login.php"> 
                                <input class="bottone-modifica" id="bottone-modifica" type="submit" value="Modifica Profilo"> 
                            </form>
                        </div>
                    </div>
            
                   <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>'
                );

                $query = "
                    SELECT *
                    FROM post p INNER JOIN utenti u ON p.username = u.username
                    WHERE p.username = '".$_SESSION['username']."'
                    ORDER BY p.data DESC
                ";
                    
                $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
            
                while($row = $result->fetch_array())
                {               
                    // badge guida
                    $badge = '<img src="../foto/1A1A1A.jpg" alt="Badge guida">';
                    if ($row['guida'] == 1) 
                        $badge = '<img src="../foto/guida.png" alt="Badge guida">';

                    // Controllo se c'è un percorso per immagini
                    $immagini = '';
                    if($row['img_path'] != null)
                    {
                        $dir = '../foto/post/'.$row['idpost'].'/';
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
                                                            <div class="mySlides-'.$row['idpost'].' fade" style="display:block"> 
                                                                <img src="'.$dir.$fileName.'" style="height:100%" alt="Immagine '.$i.'" class="img-slider"> 
                                                            </div>';
                                    }
                                    else
                                    {
                                        $immagini = $immagini.'
                                                            <div class="mySlides-'.$row['idpost'].' fade" style="display:none"> 
                                                                <img src="'.$dir.$fileName.'" style="height:100%" alt="Immagine '.$i.'" class="img-slider"> 
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
    
                    
                    // Calcolo dei mipiace
                    $query = '
                        SELECT COUNT(*) mipiace
                        FROM mi_piace
                        WHERE id_post = '.$row['idpost'].'
                    ';
                        
                    $resultMiPiace = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
                    $rowMiPiace = $resultMiPiace->fetch_array();
    
                    // Cerco i commenti di sotto al post
                    $queryCommenti = '
                        SELECT *
                        FROM commenti c INNER JOIN utenti u ON c.username = u.username
                        WHERE id_post = '.$row['idpost'].'
                        ORDER BY c.data_commento DESC
                    ';
                        
                    $resultCommenti = $dbCon->query($queryCommenti) or trigger_error($dbCon->error."[$queryCommenti]");
                    $nCommenti = $resultCommenti->num_rows;
                    
                    $commenti = '<form method="GET" action="./gestione_post_process.php">
                                    <input type="hidden" name="id-post" value="'.$row['idpost'].'">
                                    <input class="scrivi-commento" name="testo-commento" type="text" placeholder="Scrivi un commento" size="40" autocomplete="off" required>
                                    <input type="hidden" name="dove" value="profilo">
                                    <input type="submit" name="bottone" value=">>>" class="scrivi-commento">
                                </form>
                                <div id="contenitore-commenti-post-'.$row['idpost'].'" style="display:none">';
    
                    while($rowCommenti = $resultCommenti->fetch_array())
                    {
                        $commenti = $commenti . '   <div class="contenitore-foto-commento">
                                                        <img src="'.$rowCommenti['imgPath'].'" alt="Immagine del profilo di'.$rowCommenti['nome'].'">
                                                    </div>
                                                    <div class="testo-commento"> '.$rowCommenti['testo_commento'].' </div>';
                    }
                    $commenti = $commenti .'<input type="text" onclick="hideCommenti('.$row['idpost'].')" class="hide-commenti" value="Nascondi commenti">'.'</div>';
                    
                    
    
                    print('
                        <div class="contenitore-post">
                            <div class="contenitore-foto-post">
                                <img src="'.$row['imgPath'].'" alt="Immagine del profilo di '.$row['nome'].'">
                            </div>
                            <p class="nome-utente-post">'.$row['nome'].' '.$row['cognome'].'</p>
                            <div class="contenitore-badge-post">
                               '.$badge.'
                            </div>

                            <p class="data-post">'.$row['data'].'</p>
                            <div class="testo-post">'.$row['testo'].'</div>
                            
                                '.$immagini.'
                            <p class="numero-mi-piace"> '.$rowMiPiace['mipiace'].' like,    '.$nCommenti.' commenti</p>
                            <form action="./gestione_post_process.php">
                                <div class="box-bottoni-post">
                                    <input type="hidden" name="id-post" value="'.$row['idpost'].'">
                                    <input type="hidden" name="dove" value="profilo">
                                    <input type="submit" class="mi-piace" name="bottone" value="Mi Piace">
                                    <input type="submit" class="elimina" name="bottone" value="Elimina">
                                </div>
                            </form>
                            <input type="submit" onclick="visualizzaCommenti('.$row['idpost'].')" class="commenta" name="bottone" value="Commenti">
                            '.$commenti.'
                        </div>
                    ');
                }
            }


        ?>
        <br><br><br><br><br>
        <footer>
            <details>
                <summary>&copy; Copyright 2022.</summary>
                <p> - by Gabriele Marino. All Rights Reserved.</p>
                <p>All content and graphics on this web site are the property of Parco Nazionale Del Pollino.</p>
            </details>
        </footer>
    </body>
</html>