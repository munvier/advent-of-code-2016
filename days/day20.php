<?php

    $input              = file_get_contents('inputs/day20.txt');

    $lines              = explode("\n", $input);

    $lines = array_map(function($line){
        return explode('-', $line);
    }, $lines);

    usort($lines, function($a, $b) {
        return $a[0] - $b[0];
    });

    $firstAllowedValue;
    $lastMax = -1;
    $count  = 0;
    $max = 4294967295;

    foreach($lines as $line) {
        $c = max([0, $line[0] - $lastMax - 1]);

        $count += $c;

        if (empty($firstAllowedValue) && $c) {
            $firstAllowedValue = $lastMax + 1;
        }

        $lastMax = max([$lastMax, $line[1]]);
    }

    $count += max([0, $max - $lastMax]);

    echo "Part one : First IP is ".$firstAllowedValue;
    echo "\n";
    echo "Part two : IPs count is ".$count;