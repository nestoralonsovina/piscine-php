<?php

class Ship
{
    use Serialize;

    private $_info;
    private $_file;

    public function __construct( $id = null )
    {
        $this->_file = 'database/spaceships.json';

        if ($id !== null) {
            $this->_info = $this->getJson($id);
            if ($this->_info === null) {
                header('Location: error.php');
            }
        }
    }

    public function getInformation() {return $this->_info; }
}
