<?php
    session_start();
    require_once('./connection.php');

    $id = $_GET['id'];
    
    if ($_GET['bottone'] == 'accetta')
    {
        $query = "
                    SELECT *
                    FROM guide_da_validare
                    WHERE id_guida_da_validare = ".$id."
                ";
                    
        $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
        $row = $result->fetch_array();
    
        $query = "
            INSERT INTO utenti
            VALUES (0, '".$row['username']."' , '".$row['password']."', '".$row['email']."', '1', '".$row['nome']."', '".$row['cognome']."', 0, '../foto/profilo/default.png')
        ";
    
        $risultato = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
    
    
        $query = "
                    DELETE FROM guide_da_validare
                    WHERE id_guida_da_validare = ".$id."
                ";
                    
        $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
    }
    else if ($_GET['bottone'] == 'rifiuta')
    { 

        $query = '
            UPDATE guide_da_validare
            SET non_validata = 1
            WHERE id_guida_da_validare = '.$id.'
        ';

        $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
    }

    header('Location: ./valida_guide.php');
?>