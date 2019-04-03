<?php


class NightsWatch
{
    private $soldiers = array();

    public function recruit( $obj ) {
        if ($obj instanceof IFighter) {
            $obj->fight();
        }
    }

    public function fight() {
        foreach ($this->soldiers as $soldier) {
            $soldier->fight();
        }
    }
}