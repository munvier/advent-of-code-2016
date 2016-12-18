<?php
class Day18 {
    // We get the input from the site
    private $input                      = ".^^.^^^..^.^..^.^^.^^^^.^^.^^...^..^...^^^..^^...^..^^^^^^..^.^^^..^.^^^^.^^^.^...^^^.^^.^^^.^.^^.^.";
    private $rows                       = [];
    private $rows_max_length            = 40;
    private $index                      = 0;
    private $safes_tiles_count          = 0;
    private $characters_display_count   = 40;

    public function __construct() {
        $this->reset();
    }
    
    public function start() {
        $this->calculate_rows();

        echo "Part one : ".$this->safes_tiles_count." safes tiles";
        echo "\n";

        $this->reset();
        
        $this->rows_max_length = 400000;
        
        $this->calculate_rows();
        
        echo "Part two : ".$this->safes_tiles_count." safes tiles";
        echo "\n";
    }

    public function calculate_rows() {
        while ($this->index < $this->rows_max_length - 1) {
            $new_row = "";
            
            foreach(str_split($this->rows[$this->index]) as $char_index => $char) {
                $new_row .= $this->get_tile_type($char_index) ? '^' : '.';
            }
            
            $this->safes_tiles_count += substr_count($new_row, '.');
            
            $this->rows [] = $new_row;
            
            $this->index++;
            
            $percentage = round(($this->index + 1) * 100 / $this->rows_max_length);
            $filled     = round($percentage * $this->characters_display_count / 100);
            
            echo "[".str_repeat("#", $filled).str_repeat("_", $this->characters_display_count - $filled)."] ". $percentage."% \r";
        }
        
        echo "\n";
    }

    public function get_tile_type($char_index) {
        $row = $this->rows[$this->index];
        
        $left_tile      = ($char_index === 0) ? false : $row[$char_index - 1] === '^';
        $center_tile    = $row[$char_index] === '^';
        $right_tile     = ($char_index === strlen($row) - 1) ? false : $row[$char_index + 1] === '^';
        
        return (
                ($left_tile && $center_tile && !$right_tile)
                || (!$left_tile && $center_tile && $right_tile)
                || ($left_tile && !$center_tile && !$right_tile)
                || (!$left_tile && !$center_tile && $right_tile)
               );
        
    }

    public function output_map() {
        $safes_tiles_count = 0;
           
        foreach($this->rows as $index => $row) {
            echo str_pad($index, 2)." | ".$row."\n";
        }
        
    }

    public function reset() {
        $this->index                = 0;
        $this->rows                 = [];
        $this->rows []              = $this->input;
        
        $this->safes_tiles_count    = substr_count($this->input, '.');
    }

}
    
$day = new Day18();
$day->start();