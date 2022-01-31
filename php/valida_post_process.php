<?php
    // gestione_post_process.php?id-post=2&accetta=Accetta
    session_start();
    include './connection.php';
    include './delete_dir.php';


    if ($_GET['bottone'] == 'Accetta')
    {
        // Seleziono 
        $query = "
            SELECT *
            FROM post_da_validare
            WHERE idpost_da_validare = ".$_GET['id-post']."
        ";

        $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
        $myPost = $result->fetch_array();
        echo 'Testo:    ' .$myPost['testo'];
        echo 'Data:     ' .$myPost['data'];
        echo 'imgPath:  ' .$myPost['img_path'];
        echo 'Username: ' .$myPost['username'];
        // Inserisco nella tabella dei post validi
        $query = "
                INSERT INTO post (testo, data, img_path, username)
                VALUES ('".$myPost['testo']."', '".$myPost['data']."', '".$myPost['img_path']."', '".$myPost['username']."')
            ";
    
        $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");

        // Elimino dalla tabella dei post non validi
        $query = "
            DELETE FROM post_da_validare
            WHERE idpost_da_validare = ".$_GET['id-post']."
        ";

        $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
    }
    else
    {
        $query = "
            DELETE FROM post_da_validare
            WHERE idpost_da_validare = ".$_GET['id-post']."
        ";

        $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
    }


    header('Location: ./valida_post.php');
    exit;
?>