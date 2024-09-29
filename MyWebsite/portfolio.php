<?php
require_once('./collegamentoDb-MysSQL.php');

$sql_ArticoliPortfolio = 'SELECT * FROM shop WHERE eliminato = 0';
$query_Articoli = $mysqli->prepare($sql_ArticoliPortfolio);
$query_Articoli->execute();
$result = $query_Articoli->get_result();

// Chiudi la connessione
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="./img/icon-sito.gif">
  <link rel="stylesheet" href="./style.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript">
var _iub = _iub || [];
_iub.csConfiguration = {"siteId":3779466,"cookiePolicyId":66032161,"lang":"it"};
</script>
<script type="text/javascript" src="https://cs.iubenda.com/autoblocking/3779466.js"></script>
<script type="text/javascript" src="//cdn.iubenda.com/cs/iubenda_cs.js" charset="UTF-8" async></script>
  <title>Portfolio</title>
</head>

<body>
  <?php
  require('./menu.php');
  ?>

  <div id="store">
    <?php
    // Directory dove sono salvate le immagini
    $fileDirectory = 'imgFromForm'; // Modifica con il percorso corretto se necessario

    // Popola il portfolio con i post caricati sul db
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $titolo = htmlspecialchars($row['titolo']);
        $descrizione = htmlspecialchars($row['descrizione']);
        $titoloImg = htmlspecialchars($row['titoloImg']); // Nome dell'immagine
        $imagePath = $fileDirectory . DIRECTORY_SEPARATOR . $titoloImg; // Percorso completo dell'immagine

        echo '<div class="card_container">';
        echo '<img src="' . htmlspecialchars($imagePath) . '" alt="' . $titolo . '">'; 
        echo '  <div class="overlay">';
        echo '    <h3>' . $titolo . '</h3>';
        echo '    <p>' . $descrizione . '</p>';
        echo '    <a href="./item.php?Sito=' .$row['idPost']. '">CONTINUA A LEGGERE</a>';
        echo '  </div>';
        echo '</div>';
      }
    } else {
      echo "Non sono stati trovati articoli.";
    }
    ?>
  </div>

  <?php
  require('./footer.php');
  ?>
</body>

</html>
