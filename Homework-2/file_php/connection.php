<?php
    $host = "localhost:3308"; //127.0.0.1
    $username = "root";
    $password = "";
    $db = "GameStation";

    $connessione = new mysqli($host, $username, $password, $db);

    if($connessione == false){
        die("Errore durante la connessione: ".$connessione->connect_error);
    }

?>
