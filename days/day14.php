<?php
class Day14 {

    // We get the input from the site
    private $input              = "ngcjuoqr";
    private $keys               = [];
    private $keys_max_length    = 64;
    private $index              = 0;
    private $hash_cache         = [];

    public function start() {
        $this->find_indexes();
        echo "\n";
        echo "Part one solution is ".($this->keys[63]);
        echo "\n";
        
        $this->reset();
        
        $this->find_indexes(true);
        echo "\n";
        echo "Part two solution is ".($this->keys[63]);
        echo "\n";
    }
    
    public function reset() {
        $this->hash_cache   = [];
        $this->keys         = [];
        $this->index        = 0;
    }
    
    public function getMD5($int, $is_part_two = false) {
        if (!isset($this->hash_cache[$int])) {
            if (!$is_part_two) {
                return $this->hash_cache[$int] = md5($this->input.$int);
            }

            $md5 = md5($this->input.$int);
            for($i=0;$i<2016;$i++) {
                $md5 = md5($md5);
            }
            return $this->hash_cache[$int] = $md5;
        }
        
        return $this->hash_cache[$int];
    }

    public function find_indexes($is_part_two = false) {
        while(count($this->keys) < $this->keys_max_length) {
            $currentMD5 = $this->getMD5($this->index, $is_part_two);
            if(preg_match('/(.)\1{2}/', $currentMD5, $matches)) {
                for($i=$this->index+1;$i<$this->index+1001;$i++) {
                    $md5 = $this->getMD5($i, $is_part_two);
                    if(preg_match('/('.$matches[1].')\1{4}/', $md5)) {
                        $this->keys [] = $this->index;
                        break;
                    }
                }
            }
            echo '['.str_repeat("#", count($this->keys)).str_repeat(".", $this->keys_max_length - count($this->keys))."]\r";
            $this->index++;
        }
    }
}
    
$day = new Day14();
$day->start();