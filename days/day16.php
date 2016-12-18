<?php
class Day16 {
    // We get the input from the site
    private $input                      = "10001001100000001";
    private $filled_disc_input          = "";
    private $checksum                   = "";
    private $disc_length                = 272;

    public function __construct() {
    }
    
    public function start() {
        $this->get_filled_disc_input();
        $this->set_checksum();
        
        echo "Part one : checksum is ".$this->checksum;
        echo "\n";
        
        $this->reset();
        
        $this->disc_length = 35651584;
        
        //$this->get_filled_disc_input(); // MEMORY DISASTER
        //$this->set_checksum();
        
        //echo "Part two : checksum is ".$this->checksum;
        //echo "\n";
    }

    public function get_filled_disc_input() {
        $input = $this->input;
        
        while(strlen($input) < $this->disc_length) {
            $input = $this->tamper($input);
        }
        
        $this->filled_disc_input = substr($input, 0, $this->disc_length);
    }

    public function tamper($input) {
        $a = $input;
        $b = str_split($a);
        
        foreach($b as $char) {
            $char = (string) (1 - (int) $char);
        }
        
        return $a.'0'.implode($b);
    }

    public function set_checksum() {
        $checksum = $this->filled_disc_input;
        
        while(strlen($checksum) % 2 === 0) {
            $new_input = "";
            
            for($i = 0; $i < strlen($checksum); $i += 2) {
                $new_input .= ($checksum[$i] == $checksum[$i + 1]) ? '1' : '0';
            }
            
            $checksum = $new_input;
        }
        
        $this->checksum = $checksum;
    }

    public function reset() {
        $this->filled_disc_input = "";
        $this->checksum          = "";
    }

}
    
$day = new Day16();
$day->start();