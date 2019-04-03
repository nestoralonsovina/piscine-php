<?php


class Tyrion extends Lannister
{
    public function with( $obj )
    {
        if (get_parent_class($obj) === 'Lannister')
            return ("Not even if I'm drunk !");
        else
            return "Let's do this.";
    }
}