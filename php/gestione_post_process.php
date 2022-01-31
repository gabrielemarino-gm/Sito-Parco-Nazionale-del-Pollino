<?php

    session_start();
    include './connection.php';
    include './delete_dir.php';
    
    if($_GET['bottone'] == 'Elimina') // Faccio la query per eliminare il post
    {
        if (isset($_SESSION['username']))
        {
            $username = $_SESSION['username'];
        }
        else
        {
            header('Location: ./operazione_per_utente.php');
            exit;
        }


        $query = "
            DELETE FROM post
            WHERE idpost = ".$_GET['id-post']."
        ";

        $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
        
        // Elimino la cartella con le foto se esite
        delete_dir("../foto/post/".$_GET['id-post']);
    }
    else if ($_GET['bottone'] == 'Mi Piace')
    {
         if (isset($_SESSION['username']))
        {
            $username = $_SESSION['username'];
        }
        else
        {
            header('Location: ./operazione_per_utente.php');
            exit;
        }


        $query = '
            SELECT *
            FROM mi_piace
            WHERE id_post = '.$_GET['id-post'].'
                  AND
                  username = "'.$_SESSION['username'].'"
        ';

        $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
        $row = $result->fetch_array();
        
        echo $result->num_rows;

        if ($result->num_rows == 0) // Se il mi piace non c'e' lo aggiungo
        {
            $query = '
                INSERT INTO mi_piace (id_post, username)
                VALUES('.$_GET['id-post'].', "'.$_SESSION['username'].'")
            ';

            $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
        }
        else // Se il mi piace c'e' lo tolgo
        {
            $query = '
                DELETE FROM mi_piace
                WHERE id_post = '.$_GET['id-post'].'
                      AND
                      username = "'.$_SESSION['username'].'"
            ';

            $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
        }
    }
    else if ($_GET['bottone'] == '>>>')
    {       
        if (isset($_SESSION['username']))
        {
            $username = $_SESSION['username'];
        }
        else
        {
            header('Location: ./operazione_per_utente.php');
            exit;
        }

        
        $query = '
            INSERT INTO commenti (id_post, testo_commento, data_commento, username)
            VALUES('.$_GET['id-post'].', "'.$_GET['testo-commento'].'", now(), "'.$_SESSION['username'].'")
        ';

        $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
    }
    
    
    if ($_GET['dove'] == 'post')
        header('Location: ./post.php');
    else
        header('Location: ./areapersonale.php');
        
    exit;
?>