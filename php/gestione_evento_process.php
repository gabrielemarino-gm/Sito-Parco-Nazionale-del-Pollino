<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <link href="../css/stile.css" rel="stylesheet" type="text/css">
        <script src = "../javascript/post.js"></script>
        <script src = "../javascript/eventi.js"></script>
        <link rel="icon" href="../foto/Logo_ParcoPollino2.png">

        <title>
            Gestione Eventi
        </title>
    </head>

    <?php
        session_start();
        include './connection.php';
        $admin = 0;        

        $personale = "Login";
        $link = "login.php";
        if(isset($_SESSION['guida']) || isset($_SESSION['utente']))
        {
            $personale = "Profilo";
            $link = "areapersonale.php";
        }

        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
        {
            $admin = 1;
        }

        // ELIMINA
        if($_GET['bottone'] == 'Elimina')
        {
            $query = '
                DELETE FROM eventi
                WHERE ideventi = '.$_GET['id-evento'].'
            ';

            $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
            header('Location: ./eventi.php');
            exit;
        }
        else if($_GET['bottone'] == 'Iscriviti') //ISCRIVITI
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
                FROM iscrizione_evento
                WHERE idevento = '.$_GET['id-evento'].' AND username = "'.$username.'"
            ';

            $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
            if ($result->num_rows == 0) // Non sono iscritto, non posso eliminare 
            {
                $query = '
                    INSERT INTO iscrizione_evento (idevento, username)
                    VALUES('.$_GET['id-evento'].', "'.$_SESSION['username'].'")
                ';

                $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
                $tab = '<h1 style="color:green"> Iscrizione avvenuta con successo </h1>
                    <a class="torna-indietro" href="./eventi.php">Torna Indietro</a>';
            }
            else
            {
                $tab = '<h1 style="color:red"> Attenzione, sei già iscritto a questo evento </h1>
                    <a class="torna-indietro" href="./eventi.php">Torna Indietro</a>';
            }
        } // ELIMINA ISCRIZIONE
        else if ($_GET['bottone'] == 'Elimina Iscrizione')
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
                FROM iscrizione_evento
                WHERE idevento = '.$_GET['id-evento'].' AND username = "'.$username.'"
            ';

            $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
            
            if ($result->num_rows == 0) // Non sono iscritto, non posso eliminare 
            {
                $tab = '<h1 style="color:red"> Attenzione, non sei iscritto a questo evento </h1>
                        <a class="torna-indietro" href="./eventi.php">Torna Indietro</a>';
            }
            else
            {
                $query = '
                    DELETE FROM iscrizione_evento
                    WHERE idevento = '.$_GET['id-evento'].' AND username = "'.$username.'"
                ';

                $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");
                $tab = '<h1 style="color:green"> Hai annullato l\'iscrizione all\'evento</h1>
                        <a class="torna-indietro" href="./eventi.php">Torna Indietro</a>';
            }
        }
        else
        {
            $query = '
                SELECT *
                FROM iscrizione_evento i INNER JOIN utenti u ON i.username = u.username
                WHERE i.idevento = '.$_GET['id-evento'].'
            ';
            
            $result = $dbCon->query($query) or trigger_error($dbCon->error."[$query]");

            $tab = '<table>
                        <tr>
                            <td>Nome</td>
                            <td>Cognome</td>
                            <td>E-mail</td>
                        </tr>';
            
            while ($row = $result->fetch_array())
            {
                // Stampo una tabella con l'elenco degli iscritti
                $tab = $tab.'<tr>
                                <td>'.$row['nome'].'</td>
                                <td>'.$row['cognome'].'</td>
                                <td>'.$row['email'].'</td>
                            </tr>';
            }
        }
    ?>

    <body>
        <aside class="menu">
            <nav>
                <a href="../index.php"><img src="../foto/Logo_ParcoPollino2.png"></a>
                <a href="./post.php">Post</a>
                <a href="./sport.php">Sport</a>
                <a href="">Sentieri</a>
                <a href="">Cime</a>
                <?php
                    
                    if ($personale == "Login")
                        print('<a href="register.php">Registrazione</a>'); // Registrazione
                    
                    print('<a href="' . $link .'">' . $personale . '</a>'); // Login / Profilo

                    if ($personale == "Profilo")
                        print('<a href="logout.php">Logout</a>'); 
                    

                    if ($admin == 1)
                    {
                        print('<a href="valida_post.php">Valida Nuovi Post</a>');    
                        print('<a href="valida_guide.php">Valida Nuove Guide</a>');
                    }
                    
                ?>
            </nav>

                <?php 
                    print($tab);
                ?>
        </aside>
    <?php
        // gestione_evento_process.php?id-post=3&bottone=Elimina+Evento
        
    ?>
</body>
</html>