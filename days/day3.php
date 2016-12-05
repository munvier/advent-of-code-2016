<?php
    //
    // PART ONE
    //

    // We get the input from the site
    $input                  = file_get_contents('inputs/day3.txt');

    $triangles              = explode("\n", $input);

    $possibles_triangles    = 0;

    foreach ($triangles as $triangle) {
        $needles            = ['/\s+/', '/^\s+/'];
        $replacement        = [' ', ''];
        $cleaned_triangle   = preg_replace($needles, $replacement, $triangle);
        $array              = explode(' ', $cleaned_triangle);
        sort($array);

        if (((int) $array[0] + (int) $array[1]) > (int) $array[2]) {
            $possibles_triangles++;
        }
    }

    echo "Part one : Number of possible triangles : ".$possibles_triangles;
    echo "\n";

    //
    // PART TWO
    //

    $possibles_triangles    = 0;
    $temporary_triangles    = [];

    foreach ($triangles as $line_index => $line) {
        $needles            = ['/\s+/', '/^\s+/'];
        $replacement        = [' ', ''];
        $cleaned_triangle   = preg_replace($needles, $replacement, $line);
        $array              = explode(' ', $cleaned_triangle);

        foreach($array as $index => $side) {
            if (!isset($temporary_triangles[$index]) || !is_array($temporary_triangles[$index])) { $temporary_triangles[$index] = []; }

            $temporary_triangles[$index] [] = (int) $side;
        }


        if ($line_index%3 == 2) {
            foreach($temporary_triangles as $temporary_triangle) {
                sort($temporary_triangle);
                if (($temporary_triangle[0] + $temporary_triangle[1]) > $temporary_triangle[2]) {
                    $possibles_triangles++;
                }
            }
            $temporary_triangles    = [];
        }
    }

    echo "Part two : Number of possible triangles : ".$possibles_triangles;