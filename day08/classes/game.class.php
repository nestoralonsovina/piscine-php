<?php

require_once ('Serialize.php');
require_once('Ship.class.php');
require_once('Player.class.php');

class Game
{
    private $_players = array();

    function setPlayer( $Player ) { $this->_players[] = $Player; }

    function getPlayers() { return $this->_players; }

}
