<?php


abstract class Fighter
{
    private $type;

    abstract function fight($target);

    public function __construct($t)
    {
        $this->type = $t;
    }

    public function getType() { return $this->type; }
}