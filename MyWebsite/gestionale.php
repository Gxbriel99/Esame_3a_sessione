<?php

require_once('./collegamentoDb-MysSQL.php'); // Collegamento al database MySQL

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {

    // Prepara la query per inserire i dati nella tabella shop
    $sql_insertData = "INSERT INTO shop (titolo, descrizione, titoloImg, eliminato) VALUES (?, ?, ?, 0)";
    $query_insertData = $mysqli->prepare($sql_insertData);

    // Controlla se la preparazione della query è riuscita
    if (!$query_insertData) {
        die("Errore nella preparazione della query di inserimento: " . $mysqli->error);
    }

    // Raccogli i dati dal form
    $InsertTitolo = $_POST['titolo'];
    $InsertDescrizione = $_POST['descrizione'];
    $InsertTitoloImg = '';

    if (isset($_FILES) && count($_FILES) > 0) {
        $FileDirectory = __DIR__ . '/imgFromForm';
        foreach ($_FILES as $file) {
            if ($file['error'] === UPLOAD_ERR_OK) {
                $FileName = basename($file['name']);
                echo 'File salvato correttamente nella cartella' . '<br>' . $FileDirectory;
                move_uploaded_file($file['tmp_name'], $FileDirectory . DIRECTORY_SEPARATOR . $FileName);
                $InsertTitoloImg = $FileName;
            }
        }
    }


    // Esegui l'inserimento nella tabella
    $query_insertData->bind_param('sss', $InsertTitolo, $InsertDescrizione, $InsertTitoloImg);

    if ($query_insertData->execute()) {
        var_dump($InsertTitolo, $InsertDescrizione, $InsertTitoloImg);
        
        // Ottieni l'ultimo ID inserito
        $last_id = $mysqli->insert_id;
        // Esegui il redirect per evitare l'inserimento duplicato
        header("Location: " . $_SERVER['PHP_SELF']);
        exit(); // Assicurati di terminare lo script dopo il redirect
    } else {
        echo "Errore durante l'inserimento dei dati: " . $query_insertData->error;
    }

    // Chiudere la query
    $query_insertData->close();
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    // Prepara la query per modificare i dati nella tabella shop
    $sql_EditData = "UPDATE shop SET titolo=?, descrizione=?, titoloImg=? WHERE idPost=? AND eliminato=0";
    $query_EditData = $mysqli->prepare($sql_EditData);

    // Controlla se la preparazione della query è riuscita
    if (!$query_EditData) {
        die("Errore nella preparazione della query di modifica: " . $mysqli->error);
    }

    // Raccogli i dati dal form
    $EditIdPost = $_POST['editIdPost'];
    $EditTitolo = $_POST['editTitolo'];
    $EditDescrizione = $_POST['editDescrizione'];
    $EditTitoloImg = '';

    // Ottieni il nome dell'immagine esistente
    $sql_GetImage = "SELECT titoloImg FROM shop WHERE idPost = ? AND eliminato = 0";
    $query_GetImage = $mysqli->prepare($sql_GetImage);

    if (!$query_GetImage) {
        die("Errore nella preparazione della query: " . $mysqli->error);
    }

    $query_GetImage->bind_param('i', $EditIdPost);
    $query_GetImage->execute();
    $query_GetImage->bind_result($OldImageName);
    $query_GetImage->fetch();
    $query_GetImage->close();

    // Gestisci la nuova immagine
    if (isset($_FILES) && count($_FILES) > 0) {
        $FileDirectory = __DIR__ . '/imgFromForm';

        foreach ($_FILES as $file) {
            if ($file['error'] === UPLOAD_ERR_OK) {
                $FileName = basename($file['name']);

                // Elimina la vecchia immagine se esiste
                if (!empty($OldImageName)) {
                    $OldFilePath = $FileDirectory . DIRECTORY_SEPARATOR . $OldImageName;

                    if (file_exists($OldFilePath)) {
                        unlink($OldFilePath); // Elimina il file immagine esistente
                    }
                }

                // Salva la nuova immagine
                move_uploaded_file($file['tmp_name'], $FileDirectory . DIRECTORY_SEPARATOR . $FileName);
                $EditTitoloImg = $FileName;
            }
        }
    }

    // Associa i parametri alla query e esegui l'aggiornamento
    $query_EditData->bind_param('sssi', $EditTitolo, $EditDescrizione, $EditTitoloImg, $EditIdPost);

    if ($query_EditData->execute()) {
        // Esegui il redirect per evitare l'inserimento duplicato
        header("Location: " . $_SERVER['PHP_SELF']);
        exit(); // Assicurati di terminare lo script dopo il redirect
    } else {
        echo '<script>console.log("Errore di modifica: ' . $mysqli->error . '")</script>';
    }

    // Chiudere la query
    $query_EditData->close();
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Prepara la query per l'eliminazione dei dati nella tabella shop
    $sql_DeletePost = "UPDATE shop SET eliminato=1 WHERE idPost=?";
    $query_DeletePost = $mysqli->prepare($sql_DeletePost);

    // Controlla se la preparazione della query è riuscita
    if (!$query_DeletePost) {
        die("Errore nella preparazione della query di eliminazione: " . $mysqli->error);
    }

    // Raccogli i dati dal form
    $DeletePost = $_POST['deletepost'];

    // Ottieni il nome dell'immagine associata al post da eliminare
    $sql_GetImage = "SELECT titoloImg FROM shop WHERE idPost = ? AND eliminato = 0";
    $query_GetImage = $mysqli->prepare($sql_GetImage);
    $query_GetImage->bind_param('i', $DeletePost);
    $query_GetImage->execute();
    $query_GetImage->bind_result($ImageName);
    $query_GetImage->fetch();
    $query_GetImage->close();

    // Elimina l'immagine se esiste
    if (!empty($ImageName)) {
        $FileDirectory = __DIR__ . '/imgFromForm';
        $FilePath = $FileDirectory . DIRECTORY_SEPARATOR . $ImageName;

        if (file_exists($FilePath)) {
            unlink($FilePath); // Elimina il file immagine
        }
    }

    $query_DeletePost->bind_param('i', $DeletePost);
    if ($query_DeletePost->execute()) {
        echo '<script>console.log("Dati eliminati con successo!");</script>';
        // Esegui il redirect per evitare l'inserimento duplicato
        header("Location: " . $_SERVER['PHP_SELF']);
        exit(); // Assicurati di terminare lo script dopo il redirect
    } else {
        echo '<script>console.log("Errore di eliminazione: ' . $mysqli->error . '")</script>';
    }

    // Chiudere la query
    $query_DeletePost->close();
}


