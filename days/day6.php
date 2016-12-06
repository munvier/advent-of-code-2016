<?php
    //
    // PART ONE
    //

    // We get the input from the site
    $input              = file_get_contents('inputs/day6.txt');

    $lines              = explode("\n", $input);
    $characters         = [];
    $corrected_message  = "";

    foreach($lines as $line) {
        foreach( str_split($line) as $index => $char) {
            $chars = range('a', 'z');

            if (!isset($characters[$index]) || !is_array($characters[$index])) {
                $characters[$index] = [];
            }

            if (!isset($characters[$index][$char])) {
                $characters[$index][$char] = 0;
            }

            $characters[$index][$char] = $characters[$index][$char] + 1;
        }
    }


    foreach($characters as $index => $chars_array) {
        arsort($chars_array);
        reset($chars_array);

        $letter = key($chars_array);

        $corrected_message .= $letter;
    }

    echo "Part one : Corrected message is : '".$corrected_message."'";
    echo "\n";

    $characters         = [];
    $corrected_message  = "";

    foreach($lines as $line) {
        foreach( str_split($line) as $index => $char) {
            $chars = range('a', 'z');

            if (!isset($characters[$index]) || !is_array($characters[$index])) {
                $characters[$index] = [];
            }

            if (!isset($characters[$index][$char])) {
                $characters[$index][$char] = 0;
            }

            $characters[$index][$char] = $characters[$index][$char] + 1;
        }
    }


    foreach($characters as $index => $chars_array) {
        asort($chars_array);
        reset($chars_array);

        $letter = key($chars_array);

        $corrected_message .= $letter;
    }

    echo "Part one : Corrected message is : '".$corrected_message."'";