<?php

    // We get the input from the site
    $input       = file_get_contents('../inputs/day1.txt');

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
    $directions         = explode(', ', $input); // Explode input

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

            $player_x_position += $cardinals[$cardinal_direction][0] * $matches[2]; // Update x pos
            $player_y_position += $cardinals[$cardinal_direction][1] * $matches[2]; // Update y pos
        }

        echo "Turn {$index} :\tPlayer has ({$player_x_position}, {$player_y_position}) position.\n"; // Debug turn position
    }

    $distance = abs($player_x_position) + abs($player_y_position); // Calculate absolute distance

    echo "Distance from start : ({$distance}).\n"; // Solution