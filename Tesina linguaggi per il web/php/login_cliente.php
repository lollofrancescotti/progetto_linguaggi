<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style_login.css">
    <link rel="stylesheet" href="../css/style_header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <?php
    include('../res/header.php');
    ?>
</head>

<body>
    <?php
    if (isset($_SESSION['errore_login']) && $_SESSION['errore_login'] == 'true') {
        echo '<h2>Errore in fase di login...</h2>';
        unset($_SESSION['errore_login']);
    }
    if (isset($_SESSION['registrazione_ok']) && $_SESSION['registrazione_ok'] == 'true') {
        echo '<h2 id="successo">Registrazione effettuata con successo!!!</h2>';
        unset($_SESSION['registrazione_ok']);
    }
    ?>
    <div class="cont">
        <div class="wrapper">
            <form action="../res/cliente_login.php" class="form" method="post">
                <h1 class="titolo">LOGIN</h1>
                <table>
                    <tr>
                        <td class="inp">
                            <input type="text" name="email" id="email" class="input" placeholder="Email">
                            <i class="fa_solid fa_user"></i>
                        </td>
                    </tr>
                    <tr>
                        <td class="inp">
                            <input type="password" name="password" id="password" class="input" placeholder="Password">
                            <i class="fa_solid fa_lock"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button class="submit" type="submit">Inizia la sessione</button>
                            <p class="footer">Non hai un account? <a href="registrazione_cliente.php" class="link">Per favore, Registrati</a></p>
                        </td>
                    </tr>
                </table>
            </form>
            <div class="banner">
                <table>
                    <tr>
                        <td>
                            <h1 class="wel_text">Benvenuto</h1>
                            <img src="../img/logo.PNG">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
