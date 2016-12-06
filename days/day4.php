<?php
    //
    // PART ONE
    //

    // We get the input from the site
    $input                      = file_get_contents('inputs/day4.txt');

    $lines                      = explode("\n", $input);
    $sectors_ids                = 0;
    $real_rooms_encrypted_names = [];

    foreach($lines as $line) {
        $array          = explode('-', $line); // We explode the array to have the encrypted name and sector id and checksum
        $letters_count  = []; // Array that will keep count of each letter

        preg_match('/(\d+)\[(\w+)\]/i', array_pop($array), $matches); // We get the sectorId and the given checksum

        $sector_id      = $matches[1];
        $checksum       = $matches[2];

        $encrypted_name = implode(' ', $array); // We get a full string of the encrypted name

        foreach(str_split($encrypted_name) as $letter) {
            if ($letter === ' ') {
                continue;
            }

            if (!isset($letters_count[$letter])) {
                $letters_count[$letter] = 0; // initializing variable
            }

            $letters_count[$letter]++; // Counting
        }

        array_multisort(array_values($letters_count), SORT_DESC, array_keys($letters_count), SORT_ASC, $letters_count); // Multisort by occurence then alphabetically by letter

        $letters        = array_keys($letters_count); // We get all the letters in the good order (by occurence then alphabetically by letter)
        $temp_checksum  = implode('', array_splice($letters, 0, 5)); // We only get the first five letters for the checksum to compare

        if ($temp_checksum === $checksum) {
            $real_rooms_encrypted_names[$encrypted_name] = $sector_id;
            $sectors_ids                += $sector_id; // If it's not a decoy, we add the sector id
        }
    }

    echo "Part one : Sectors IDs sum is ".$sectors_ids;
    echo "\n";

    foreach($real_rooms_encrypted_names as $real_encrypted_room_name => $sector_id) {
        $real_encrypted_room_name_chars         = str_split($real_encrypted_room_name);
        $real_encrypted_room_name_chars_count   = count($real_encrypted_room_name_chars);
        $decrypted_text                         = '';
        $alphabet                               = range('a', 'z');
        $flip                                   = array_flip($alphabet);

        for ($i = 0; $i < $real_encrypted_room_name_chars_count; $i++) {
            if ($real_encrypted_room_name_chars[$i] === ' ') {
                $decrypted_text .= ' ';
            } else {
                $decrypted_text .= $alphabet[(26+$flip[$real_encrypted_room_name_chars[$i]]+$sector_id%26)%26];
            }
        }

        if (strpos($decrypted_text, 'north') !== false) {
            echo "Part two : Location is '".$decrypted_text."' with sector id ".$sector_id;
            echo "\n";
            break;
        }
    }
