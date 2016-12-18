<?php

    $input              = file_get_contents('inputs/day15.txt');
    
    $lines              = explode("\n", $input);
    $discs              = [];
    $isAligned          = false;
    $time               = 0;
    
    foreach ($lines as $line) {
        if (preg_match('/Disc #(\d+) has (\d+) positions; at time=0, it is at position (\d+)./i', $line, $matches)) {
            $discs[$matches[1] - 1] = array_fill(0, $matches[2], "#");
            
            $discs[$matches[1] - 1][$matches[3]] = ' ';
        }
    }
    
    while(!$isAligned) {
        foreach($discs as $index => &$disc) {
            $last = array_pop($disc);
            array_unshift($disc, $last);
        }
        
        if ($discs[0][0] === ' '
            && $discs[1][count($discs[1]) - 1] === ' '
            && $discs[2][count($discs[2]) - 2] === ' '
            && $discs[3][count($discs[3]) - 3] === ' '
            && $discs[4][count($discs[4]) - 4] === ' '
            && $discs[5][count($discs[5]) - 5] === ' ') {
            $isAligned = true;
            continue;
        }            
        
        $time++;
    }
    
    echo "Part one : ".$time;
    echo "\n";
    
    $input .= "\nDisc #7 has 11 positions; at time=0, it is at position 0.";
            
    $lines              = explode("\n", $input);
    $discs              = [];
    $isAligned          = false;
    $time               = 0;
    
    foreach ($lines as $line) {
        if (preg_match('/Disc #(\d+) has (\d+) positions; at time=0, it is at position (\d+)./i', $line, $matches)) {
            $discs[$matches[1] - 1] = array_fill(0, $matches[2], "#");
            
            $discs[$matches[1] - 1][$matches[3]] = ' ';
        }
    }
    
    while(!$isAligned) {
        foreach($discs as $index => &$disc) {
            $last = array_pop($disc);
            array_unshift($disc, $last);
        }
        
        if ($discs[0][0] === ' '
            && $discs[1][count($discs[1]) - 1] === ' '
            && $discs[2][count($discs[2]) - 2] === ' '
            && $discs[3][count($discs[3]) - 3] === ' '
            && $discs[4][count($discs[4]) - 4] === ' '
            && $discs[5][count($discs[5]) - 5] === ' '
            && $discs[6][count($discs[6]) - 6] === ' ') {
            $isAligned = true;
            continue;
        }            
        
        $time++;
    }
    
    echo "Part two : ".$time;
    echo "\n";