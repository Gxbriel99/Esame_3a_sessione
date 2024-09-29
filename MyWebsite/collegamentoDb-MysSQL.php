<?php
$indirizzo = '31.11.39.174'; // Il percorso del DB
$utente = 'Sql1816201'; // Nome utente
$password = 'Abc$1234XY!z9'; // Password per l'utente root (vuota se non l'hai impostata)
$db = 'Sql1816201_1'; // Nome del database

$mysqli = new mysqli($indirizzo, $utente, $password, $db);
if ($mysqli->connect_error) {
    die('Si è verificato un errore (' . $mysqli->connect_errno . '): ' . $mysqli->connect_error);
}

