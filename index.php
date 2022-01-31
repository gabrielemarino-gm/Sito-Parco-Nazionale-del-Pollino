<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8"> 
        <title>Pollino</title>
        <link rel="stylesheet" href="./css/stile.css" type="text/css" media="screen"> <!-- css -->
        <link rel="icon" href="./foto/Logo_ParcoPollino2.png">

    </head>
    
    <?php
        session_start();
        include './php/connection.php';
        $_SESSION['msg'] = '';
        $_SESSION['info'] = '';
        $_SESSION['verificato'] = '';


        $admin = 0;
        $guida = 0;
        $personale = "Login";
        $link = "php/login.php";
        if(isset($_SESSION['guida']) || isset($_SESSION['utente']))
        {
            $personale = "Profilo";
            $link = "php/areapersonale.php";
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
                <a href="./index.php"><img src="./foto/Logo_ParcoPollino2.png" alt="Logo"></a>
                <a href="./php/post.php">Post</a>
                <a href="./php/eventi.php">Eventi</a>
                <?php
 
                    if ($guida == 1)
                    {
                        print('<a href="php/scrivi_articolo.php">Scrivi Articolo</a>');    
                    }
                    
                    
                    if ($admin == 1)
                    {
                        print('<a href="php/scrivi_articolo.php">Scrivi Articolo</a>');  
                        print('<a href="php/valida_post.php">Valida Nuovi Post</a>');    
                        print('<a href="php/valida_guide.php">Valida Nuove Guide</a>');
                        print('<a href="php/valida_articoli.php">Valida Nuovi Articoli</a>');
                    }
                    
                    if ($personale == "Login")
                        print('<a href="php/register.php">Registrazione</a>'); // Registrazione
                    
                    print('<a href="' . $link .'">' . $personale . '</a>'); // Login / Profilo

                    if ($personale == "Profilo")
                        print('<a href="php/logout.php">Logout</a>'); 
                ?>
                 <a href="./html/manuale.html">Info</a>
            </nav>
        </aside>
        
        <?php
            $query = '
                SELECT *
                FROM articoli INNER JOIN utenti ON username = scrittore
                WHERE valido = 1
                ORDER BY data_articolo DESC
            ';

            $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");

            $i=0;
            while ($row = $result->fetch_array())
            {
                $immagini = '';
                if($row['img_path_articolo'] != null)
                {
                    $dir = './foto/articoli/'.$row['idarticoli'].'/';
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
                    
                    <article id="articolo-'.$i.'" class="articolo"  style="margin-top: 45px;">
                        <a href="./php/visualizza_articolo.php?id-articolo='.$row['idarticoli'].'">
                            '.$immagini.'
                            </a>
                        <h1>'.$row['titolo'].'</h1>
                    </article>');
                $i++;
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