<?php
    //
    // PART ONE
    //

    // We get the input from the site
    $input              = file_get_contents('inputs/day8.txt');

    $lines              = explode("\n", $input);
    $rect               = array_fill(0, 6, array_fill(0, 50, false));
    $lights_on          = 0;

    foreach($lines as $line) {
        if (preg_match_all('/rect (\d+)x(\d+)/i', $line, $matches)) {
            $length = (int) $matches[1][0];
            $height = (int) $matches[2][0];

            foreach($rect as $y_pos => $x) {
                if ($y_pos == $height) { break; }

                foreach($x as $x_pos => $light) {
                    if ($x_pos == $length) { break; }

                    $rect[$y_pos][$x_pos] = true;
                }
            }

        } else if (preg_match_all('/rotate (row|column) (x|y)=(\d+) by (\d+)/i', $line, $matches)) {
            switch ($matches[1][0]) {
                case 'row' :
                    $temp   = [];
                    $y_pos  = (int) $matches[3][0];

                    foreach($rect[$y_pos] as $x_pos => $light) {
                        $temp[($x_pos + (int) $matches[4][0])%50] = $rect[$y_pos][$x_pos];
                    }

                    ksort($temp);
                    $rect[$y_pos] = $temp;

                    break;
                case 'column' :
                    $temp   = [];
                    $x_pos  = (int) $matches[3][0];

                    foreach($rect as $y_pos => $x) {
                        $temp[($y_pos + (int) $matches[4][0])%6] = $rect[$y_pos][$x_pos];
                    }

                    ksort($temp);

                    foreach($temp as $y_pos => $x) {
                        $rect[$y_pos][$x_pos] = $temp[$y_pos];
                    }

                    break;
                default:
                    break;
            }
        }
    }
    foreach($rect as $y_pos => $x) {
        foreach($x as $x_pos => $light) {
            $lights_on += ($light) ? 1 : 0;
        }
        echo "\n";
    }

    echo "Part one : number of lights on : ".$lights_on;
    echo "\n";
    echo "\n";

    foreach($rect as $y_pos => $x) {
        foreach($x as $x_pos => $light) {
            echo ($light) ? "X" : " ";
        }
        echo "\n";
    }