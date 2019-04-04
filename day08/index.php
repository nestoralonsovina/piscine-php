<?php

include 'classes/Game.class.php';

session_start();


$game = new Game();

$p1 = new Player("p1");
$p1->addShip( new Ship(1));
?>


<?php include 'includes/header.php'; ?>

<div class="gameBoard">

</div>

<?php include 'includes/footer.php'; ?>



