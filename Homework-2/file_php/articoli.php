<?php
        require_once("connection.php");
        session_start();

        if (!isset($_POST['azione'])) {
        
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

    if(!isset($_SESSION['loggato'])) {
    header("Location: ../HTML/login.html");
    }
     ?>
     
    <div id="contenuto">
    <div class="title">
    <a href="../HTML/index1.html"><img src="../img/home.png" alt="tasto_home" class="home"></a>

    <h2 class="mod">Articoli Disponibili</h2>

    <a href="cart.php"><img src="../img/cart_white.png" alt="tasto_cart" class="carrello"></a>

    <h3 class="mod1">GIOCHI</h2>
    <h4 class="mod2">CONSOLE</h2>
    <h5 class="mod3">MANGA</h2>

</div>
<video autoplay muted loop id="video_back">
    <source src="../video/video_sfondo.mp4" type="video/mp4"></source> 
</video>
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
                        <img src="../img/<?php echo ($row['id_articolo']); ?>.png" class="card"></img>
                        <p class="prezzo"><?php echo ($row['prezzo']); ?> &euro;</p>
                        <form class="ca" action="articoli.php#articoli<?php echo ($row['id_articolo']); ?>" method="post">
                        <input type="hidden" name="id_articolo" value="<?php echo ($row['id_articolo']); ?>" />
                          <input  type="number" name="quantita" value="0" min="0" step="1" size="3" max="99" />
                          <button type="submit" name="azione" value="aggiungi" class="carr">Aggiungi</button>
                        </form>
                      </div>
                <?php
                  }
                ?>
    </div>

    </body>
</html>