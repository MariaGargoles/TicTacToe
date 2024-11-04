<?php
session_start();
if (!isset($_SESSION['playerX_wins'])) {
    $_SESSION['playerX_wins'] = 0;
}
if (!isset($_SESSION['playerO_wins'])) {
    $_SESSION['playerO_wins'] = 0;
}

if (isset($_POST['resetScore'])) {
    $_SESSION['playerX_wins'] = 0;
    $_SESSION['playerO_wins'] = 0;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tres en Raya</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./styles/style.css">
    <script src="./js/script.js" defer></script>
</head>

<body>
    <main class="containerboard">
        <h2 class="TicTacTitle">Tres en Raya</h2>
        <p id="message"></p>
        <article class="GameInfo">
            <p>Jugador X: <?php echo $_SESSION['playerX_wins']; ?></p>
            <p>Jugador O: <?php echo $_SESSION['playerO_wins']; ?></p>
            <br>
            <form class="form" method="post" action="">
                <button class="resetbutton" type="submit" name="resetScore">Reiniciar Marcador</button>
                <button class="resetgamebutton" type="button" onclick="resetGame()">Reiniciar Juego</button>
            </form>
        </article>
        <article class="gameboard">
            <?php for ($i = 0; $i < 9; $i++): ?>
            <div class="gamecell" data-index="<?php echo $i; ?>"></div>
            <?php endfor; ?>
        </article>
    </main>
</body>

</html>