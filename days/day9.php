<?php
    //
    // PART ONE
    //

    // We get the input from the site
    $input              = file_get_contents('inputs/day8.txt');

    $tests = [
        'A(1x5)BC',
        'ADVENT',
        'A(2x2)BCD(2x2)EFG',
        '(6x1)(1x3)A',
        'X(8x2)(3x3)ABCY',
        'X(8x2)(3x3)ABCYX(8x2)(3x3)ABCY'
    ];

    foreach($tests as $test) {
        echo "TEST  : ".$test;
        echo "\n";

        $newString          = "";
        $nextPosToCompute   = 0;

        if (preg_match_all('/\((\d+)x(\d+)\)/i', $test, $matches, PREG_OFFSET_CAPTURE)) {
            foreach($matches[0] as $index => $marker) {
                $marker_string      = $matches[0][$index][0];
                $marker_pos         = $matches[0][$index][1];
                $string_length      = $matches[1][$index][0];
                $repetitions        = $matches[2][$index][0];

                if ($nextPosToCompute <= $marker_pos) {

                    $string_to_repeat   = substr($test, $marker_pos + strlen($marker_string), $string_length);
                    $newString .= substr($test, $nextPosToCompute, $marker_pos - $nextPosToCompute);


                    for($i = 0; $i < $repetitions; $i++) {
                        $newString .= $string_to_repeat;
                    }

                    $nextPosToCompute = $marker_pos + strlen($marker_string) + $string_length;
                }
            }
        }

        if ($nextPosToCompute < strlen($test)) {
            $newString .= substr($test, $nextPosToCompute);
        }

        echo "RESULT: ".$newString;
        echo "\n";
        echo "\n";
    }