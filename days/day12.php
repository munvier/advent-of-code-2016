<?php

    $input              = file_get_contents('inputs/day12.txt');
    
    $instructions       = explode("\n", $input);
    
    $vars_part_one      = ['a' => 0, 'b' => 0, 'c' => 0, 'd' => 0];
    $vars_part_two      = ['a' => 0, 'b' => 0, 'c' => 1, 'd' => 0];

    function start ($vars, $instructions, $input) {
        $i = 0;
        
        while($i < count($instructions)) {
            if (preg_match('/(cpy|inc|dec|jnz) (\d+|\w) ?(-\d+|\w)?/i', $instructions[$i], $matches)) {
                switch($matches[1]) {
                    case 'cpy' :
                        $vars[$matches[3]] = (is_numeric($matches[2])) ? $matches[2] : $vars[$matches[2]];
                        break;
                    case 'inc' :
                        $vars[$matches[2]] = $vars[$matches[2]] + 1;
                        break;
                    case 'dec' :
                        $vars[$matches[2]] = $vars[$matches[2]] - 1;
                        break;
                    case 'jnz' :
                        if ((is_numeric($matches[2]) && $matches[2] !== 0)
                            || ($vars[$matches[2]] !== 0)) {
                            $i += $matches[3] - 1;
                        }
                        break;
                    default:
                        break;
                }
            }

            $i++;
        }
        
        return $vars;
    }
    
    echo "Part one : A has value ".start($vars_part_one, $instructions, $input)['a'];
    echo "\n";
    echo "Part two : A has value ".start($vars_part_two, $instructions, $input)['a'];