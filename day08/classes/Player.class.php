<?php

interface IPlayer
{
    function getName();
    function addShip( $Ship );
    function getShips();
}

class Player implements IPlayer
{
    private $_name;
    private $_ships = array();


    public function __construct( $name )
    {
        $this->_name = $name;
    }

    public function getName() { return $this->_name; }

    public function addShip( $Ship ) { $this->_ships[] = $Ship; }

    public function getShips() { return $this->_ships; }
}
