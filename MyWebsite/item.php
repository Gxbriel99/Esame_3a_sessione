<?php 
require_once('./collegamentoDb-MysSQL.php');

// Get the ID from the URL
$idPost = isset($_GET['Sito']) ? intval($_GET['Sito']) : 0;

// Prepare the SQL query to select the specific post
$sql = 'SELECT * FROM shop WHERE eliminato = 0 AND idPost = ?';
$query = $mysqli->prepare($sql);
$query->bind_param('i', $idPost);
$query->execute();
$result = $query->get_result();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style_item.min.css">
    <link rel="stylesheet" href="./style.min.css">
    <script src="./script_item.js"></script>
    <title>Item|</title>
</head>

<body>
    <?php require('./menu.php'); ?>

    <div id="container_item">
        <div id="item">
            <?php if ($result->num_rows > 0): ?>
                <?php $row = $result->fetch_assoc(); ?>
                <div id="imgcontainer">
                    <img src="imgFromForm/<?php echo htmlspecialchars($row['titoloImg']); ?>" alt="<?php echo htmlspecialchars($row['titolo']); ?>">
                </div>
                <div id="descrizione">
                    <h1><?php echo htmlspecialchars($row['titolo']); ?></h1>
                    <button id="pulsante">Descrizione del sito <span>+</span></button>
                    <p class="desc" style="display: none;"><?php echo htmlspecialchars($row['descrizione']); ?></p>
                    <button id="pulsante">Caratteristiche del sito <span>+</span></button>
                    <p class="desc" style="display: none;">Il sito è progettato per essere completamente responsive, garantendo un'ottima visualizzazione su dispositivi mobili e desktop. Presenta animazioni fluide che migliorano l'esperienza utente.</p>
                    <a href="#">Visita il sito</a>
                </div>
            <?php else: ?>
                <p>Articolo non trovato.</p>
            <?php endif; ?>
        </div>
    </div>
    
    <?php require('./footer.php'); ?>
</body>
</html>


<!-- ho inserito il testo tramite html per 2 ragioni: 
1° non ho ancora popolato il mio portfolio pertanto non qualcosa di reale di cui parlare
2° per mancanza di tempo (essendo che questo è un esame) ho deciso di muovermi cosi,è sottointeso dire che appena 
popolerò il portfolio il gestionale e il relativo DB daranno aggiornati per implentare le nuove colonne ma fino 
ad allora ho mostrato come sarebbe stato direttamente il risultato finale -->