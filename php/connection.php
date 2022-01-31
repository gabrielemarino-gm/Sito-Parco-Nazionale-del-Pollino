<?php
    $config = [
        'db_engine' => 'mysql',
        'db_host' => 'localhost',
        'db_name' => 'pollinoDB',
        'db_user' => 'root',
        'db_password' => '',
    ];

    $dbCon = new MySQLi($config['db_host'], $config['db_user'], $config['db_password'], $config['db_name']);

    if($dbCon->connect_errno) 
    {
        die("ERRORE : -> " .$dbCon->connect_error);
    }
?>