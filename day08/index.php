<?php

include 'classes/Game.class.php';

session_start();

if (isset($_SESSION['game'])) {
    $Game = $_SESSION['game'];
} else {
    $Game = new Game();

    $p1 = new Player("Player1");
    $p2 = new Player("Player2");
    $p1->addShip( new Ship(1));
    $p2->addShip( new Ship(1));

    $Game->setPlayer($p1);
    $Game->setPlayer($p2);
}

?>


<?php include 'includes/header.php'; ?>

<div class="gameBoard">

</div>

<?php include 'includes/footer.php'; ?>



