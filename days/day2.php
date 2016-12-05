<?php
    //
    // PART ONE
    //

    // We get the input from the site
    $input              = file_get_contents('inputs/day2.txt');

    $instructions_lines = explode("\n", $input);
    $digits             = [];

    $current_x_pos      = 1;
    $current_y_pos      = 1;

    foreach($instructions_lines as $instructions_line) {
        $instructions   = str_split($instructions_line);

        foreach($instructions as $instruction) {
            switch ($instruction) {
                case 'U' :
                    $current_y_pos--;
                    break;
                case 'D' :
                    $current_y_pos++;
                    break;
                case 'L' :
                    $current_x_pos--;
                    break;
                case 'R' :
                    $current_x_pos++;
                    break;
            }

            $current_x_pos = max(min($current_x_pos, 2), 0);
            $current_y_pos = max(min($current_y_pos, 2), 0);
        }

        $digits [] = $current_y_pos * 3 + ($current_x_pos + 1);
    }

    echo "Part one : Digicode is ".implode('', $digits);
    echo "\n";

    $digits             = [];
    $authorized_values  = [
        [ 0,   0,  "1",  0,   0],
        [ 0,  "2", "3", "4",  0],
        ["5", "6", "7", "8", "9"],
        [ 0,  "A", "B", "C",  0],
        [ 0,   0,  "D",  0,   0],
    ];

    $current_x_pos      = 3;
    $current_y_pos      = 3;

    foreach($instructions_lines as $instructions_line) {
        $instructions   = str_split($instructions_line);

        foreach($instructions as $index => $instruction) {
            switch ($instruction) {
                case 'U' :
                    if (isset($authorized_values[$current_y_pos - 1][$current_x_pos]) && $authorized_values[$current_y_pos - 1][$current_x_pos]) {
                        $current_y_pos--;
                    }
                    break;
                case 'D' :
                    if (isset($authorized_values[$current_y_pos + 1][$current_x_pos]) && $authorized_values[$current_y_pos + 1][$current_x_pos]) {
                        $current_y_pos++;
                    }
                    break;
                case 'L' :
                    if (isset($authorized_values[$current_y_pos][$current_x_pos - 1]) && $authorized_values[$current_y_pos][$current_x_pos - 1]) {
                        $current_x_pos--;
                    }
                    break;
                case 'R' :
                    if (isset($authorized_values[$current_y_pos][$current_x_pos + 1]) && $authorized_values[$current_y_pos][$current_x_pos + 1]) {
                        $current_x_pos++;
                    }
                    break;
            }
        }

        $digits [] = $authorized_values[$current_y_pos][$current_x_pos];
    }

    echo "Part two : Digicode is ".implode('', $digits);