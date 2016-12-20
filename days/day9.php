<?php
    // We get the input from the site
    $input              = trim(file_get_contents('inputs/day9.txt'));

    function get_length($string, $recursive = false) {
        $string_length          = strlen($string);
        $length                 = $string_length;

        for($i = 0; $i < $string_length; $i++) {
            if ($string[$i] !== '(') { continue; }

            preg_match('/^\((\d+)x(\d+)\)/i', substr($string, $i), $matches);

            $match_length               = $matches[1];
            $times                      = $matches[2];

            $start                      = $i + strlen($matches[0]);
            $to_repeat                  = substr($string, $start, $match_length);
            $decompressed_length        = $recursive ? get_length($to_repeat, true) : strlen($to_repeat);
            $length                     += ($decompressed_length * $times) - strlen($to_repeat) - strlen($matches[0]);

            $i = $start + strlen($to_repeat) - 1;
        }

        return $length;
    }

    echo "Part one : decompressed string length is ".get_length($input);
    echo "\n";
    echo "Part two : decompressed string length is ".get_length($input, true);