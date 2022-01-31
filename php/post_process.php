<?php
    session_start();
    include './connection.php';
    
    $paroleNonAmmesse = array('stupido', 'Stupido', 'buono a nulla');

    $testo = $_POST['areatesto'];
    $username = $_SESSION['username'];

    // ( MODERATORE PAROLE
        foreach ($paroleNonAmmesse as $p)
        {
            if (strpos($testo, $p) !== false) 
            {
                $_SESSION['msg'] = 'Il post contiene parole non ammesse. Attendi l\'approvazione dell\'amministratore';

                $query = '
                    INSERT INTO post_da_validare (testo, data, username)
                    VALUES ("'.$testo.'" , now(), "'.$username.'")
                ';
        
                $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");


                if($_FILES['file']['size'][0] != 0)
                {
                    // ( CREA CARTELLA
                        $query = '
                                SELECT *
                                FROM post_da_validare 
                                WHERE testo = "$testo" AND username = "'.$username.'"
                            ';
                    
                        $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
                        $myPost = $result->fetch_array();

                        $dirname = "../foto/post/" .$myPost['idpost'] ;
                        
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
                                    UPDATE post_da_validare 
                                    SET img_path = '".$dirname."'
                                    WHERE idpost_da_validare  = ".$myPost['idpost']."
                                ";
                        
                        $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
                    // )
                }

                header('Location: ./post.php');
                exit;
            }
        }
    // )

    $query = '
                INSERT INTO post (testo, data, username)
                VALUES ("'.$testo.'" , now(), "'.$username.'")
            ';
    
    $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");


    // Se ci sono delle immagini, devo creare una cartella per quel post dove inserire tutte le immagini
    print_r($_FILES);
    if($_FILES['file']['size'][0] != 0)
    {
        // ( CREA CARTELLA
            $query = '
                    SELECT *
                    FROM post 
                    WHERE testo = "'.$testo.'" AND username = "'.$username.'"
                ';
        
            $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
            $myPost = $result->fetch_array();

            $dirname = "../foto/post/" .$myPost['idpost'] ;
            
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
                        UPDATE post 
                        SET img_path = '".$dirname."'
                        WHERE idpost = ".$myPost['idpost']."
                    ";
            
            $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
        // )
    }

    header('Location: ./post.php');
    exit;
?>