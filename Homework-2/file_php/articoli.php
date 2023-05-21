<!DOCTYPE html> 
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="../file_css/style.css" />
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Articoli</title>
    </head>
    <body>

    <?php
    session_start();
    if(!isset($_SESSION['loggato'])) {
    header("Location: ../file_html/login.html");
    }
     ?>

    <?php
        require_once("connection.php");
        session_start();

        if (!isset($_POST['azione'])) {
            // Non fa niente
        }
        else if ($_POST['azione'] === 'aggiungi') {
            $id_articolo = $_POST['id_articolo'];
            $quantita = $_POST['quantita'];

            if (!isset($_SESSION['carrello'][$id_articolo])) {
                $_SESSION['carrello'][$id_articolo] = 0;
            }
            $_SESSION['carrello'][$id_articolo] += $quantita;
        }
    ?>

    <div id="contenuto">
    <a href="../file_html/index1.html"><button type="button"  value="Home" class="button-home">Home</button></a>
    <h2>Articoli Disponibili</h2>
    <div id="catalogo-articoli"> 

        <?php
            $query = "SELECT * FROM  articoli";
            $result = mysqli_query($connessione, $query);
            if (!$result) {
                printf("Errore nella query.\n");
               exit();
            }
 
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
      
        <div class="articoli">
            <img src="<?php echo ($row['path_foto']); ?>"  class="card" ></img>
            <p class="id"><?php echo ($row['id']); ?> </p>
            <p class="prezzo"><?php echo ($row['prezzo']); ?> &euro;</p>
        </div>

        <?php
          }
        ?>
    </div>

    </body>
</html>