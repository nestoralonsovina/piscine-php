<?php

class Color
{
    public static $verbose = False;
    public $red = 0;
    public $green = 0;
    public $blue = 0;

    public function __construct(array $kwargs) {
        if (array_key_exists('rgb', $kwargs)) {
            $this->red = intval(($kwargs['rgb'] >> 16) & 255);
            $this->green = intval(($kwargs['rgb'] >> 8) & 255);
            $this->blue = intval($kwargs['rgb'] & 255);
        } else if ($kwargs['red'] !== NULL && $kwargs['green'] !== NULL && $kwargs['blue'] !== NULL) {
            foreach ($kwargs as $key => $val)
                $kwargs[$key] = intval($val);
            $this->red = round($kwargs['red']);
            $this->green = round($kwargs['green']);
            $this->blue = round($kwargs['blue']);
        }
        if ($this->red < 0)
            $this->red = 0;
        if ($this->green < 0)
            $this->green = 0;
        if ($this->blue < 0)
            $this->blue = 0;
        if ($this->red > 255)
            $this->red = 255;
        if ($this->green > 255)
            $this->green = 255;
        if ($this->blue > 255)
            $this->blue = 255;
        if (self::$verbose === True) {
            print('Color( red: '.sprintf("%3s",$this->red).', green: '.sprintf("%3s",$this->green).', blue: '.sprintf("%3s", $this->blue).' ) constructed.'.PHP_EOL);
        }
    }

    public function __toString()
    {
        return('Color( red: ' . sprintf("%3s", $this->red) .', green: ' . sprintf("%3s", $this->green) . ', blue: '. sprintf("%3s", $this->blue) .' )');

    }

    public function add(Color $c) {
        return new Color(['red' => $this->red + $c->red, 'green' => $this->green + $c->green, 'blue' => $this->blue + $c->blue]);
    }

    public function sub(Color $c) {
        return new Color(['red' => $this->red - $c->red, 'green' => $this->green - $c->green, 'blue' => $this->blue - $c->blue]);
    }

    public function mult($fact) {
        return new Color(['red' => $this->red * $fact, 'green' => $this->green * $fact, 'blue' => $this->blue * $fact]);
    }

    public static function doc() {
        return (file_get_contents('Color.doc.txt'));
    }

    public function __destruct()
    {
        if (self::$verbose === True) {
            print('Color( red: '.sprintf("%3s",$this->red).', green: '.sprintf("%3s",$this->green).', blue: '.sprintf("%3s", $this->blue).' ) destructed.'.PHP_EOL);

        }
    }
}
