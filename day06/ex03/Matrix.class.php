<?php

class Matrix
{
    const IDENTITY = "IDENTITY";
    const SCALE = "SCALE";
    const RX = "Ox ROTATION";
    const RY = "Oy ROTATION";
    const RZ = "Oz ROTATION";
    const TRANSLATION = "TRANSLATION";
    const PROJECTION = "PROJECTION";

    private $_preset;

    private $_angle;

    private $_scale;

    private $_vtc;

    private $_ratio;
    private $_fov;
    private $_near;
    private $_far;

    protected $matrix = array();

    public static $verbose = False;

    public function __construct(array $kwargs = null)
    {
        if (isset($kwargs)) {
            if (isset($kwargs['preset']))
                $this->_preset = $kwargs['preset'];
            if (isset($kwargs['scale']))
                $this->_scale = $kwargs['scale']; if (isset($kwargs['angle']))
                $this->_angle = $kwargs['angle'];
            if (isset($kwargs['vtc']))
                $this->_vtc = $kwargs['vtc'];
            if (isset($kwargs['fov']))
                $this->_fov = $kwargs['fov'];
            if (isset($kwargs['ratio']))
                $this->_ratio = $kwargs['ratio'];
            if (isset($kwargs['near']))
                $this->_near = $kwargs['near'];
            if (isset($kwargs['far']))
                $this->_far = $kwargs['far'];
        }

        $this->createMatrix();

        if (self::$verbose) {
            if ($this->_preset == self::IDENTITY)
                echo "Matrix " . $this->_preset . " instance constructed\n";
            else
                echo "Matrix " . $this->_preset . " preset instance constructed\n";
        }

        $this->adjustMatrix();
    }
    function __toString()
    {
        $tmp = "M | vtcX | vtcY | vtcZ | vtxO\n";
        $tmp .= "-----------------------------\n";
        $tmp .= "x | %0.2f | %0.2f | %0.2f | %0.2f\n";
        $tmp .= "y | %0.2f | %0.2f | %0.2f | %0.2f\n";
        $tmp .= "z | %0.2f | %0.2f | %0.2f | %0.2f\n";
        $tmp .= "w | %0.2f | %0.2f | %0.2f | %0.2f";
        return (vsprintf($tmp, array($this->matrix[0], $this->matrix[1], $this->matrix[2], $this->matrix[3], $this->matrix[4], $this->matrix[5], $this->matrix[6], $this->matrix[7], $this->matrix[8], $this->matrix[9], $this->matrix[10], $this->matrix[11], $this->matrix[12], $this->matrix[13], $this->matrix[14], $this->matrix[15])));
    }

    public function __destruct()
    {
        if (self::$verbose) {
            print("Matrix instance destructed" . PHP_EOL);
        }
    }

    public function doc() {
        return file_get_contents('Matrix.doc.txt');
    }

    private function adjustMatrix() {
        switch ($this->_preset) {
            case self::IDENTITY:
                $this->identity();
                break;
            case self::TRANSLATION:
                $this->identity();
                $this->translation();
                break;
            case self::SCALE:
                $this->identity();
                $this->scale($this->_scale);
                break;
            case self::RX:
                $this->identity();
                $this->rotateX();
                break;
            case self::RY:
                $this->identity();
                $this->rotateY();
                break;
            case self::RZ:
                $this->identity();
                $this->rotateZ();
                break;
            case self::PROJECTION:
                $this->identity();
                $this->projection();
                break;
        }
    }

    private function rotateX() {
        $this->matrix[5] = cos($this->_angle);
        $this->matrix[6] = -sin($this->_angle);
        $this->matrix[9] = sin($this->_angle);
        $this->matrix[10] = cos($this->_angle);
    }

    private function projection() {
        $this->matrix[5] = 1 / tan(0.5 * deg2rad($this->_fov));
        $this->matrix[0] = $this->matrix[5] / $this->_ratio;
        $this->matrix[10] = -1 * (-$this->_near - $this->_far) / ($this->_near - $this->_far);
        $this->matrix[14] = -1;
        $this->matrix[11] = (2 * $this->_near * $this->_far) / ($this->_near - $this->_far);
        $this->matrix[15] = 0;
    }

    private function rotateY() {
        $this->matrix[0] = cos($this->_angle);
        $this->matrix[2] = sin($this->_angle);
        $this->matrix[8] = -sin($this->_angle);
        $this->matrix[10] = cos($this->_angle);
    }

    private function rotateZ() {
        $this->matrix[0] = cos($this->_angle);
        $this->matrix[1] = -sin($this->_angle);
        $this->matrix[4] = sin($this->_angle);
        $this->matrix[5] = cos($this->_angle);
    }

    private function translation() {
        $this->matrix[3] = $this->_vtc->getX();
        $this->matrix[7] = $this->_vtc->getY();
        $this->matrix[11] = $this->_vtc->getZ();
    }

    private function scale($scale) {
        $this->matrix[0] = $scale;
        $this->matrix[5] = $scale;
        $this->matrix[10] = $scale;
    }

    private function identity() {
        $this->matrix = [
            1.00, 0.00, 0.00, 0.00,
            0.00, 1.00, 0.00, 0.00,
            0.00, 0.00, 1.00, 0.00,
            0.00, 0.00, 0.00, 1.00
        ];
    }

    private function createMatrix() {
        $this->matrix = [
            0.00, 0.00, 0.00, 0.00,
            0.00, 0.00, 0.00, 0.00,
            0.00, 0.00, 0.00, 0.00,
            0.00, 0.00, 0.00, 0.00
        ];
    }

    public function mult(Matrix $rhs) {
        $tmp = array();
        for ($i = 0; $i < 16; $i += 4) {
            for ($j = 0; $j < 4; $j++) {
                $tmp[$i + $j] = 0;
                $tmp[$i + $j] += $this->matrix[$i + 0] * $rhs->matrix[$j + 0];
                $tmp[$i + $j] += $this->matrix[$i + 1] * $rhs->matrix[$j + 4];
                $tmp[$i + $j] += $this->matrix[$i + 2] * $rhs->matrix[$j + 8];
                $tmp[$i + $j] += $this->matrix[$i + 3] * $rhs->matrix[$j + 12];
            }
        }
        $m = new Matrix();
        $m->matrix = $tmp;
        return $m;
    }

    public function transformVertex(Vertex $vtx) {
        $tmp = array();
        $tmp['x'] = ($vtx->getX() * $this->matrix[0]) + ($vtx->getY() * $this->matrix[1]) + ($vtx->getZ() * $this->matrix[2]) + ($vtx->getW() * $this->matrix[3]);
        $tmp['y'] = ($vtx->getX() * $this->matrix[4]) + ($vtx->getY() * $this->matrix[5]) + ($vtx->getZ() * $this->matrix[6]) + ($vtx->getW() * $this->matrix[7]);
        $tmp['z'] = ($vtx->getX() * $this->matrix[8]) + ($vtx->getY() * $this->matrix[9]) + ($vtx->getZ() * $this->matrix[10]) + ($vtx->getW() * $this->matrix[11]);
        $tmp['w'] = ($vtx->getX() * $this->matrix[11]) + ($vtx->getY() * $this->matrix[13]) + ($vtx->getZ() * $this->matrix[14]) + ($vtx->getW() * $this->matrix[15]);
        $tmp['color'] = $vtx->getColor();
        $vertex = new Vertex($tmp);
        return $vertex;
    }
}