<?php

class Vector
{
    public static $verbose = False;
    private $_x = 0.0;
    private $_y = 0.0;
    private $_z = 0.0;
    private $_w = 0.0;

    private function vector_tostr() {
        return (vsprintf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f )", array($this->_x, $this->_y, $this->_z, $this->_w)));

    }

    public function __construct( array $kwargs)
    {
        if (!array_key_exists('orig', $kwargs)) {
            $kwargs["orig"] = new Vertex(['x' => 0.0, 'y' => 0, 'z' => 0, 'w' => 1]);
        }


        $this->_x = $kwargs['dest']->getX() - $kwargs['orig']->getX();
        $this->_y = $kwargs['dest']->getY() - $kwargs['orig']->getY();
        $this->_z = $kwargs['dest']->getZ() - $kwargs['orig']->getZ();
        $this->_w = 0.0;

        if (self::$verbose) {
            print($this->vector_tostr() . " constructed" .PHP_EOL);
        }
    }

    public function __toString()
    {
        return $this->vector_tostr();
    }

    public function __destruct()
    {
        if (self::$verbose) {
            print($this->vector_tostr() . " destructed" . PHP_EOL);
        }
    }

    public function doc() {
       return (file_get_contents('Vector.doc.txt'));
    }

    public function magnitude() {
        return sqrt(pow($this->_x, 2) + pow($this->_y, 2) + pow($this->_z, 2));
    }

    public function normalize() {
        $norm = $this->magnitude();
        if ($norm == 1) {
            return clone $this;
        }
        return (new Vector(['dest' => new Vertex(['x' => $this->_x / $norm, 'y' => $this->_y / $norm, 'z' => $this->_z / $norm])]));
    }

    public function add(Vector $rhs) {
        return (new Vector(['dest' => new Vertex(['x' => $this->_x + $rhs->getX(), 'y' => $this->_y + $rhs->getY(), 'z' => $this->_z + $rhs->getZ()])]));
    }

    public function sub(Vector $rhs) {
        return (new Vector(['dest' => new Vertex(['x' => $this->_x - $rhs->getX(), 'y' => $this->_y - $rhs->getY(), 'z' => $this->_z - $rhs->getZ()])]));
    }

    public function opposite() {
        return (new Vector(['dest' => new Vertex(['x' => $this->_x * -1, 'y' => $this->_y * -1, 'z' => $this->_z * -1])]));
    }

    public function scalarProduct($k) {
        return (new Vector(['dest' => new Vertex(['x' => $this->_x * $k, 'y' => $this->_y * $k, 'z' => $this->_z * $k])]));
    }

    public function dotProduct(Vector $rhs) {
        return ($this->_x * $rhs->getX() + $this->_y * $rhs->getY() + $this->_z * $rhs->getZ());
    }

    public function cos(Vector $rhs) {
        return ($this->dotProduct($rhs) / ($this->magnitude() * $rhs->magnitude()));
    }

    public function crossProduct(Vector $rhs) {
        return (new Vector(['dest' => new Vertex(['x' => $this->_y * $rhs->getZ() - $this->_z * $rhs->getY(), 'y' => $this->_z * $rhs->getX() - $this->_x * $rhs->getZ(), 'z' => $this->_x * $rhs->getY() - $this->_y * $rhs->getX()])]));
    }

    public function getX() { return $this->_x; }

    public function getY() { return $this->_y; }

    public function getZ() { return $this->_z; }

    public function getW() { return $this->_w; }

}

