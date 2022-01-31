<?php
    session_start();
    include './connection.php';

    $titolo = $_POST['titolo-articolo'];
    $testo = $_POST['testo-articolo'];
    $username = $_SESSION['username'];

    $query = '
                INSERT INTO articoli (titolo, testo_articolo, data_articolo, scrittore)
                VALUES ("'.$titolo.'" , "'.$testo.'" , now(), "'.$username.'")
            ';
    
    $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");

    // Se ci sono delle immagini, devo creare una cartella per quel post dove inserire tutte le immagini
    print_r($_FILES);
    if($_FILES['file']['size'][0] != 0)
    {
        // ( CREA CARTELLA
            $query = '
                    SELECT *
                    FROM articoli
                    WHERE testo_articolo = "'.$testo.'" AND scrittore = "'.$username.'"
                ';
        
            $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
            $myPost = $result->fetch_array();

            $dirname = "../foto/articoli/" .$myPost['idarticoli'] ;
            
            if (false === mkdir($dirname)) 
            {
                printf('Impossibile creare la directory %s', $dirname);
            }
        // )

        // creata la cartella devo aggiungerci le foto
        $nuovo_nome = 0;

        foreach ($_FILES['file']['name'] as $file) 
        {
            if(is_uploaded_file($_FILES['file']['tmp_name'][$nuovo_nome]))
            {    
                move_uploaded_file($_FILES['file']['tmp_name'][$nuovo_nome], $dirname.'/'.$_FILES['file']['name'][$nuovo_nome]);
            }
            
            // Rinominazione del file
            $estensione = ($_FILES['file']['type'][$nuovo_nome] == 'image/jpg')? '.jpg':'.png';
            rename($dirname.'/'.$_FILES['file']['name'][$nuovo_nome], $dirname.'/'.$nuovo_nome.$estensione);
            $nuovo_nome++;
        }

        // ( Inserisco il path della cartella delle foto nel DB
            $query = "
                        UPDATE articoli 
                        SET img_path_articolo = '".$dirname."'
                        WHERE idarticoli = ".$myPost['idarticoli']."
                    ";
            
            $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
        // )
    }

    $_SESSION['info'] = 'Articolo inviato con successo. In attesa di approvazione';
    header('Location: ./scrivi_articolo.php');
    exit;
?>