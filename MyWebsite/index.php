<!-- <?php
      require_once('./collegamentoDb-MysSQL.php');

      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $formMessage = '';

        // Prepara la query per inserire i dati nella tabella contattami
        $sql = 'INSERT INTO contattami (nome, cognome, email, messaggio) VALUES (?, ?, ?, ?)';
        $query = $mysqli->prepare($sql);

        // Controlla se la preparazione della query è riuscita
        if (!$query) {
          die("Errore nella preparazione della query di inserimento: " . $mysqli->error);
        }

        // Raccogli i dati dal form
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $email = $_POST['email']; // Corretto l'errore di battitura
        $msg = $_POST['msg'];

        // Esegui l'inserimento nella tabella
        $query->bind_param('ssss', $nome, $cognome, $email, $msg);

        if ($query->execute()) {
          // Ottieni l'ultimo ID inserito
          $last_id = $mysqli->insert_id;
          $formMessage = '<div style="color: green;">Dati inviati con successo!</div>';
          // Esegui il redirect per evitare l'inserimento duplicato
          header("Location: " . $_SERVER['PHP_SELF']);
          exit(); // Assicurati di terminare lo script dopo il redirect
        } else {
          $formMessage = '<div style="color: red;">Errore durante l\'inserimento: ' . $query->error . '</div>';
          echo "Errore durante l'inserimento dei dati: " . $query->error;
        }

        // Chiudi la query
        $query->close();
      }
      ?> -->

<!DOCTYPE html>
<html lang="it">

<head>
<script type="text/javascript">
var _iub = _iub || [];
_iub.csConfiguration = {"siteId":3779466,"cookiePolicyId":66032161,"lang":"it"};
</script>
<script type="text/javascript" src="https://cs.iubenda.com/autoblocking/3779466.js"></script>
<script type="text/javascript" src="//cdn.iubenda.com/cs/iubenda_cs.js" charset="UTF-8" async></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="./img/icon-sito.gif">
  <link rel="stylesheet" href="./style.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="./script_index.js"></script>
  <title>HomePage</title>
</head>

<body>
  <?php
  require('./menu.php');
  ?>
  <a id="home"></a>
  <div id="container">
    <div class="text-main-container">
      <h1>
        <span id="saluto"></span>, <br>
        MI CHIAMO <span class="span2">GABRIEL</span> E SONO UN <span class="span2">FULLSTACK DEVELOPER</span> .
      </h1>
      <p>-SEDE A ROMA | ITALIA-</p>
    </div>
  </div>
  <a id="about"></a>
  <div id="aboutme-container">
    <div class="img-aboutme">
    </div>
    <div class="text-aboutme">
      <h2>About Me</h2>
      <p>
        Sono sempre stato affascinato dalla
        tecnologia <br>
        in tutte le sue forme. Amo le sfide, ed è per questo che ho deciso di
        diventare uno sviluppatore fullstack. <br>
        Oltre alla programmazione, ho una grande passione per l'arte e il
        design, e presto particolare attenzione alle CTA, all'UX e
        all'ottimizzazione dell'esperienza utente. <br>
        Sarò al tuo fianco nello sviluppo del tuo progetto, assicurandomi che
        ogni dettaglio sia perfetto. "Innovare significa trasformare
        l'ordinario in straordinario.
      </p>
      <a href="./document/CV%20Da%20Developer.pdf" target="_blank">Leggi il mio curriculum</a>
    </div>
  </div>
  <a id="portfolio"></a>
  <div id="porfolio">
    <div id="ContentPortfolio">
      <div id="TextPortfolio">
        <h2>PORTFOLIO</h2>
        <p>Scopri il mio mondo di creazioni digitali, dove l'arte del codice incontra l'innovazione. Attraverso l'uso sapiente di linguaggi come HTML, CSS, JavaScript e PHP, do vita a progetti unici che combinano design elegante e funzionalità impeccabile. Ogni linea di codice è pensata per offrire esperienze web fluide e coinvolgenti, dal layout responsive alle animazioni interattive. Che tu stia cercando un sito web accattivante o un'applicazione web potente, esplora i miei lavori per vedere come trasformo idee in realtà digitale. Non perdere l'occasione di vedere come la tecnologia può diventare arte!</p>
        <a href="./portfolio.php">Guarda i miei lavori</a>
      </div>
      <div id="linguaggi">
        <a href="https://it.wikipedia.org/wiki/HTML5" class="linguaggio html" target="_blank">
          <img src="./img/html.png" alt="HTML">
          <p>HTML5</p>
        </a>
        <a href="https://it.wikipedia.org/wiki/CSS" class="linguaggio css" target="_blank">
          <img src="./img/css.png" alt="CSS">
          <p>CSS/SCSS </p>
        </a>
        <a href="https://it.wikipedia.org/wiki/JavaScript" class="linguaggio js" target="_blank">
          <img src="./img/js.png" alt="html5">
          <p>JAVASCRIPT</p>
        </a>
        <a href="https://it.wikipedia.org/wiki/PHP" class="linguaggio php" target="_blank">
          <img src="./img/php.png" alt="html5">
          <p>PHP</p>
        </a>
      </div>
    </div>
  </div>
  <a id="contattami"></a>
  <div id="contact">
    <ul>
      <li>
        <img src="./img/Logo-Gmail.png" alt="Gmail">
        <div class="text_Social">
          <p> Email:</p>
          <p> Gabriel.perini99@gmail.com </p>
        </div>
      </li>
      <li>
        <img src="./img/Logo-Cell.png" alt="Cellulare">
        <div class="text_Social">
          <p> Cellulare: </p>
          <p> +39 3770803501 </p>
        </div>
      </li>
      <li>
        <img src="./img/Logo-Linkedin.png" alt="Linkedin">
        <div class="text_Social">
          <p> Linkedin: </p>
          <p> Gabriel Perini </p>
        </div>
      </li>
      <li>
        <img src="./img/Logo-IG.png" alt="Instagram">
        <div class="text_Social">
          <p> Instagram: </p>
          <p> Gabriel Perini </p>
        </div>
      </li>
      <li>
        <img src="./img/facebook._negativepng.png" alt="facebook">
        <div class="text_Social">
          <p> facebook: </p>
          <p> Gabriel Perini </p>
        </div>
      </li>
    </ul>
    <form action="#" method="post" novalidate id="client_Form_Message">
      <h2>Contattami</h2>
      <input type="text" placeholder="Nome" name="nome" id="nome" required>
      <div id="feedbackNome"></div>
      <input type="text" placeholder="Cognome" name="cognome" id="cognome" required>
      <div id="feedbackCognome"></div>
      <input type="email" placeholder="Email" name="email" id="email" required>
      <div id="feedbackEmail"></div>
      <textarea name="msg" id="msg" placeholder="Scrivi qui..." maxlength="255"></textarea>
      <div id="feedbackMsg"></div>
      <div id="termini_e_condizioni">
        <label for="policy">Accetto i <a href="https://www.iubenda.com/termini-e-condizioni/66032161">termini e le condizioni d'uso</a></label>
        <input type="checkbox" id="policy" name="policy" required>
      </div>
      <div id="feedbackPolicy"></div>
      <div id="bottoni_Form">
        <button type="submit" name="Invia" id="invia">Invia</button>
        <button type="reset" name="pulisci">Pulisci</button>
      </div>
    </form>
  </div>
  <?php
  require('./footer.php');
  ?>
</body>

</html>