<?php
    //
    // PART ONE
    //

    // We get the input from the site
    $input       = file_get_contents('inputs/day1.txt');
    $directions  = explode(', ', $input); // Explode input

    // Explode all direction to have an array
    $cardinals   = [
        [
            0,
            1
        ],
        [
            1,
            0
        ],
        [
            0,
            -1
        ],
        [
            -1,
            0
        ]
    ];

    $cardinal_direction = 0; // Initialize cardinal direction
    $player_x_position  = 0; // Initialize x pos
    $player_y_position  = 0; // Initialize y pos

    foreach($directions as $index => $direction) {
        $regex      = "#([RL])(\d+)#i";
        $matches    = [];

        if (preg_match($regex, $direction, $matches)) {
            switch($matches[1]) {
                case 'R' :
                    $cardinal_direction++;
                    break;
                case 'L' :
                    $cardinal_direction--;
                    break;
            }

            $cardinal_direction = ($cardinal_direction + 4 ) % 4; // Hack to have positive modulo

            if ($cardinals[$cardinal_direction][0] !== 0) {
                $player_x_position += $cardinals[$cardinal_direction][0] * $matches[2]; // Update x pos
            }

            if ($cardinals[$cardinal_direction][1] !== 0) {
                $player_y_position += $cardinals[$cardinal_direction][1] * $matches[2]; // Update y pos
            }
        }
    }

    $distance = abs($player_x_position) + abs($player_y_position); // Calculate absolute distance

    echo "Part 1 : Distance from start : ({$distance}).\n"; // Solution

    //
    // PART TWO
    //

    $hq_found           = false;
    $visited_positions  = [];

    $cardinal_direction = 0; // Initialize cardinal direction
    $player_x_position  = 0; // Initialize x pos
    $player_y_position  = 0; // Initialize y pos

    foreach($directions as $index => $direction) {
        $regex      = "#([RL])(\d+)#i";
        $matches    = [];

        if (preg_match($regex, $direction, $matches)) {
            switch($matches[1]) {
                case 'R' :
                    $cardinal_direction++;
                    break;
                case 'L' :
                    $cardinal_direction--;
                    break;
            }

            $cardinal_direction = ($cardinal_direction + 4 ) % 4; // Hack to have positive modulo

            for($i = 0; $i < $matches[2]; $i++) {
                $player_x_position += $cardinals[$cardinal_direction][0]; // Update x pos
                $player_y_position += $cardinals[$cardinal_direction][1]; // Update y pos

                $coords_name = $player_x_position.",".$player_y_position;

                if (in_array($coords_name, $visited_positions)) {
                    $hq_found = true;
                    break;
                } else {
                    $visited_positions[] = $coords_name;
                }
            }

            if ($hq_found) {
                break;
            }
        }
    }

    $distance = abs($player_x_position) + abs($player_y_position); // Calculate absolute distance

    echo "Part 2 : Easter Bunny HQ Distance : ({$distance}).\n"; // Solution