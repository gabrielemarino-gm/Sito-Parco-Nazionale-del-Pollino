<?php
    session_start();
    require_once('./connection.php');

    $id = $_GET['id'];
    
    if ($_GET['bottone'] == 'Rifiuta')
    {
        $query = '
            DELETE FROM articoli
            WHERE idarticoli = '.$id.'
        ';

        $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
    }
    else if ($_GET['bottone'] == 'Accetta')
    { 
        $query = '
            UPDATE articoli
            SET valido = 1
            WHERE idarticoli = '.$id.'
        ';

        $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
    }

    header('Location: ./valida_articoli.php');
?>