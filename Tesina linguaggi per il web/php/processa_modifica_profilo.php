<?php
session_start();
require_once('../res/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ricevi i dati del modulo inviati tramite POST
    $id_utente = $_POST['id'];
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $indirizzo = $_POST['indirizzo'];
    $cellulare = $_POST['cellulare'];
    $email = $_POST['email'];

    // Esegui una query per verificare se l'email è già presente nel database
    $query_email_esistente = "SELECT id FROM utenti WHERE email = ? AND id != ?";
    $stmt_email_esistente = $connessione->prepare($query_email_esistente);
    $stmt_email_esistente->bind_param("si", $email, $id_utente);
    $stmt_email_esistente->execute();
    $ris_email_esistente = $stmt_email_esistente->get_result();

    // Verifica se esiste già un utente con la stessa email (escluso l'utente attuale)
    if ($ris_email_esistente->num_rows > 0) {
        // Email già presente nel database
        $_SESSION['errore_email_ex'] = true;
        $_SESSION['email_errata'] = $email;
        header("Location: ../php/modifica_profilo.php?id=" . $id_utente);
        exit();
    }

    // Esegui una query per verificare se il numero di cellulare è già presente nel database
    $query_cellulare_esistente = "SELECT id FROM utenti WHERE cellulare = ? AND id != ?";
    $stmt_cellulare_esistente = $connessione->prepare($query_cellulare_esistente);
    $stmt_cellulare_esistente->bind_param("si", $cellulare, $id_utente);
    $stmt_cellulare_esistente->execute();
    $ris_cellulare_esistente = $stmt_cellulare_esistente->get_result();

    // Verifica se esiste già un utente con lo stesso numero di cellulare (escluso l'utente attuale)
    if ($ris_cellulare_esistente->num_rows > 0) {
        // Numero di cellulare già presente nel database
        $_SESSION['errore_cellulare_ex'] = true;
        $_SESSION['cellulare_errato'] = $cellulare;
        header("Location: ../php/modifica_profilo.php?id=" . $id_utente);
        exit();
    }

    // Se l'email e il numero di cellulare non sono già presenti nel database, procedi con l'aggiornamento dei dati dell'utente
    $query_aggiornamento = "UPDATE utenti SET nome = ?, cognome = ?, indirizzo_di_residenza = ?, email = ?, cellulare = ? WHERE id = ?";
    $stmt_aggiornamento = $connessione->prepare($query_aggiornamento);
    $stmt_aggiornamento->bind_param("sssssi", $nome, $cognome, $indirizzo, $email, $cellulare, $id_utente);

    if ($stmt_aggiornamento->execute()) {
        // Aggiornamento dei dati avvenuto con successo
        header("Location: gestione_profilo.php");
        exit();
    } else {
        // Errore durante l'aggiornamento dei dati
        echo 'Errore durante il salvataggio delle modifiche: ' . $stmt_aggiornamento->error;
    }

    $stmt_aggiornamento->close();
}

$connessione->close();
?>