// Lista dei post
$listaPost = 'SELECT idPost, titolo, eliminato FROM shop WHERE eliminato=0';
$query_Lista_Post = $mysqli->query($listaPost);

// Chiudere la connessione al database
$mysqli->close();
?>


<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.min.css">
    <link rel="stylesheet" href="./style_gestionale.scss">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./script_gestionale.js"></script>
    <title>Pannello di controllo</title>
</head>

<body>
    <div id="container_gestionale">
        <div id="sidemenu">
            <a href="./index.php"><img src="./img/home.png" alt="home"></a>
            <ul>
                <li><button>Inserisci articolo</button></li>
                <li><button>Modifica articolo</button></li>
                <li><button>Elimina articolo</button></li>
            </ul>
        </div>
        <div id="section">
            <div id="insert">
                <form action="./gestionale.php" method="post" enctype="multipart/form-data">
                    <h1>Inserisci un articolo</h1>
                    <input type="text" name="titolo" placeholder="Inserisci il titolo" class="title">
                    <div class="feedbackTitle"></div>
                    <textarea name="descrizione" placeholder="Inserisci una descrizione del sito" class="msg" maxlength="254"></textarea>
                    <div class="feedbackMsg"></div>
                    <input type="file" name="upload" accept="image/png, image/jpeg" class="filesection">
                    <button type="submit" name="insert" class="invio">Invia</button>
                </form>
            </div>
            <div id="edit">
                <form action="./gestionale.php" method="post" enctype="multipart/form-data">
                    <h1>Modifica un articolo</h1>
                    <select name="editIdPost">
                        <option value="#">Seleziona un articolo</option>
                        <?php
                        // Popola il menu con le opzioni degli utenti
                        if (!$query_Lista_Post) {
                            echo "Non è stato trovato nessun utente";
                        } else {
                            while ($row = $query_Lista_Post->fetch_assoc()) {
                                echo '<option value="' . $row['idPost'] . '">' . $row['titolo'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <input type="text" name="editTitolo" placeholder="Inserisci il nuovo titolo" class="title">
                    <div class="feedbackTitle"></div>
                    <textarea name="editDescrizione" placeholder="Inserisci la nuova descrizione del sito" class="msg"></textarea>
                    <div class="feedbackMsg"></div>
                    <input type="file" name="editUpload" accept="image/png, image/jpeg" class="filesection">
                    <button type="submit" name="edit" class="invio">Invia</button>
                </form>
            </div>
            <div id="delete">
                <form action="./gestionale.php" method="post">
                    <h1>Elimina un articolo</h1>
                    <select name="deletepost" >
                        <option value="#">Seleziona un articolo da rimuovere</option>
                        <?php
                        // Popola il menu con le opzioni degli utenti
                        $query_Lista_Post->data_seek(0);
                        if (!$query_Lista_Post) {
                            echo "Non è stato trovato nessun utente";
                        } else {
                            while ($row = $query_Lista_Post->fetch_assoc()) {
                                echo '<option value="' . $row['idPost'] . '">' . $row['titolo'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <button type="submit" name="delete" onclick='alert("sei sicuro di voler rimuovere questo articolo? ")'> Invia</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>