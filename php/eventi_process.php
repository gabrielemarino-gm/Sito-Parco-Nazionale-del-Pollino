<?php
    session_start();
    include './connection.php';
    
    $nome = $_POST['nome-evento'];
    $data = $_POST['data-evento'];
    $ora = $_POST['ora-evento'];
    $min = $_POST['min-evento'];
    $luogo = $_POST['luogo-evento'];
    $descrizione = $_POST['descrizione-evento'];
    $username = $_SESSION['username'];

    $query = '
        INSERT INTO eventi (nome_evento, luogo, data, descrizione, organizzatore, data_caricamento, ora, minuti)
        VALUES ("'.$nome.'" , "'.$luogo.'", "'.$data.'", "'.$descrizione.'", "'.$username.'", now(), '.$ora.', '.$min.')
    ';

    $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");


    if($_FILES['file']['size'][0] != 0)
    {
        // ( CREA CARTELLA
            $query = '
                    SELECT *
                    FROM eventi 
                    WHERE descrizione = "'.$descrizione.'" AND organizzatore = "'.$username.'"
                ';
        
            $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
            $myPost = $result->fetch_array();

            $dirname = "../foto/eventi/".$myPost['ideventi'];
            
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
                        UPDATE eventi 
                        SET img_path = '".$dirname."'
                        WHERE ideventi = ".$myPost['ideventi']."
                    ";
            
            $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
        // )
    }

    header('Location: ./eventi.php');

?>