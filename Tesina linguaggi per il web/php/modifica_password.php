<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Utente</title>
    <link rel="stylesheet" href="../css/style_standard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="../css/style_header.css">
    <?php
        include('../res/header.php');
    ?>
</head>
<body>

<?php
require_once('../res/connection.php');
// Verifica se l'utente è loggato
if (!isset($_SESSION['id'])) {
    // Reindirizza l'utente alla pagina di accesso se non è loggato
    header("Location: login_cliente.php");
    exit();
}

$admin = $_SESSION['ammin'];

if(isset($_SESSION['errore_preg']) && $_SESSION['errore_preg'] == 'true'){
    echo "<h2>La password non rispetta i criteri di sicurezza!</h2>";
    unset($_SESSION['errore_preg']);
}    
?>
<div class="cont">
<?php
// Verifica se è stato fornito un ID utente valido
if (isset($_GET['id']) && is_numeric($_GET['id']) && ($admin == 0)) {
    $id_utente = $_GET['id'];

    // Esegui una query per ottenere i dati dell'utente
    $query = "SELECT * FROM utenti WHERE id = $id_utente";
    $result = $connessione->query($query);

    if ($result->num_rows == 1) {
        $utente = $result->fetch_assoc();
        ?>
 
        <h1 class="titolo"><div class="tooltip">
                    <span class="tooltiptext">LA PASSWORD DEVE SODDISFARE I SEGUENTI REQUISITI:
                        <ol>
                            <li>Deve essere lunga almeno 7 caratteri;</li>
                            <li>Deve contenere almeno una lettera maiuscola e una minuscola;</li>
                            <li>Deve contenere almeno un numero;</li>
                            <li>Deve contenere almeno un carattere speciale (!,@,#,$,%,^,&,*).</li>
                        </ol>       
                    </span>
                    <i id="simbolo" class="material-symbols-outlined">info</i>
                </div>
            Modifica Password</h1>
        <table>
            <tr>
                <td colspan="2">
                    <form class="form" action="processa_modifica_pass.php" method="post">
                    <input class="input" type="hidden" name="id" value="<?php echo $utente['id']; ?>">
                    <input style="width:200px;" class="input" type="text" id="password" name="password" placeholder="INSERISCI NUOVA PASSWORD !" required><br>
                        <br><br><br>
                        <input class="btn" type="submit" value="Salva Password">
                    </form>
                </td>
            </tr>
        </table>
        <?php
    } 
    else {
        echo '<h2>Utente non trovato.</h2>';
    }
}
 elseif (isset($_GET['id']) && ($admin == 1)) {
    $id_utente = $_GET['id'];
    $admin = $_SESSION['ammin'];

    // Esegui una query per ottenere i dati dell'utente
    $query = "SELECT * FROM utenti WHERE id = $id_utente";
    $result = $connessione->query($query);

    if ($result->num_rows == 1) {
        $utente = $result->fetch_assoc();
        $email = $utente['email']; // Ottieni l'email dall'array dell'utente
        ?>
 
    <h1 class="titolo"> <div class="tooltip">
                    <span class="tooltiptext">LA PASSWORD DEVE SODDISFARE I SEGUENTI REQUISITI:
                        <ol>
                            <li>Deve essere lunga almeno 7 caratteri;</li>
                            <li>Deve contenere almeno una lettera maiuscola e una minuscola;</li>
                            <li>Deve contenere almeno un numero;</li>
                            <li>Deve contenere almeno un carattere speciale (!,@,#,$,%,^,&,*).</li>
                        </ol>       
                    </span>
                    <i id="simbolo" class="material-symbols-outlined">info</i>
                </div>
        Modifica Password dell'account '<?php echo $email ?>'</h1>
        <table>
            <tr>
                <td colspan="2">
                    <form class="form" action="processa_modifica_pass.php" method="post">
                    <input class="input" type="hidden" name="id" value="<?php echo $utente['id']; ?>">
                    <input class="input" type="hidden" name="admin" value="<?php echo $admin ?>">
                    <input style="width:200px;" class="input" type="text" id="password" name="password" placeholder="INSERISCI NUOVA PASSWORD !" required><br>
                        <br><br><br>
                        <input class="btn" type="submit" value="Salva Password">
                    </form>
                </td>
            </tr>
        </table>
        <?php
    } 
    else {
        echo '<h2>Utente non trovato.</h2>';
    }
} 

$connessione->close();
?>
</div>

</body>
</html>