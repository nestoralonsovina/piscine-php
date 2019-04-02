<?php

class Vertex
{
    public static $verbose = False;
    private $_x = float;
    private $_y = float;
    private $_z = float;
    private $_w = 1.0;
    private $_color = Color;


    private function vertex_tostr() {
        $vertex = "Vertex( x: " . sprintf("%3.2f, y: %3.2f, z:%3.2f, w:%3.2f", $this->_x, $this->_y, $this->_z, $this->_w);
        if (self::$verbose) {
            $vertex .= ", " . $this->_color;
        }
        $vertex .= " )";
        return $vertex;
    }

    public function __construct( array $kwargs)
    {
        if (array_key_exists('x', $kwargs) && array_key_exists('y', $kwargs) && array_key_exists('z', $kwargs)) {
            $this->_x = $kwargs['x'];
            $this->_y = $kwargs['y'];
            $this->_z = $kwargs['z'];
        }

        if (array_key_exists('w', $kwargs)) {
            $this->_w = $kwargs['w'];
        }

        if (array_key_exists('color', $kwargs)) {
            $this->_color = $kwargs['color'];
        } else {
            $this->_color = new Color(array( 'red' => 255, 'green' => 255, 'blue' => 255 ));
        }
        if (self::$verbose) {
            print($this->vertex_tostr() . " constructed" .PHP_EOL);
        }
    }

    public function __toString()
    {
        return $this->vertex_tostr();
    }

    public static function doc() {
        return file_get_contents('Vertex.doc.txt');
    }

    public function __destruct()
    {
        if (self::$verbose) {
            print($this->vertex_tostr() . " destructed" . PHP_EOL);
        }
    }

}
