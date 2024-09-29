<?php
require_once('./collegamentoDb-MysSQL.php'); 

$error_message = ''; // Variabile per memorizzare eventuali errori

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepara e esegui la query per recuperare la password cifrata
    $sql = $mysqli->prepare("SELECT password FROM utenti WHERE username = ?");

    if (!$sql) {
        die("Errore nella preparazione della query: " . $mysqli->error);
    }

    $sql->bind_param("s", $username);
    $sql->execute();
    $sql->store_result(); // Memorizza il risultato della query
    $sql->bind_result($hashed_password); // Associa il risultato della query alla variabile

    // Verifica se è stato trovato un risultato
    if ($sql->num_rows > 0) {
        $sql->fetch(); // Estrai la password cifrata

        // Confronta la password inserita con quella nel database usando SHA2
        if (hash('sha256', $password) === $hashed_password) {
            // Verifica se l'utente è quello autorizzato
            if ($username === 'AdminGabriel99') { // Qui puoi specificare l'username autorizzato
                // Password corretta, avvia una sessione
                session_start();
                $_SESSION['username'] = $username;
                header("Location: ./gestionale.php");
                exit();
            } else {
                $error_message = "Accesso non autorizzato per questo utente.";
            }
        } else {
            $error_message = "Nome utente o password errati.";
        }
    } else {
        // Nome utente o password errati
        $error_message = "Nome utente o password errati.";
    }

    $sql->close();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.min.css">
    <script src="./script_login.js"></script>
    <title>Login</title>
</head>
<body>
    <div id="login">
    <form action="#" method="post" id="form_login">
         <h1>LOGIN</h1>
        <input type="text" id="username" name="username" placeholder="Id utente">
        <div id="feedbackusername" ></div>
        <input type="password" id="password" name="password" placeholder="Inserisci la password">
        <div id="feedbackpassword" >
        <?php 
            if (!empty($error_message)) {
                echo '<span style="color: red">' . $error_message . '</span>';
            }
            ?>
        </div>
        <button type="submit" disabled="disabled" >Accedi</button>
    </form>
    </div>
</body>
</html>