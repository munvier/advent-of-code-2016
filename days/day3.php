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