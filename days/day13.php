<?php
class Day13 {

    // We get the input from the site
    private $input              = 1350;
    private $length             = 1800;
    private $coef               = 1;
    private $image              = [];


    public function __construct() {
        $this->image = array_fill(0, $this->length, array_fill(0, $this->length, false));
    }
    public function start() {
        $this->set_walls();

        $this->write_image();
    }

    public function set_walls () {
        for($y = 0; $y < $this->length; $y++) {
            for($x = 0; $x < $this->length; $x++) {
                $this->image[$y][$x] = $this->isOdd($x, $y);
            }
        }
    }

    public function write_image () {
        $canvas = imagecreatetruecolor($this->length, $this->length);
        
        $white  = imagecolorallocate($canvas, 255, 255, 255);
        $black  = imagecolorallocate($canvas, 0, 0, 0);
        
        imagefilledrectangle($canvas, 0, 0, $this->length, $this->length, $white);

        foreach($this->image as $y_pos => $x) {
            foreach($x as $x_pos => $wall) {
                if ($wall) {
                    imagefilledrectangle  ($canvas, $x_pos, $y_pos, $x_pos + ($this->coef - 1), $y_pos + ($this->coef - 1), $black);
                }
            }
        }

        imagejpeg($canvas, 'day13.jpg', 100);
    }

    public function isOdd($x, $y) {
        $formulae   = $x * (3 + $x) + (2 * $x * $y) + $y + ($y * $y);
        
        $binary     = (string) decbin($formulae  + $this->input);
        
        $occurences = substr_count($binary, '1');

        return ($occurences % 2 == 1);
    }
}
    
$day = new Day13();
$day->start();