<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <link href="../css/stile.css" rel="stylesheet" type="text/css">
        <script src = "../javascript/validation.js"></script>
        <link rel="icon" href="../foto/Logo_ParcoPollino2.png">

        <title>
            Registrazione
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
                <a href="./eventi">Eventi</a>
                <a href="./scrivi_articolo.php">Scrivi Articolo</a>
                <a href="./valida_post.php">Valida Nuovi Post</a>
                <a href="./valida_guide.php">Valida Nuove Guide</a>
                <a href="./areapersonale.php">Profilo</a>
                <a href="./logout.php">Logout</a>
            </nav>
        </aside>

        <h1 class="titolo-registrazione">
            Valida Post 
        </h1>

        <?php
            $query = "
               SELECT *
               FROM post_da_validare p INNER JOIN utenti u ON p.username = u.username
               ORDER BY p.data DESC
           ";
               
           $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
       
           while($row = $result->fetch_array())
           {               
               // Controllo se c'è un percorso per immagini
               $immagini = '';
               if($row['img_path'] != null)
               {
                   $dir = '../foto/post/'.$row['idpost_da_validare'].'/';
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
                                                       <div class="mySlides-'.$row['idpost_da_validare'].' fade" style="display:block"> 
                                                           <img src="'.$dir.$fileName.'" alt="immagine-profilo-'.$i.'" style="height:100%" class="img-slider"> 
                                                       </div>';
                               }
                               else
                               {
                                   $immagini = $immagini.'
                                                       <div class="mySlides-'.$row['idpost_da_validare'].' fade" style="display:none"> 
                                                           <img src="'.$dir.$fileName.'" alt="immagine-profilo-'.$i.'" style="height:100%" class="img-slider"> 
                                                       </div>';
                               }
                               
                               $i++;
                           }
                       }
                       $immagini = $immagini.' <a class="prev" onclick="plusSlides(-1, '.$row['idpost_da_validare'].')">&#10094;</a>
                                               <a class="next" onclick="plusSlides(1, '.$row['idpost_da_validare'].')">&#10095;</a>
                                               </div>';

                   }
                   closedir($handler);
               }

               print('
                   <div class="contenitore-post">
                       <div class="contenitore-foto-post">
                           <img src="'.$row['imgPath'].'" alt="Immagine del profilo di '.$row['username'].'">
                       </div>
                       <p class="nome-utente-post">'.$row['nome'].' '.$row['cognome'].'</p>
                       <p class="data-post">'.$row['data'].'</p>
                       <p class="testo-post">'.$row['testo'].'</p>
                       
                           '.$immagini.'
                       
                       <form action="./valida_post_process.php">
                           <div class="box-bottoni-post" id="box-post">
                               <input type="hidden" name="id-post" value="'.$row['idpost_da_validare'].'">
                               <input type="submit" class="accetta-post" name="bottone" value="Accetta">
                               <input type="submit" class="rifiuta-post" name="bottone" value="Rifiuta">                   
                           </div>
                       </form>
                   </div>
               ');
           }
        ?>

    </body>
</html>