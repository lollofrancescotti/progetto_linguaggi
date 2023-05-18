<?php

$host = "localhost:3308"; //127.0.0.1
$username = "root";
$password = "";
$db = "prova";

echo "prima della connessione\n";
$connessione = new mysqli($host, $username, $password, $db);
echo "dopo della connessione\n";

if($connessione == false){
    die("Errore durante la connessione: ".$connessione->connect_error);
}

?>
