<?php
    //
    // PART ONE
    //

    // We get the input from the site
    $input                  = file_get_contents('inputs/day4.txt');

    $lines                  = explode("\n", $input);
    $sectors_ids            = 0;

    foreach($lines as $line) {
        $array          = explode('-', $line); // We explode the array to have the encrypted name and sector id and checksum
        $letters_count  = []; // Array that will keep count of each letter

        preg_match('/(\d+)\[(\w+)\]/i', array_pop($array), $matches); // We get the sectorId and the given checksum

        $sector_id      = $matches[1];
        $checksum       = $matches[2];

        $encrypted_name = implode('', $array); // We get a full string of the encrypted name

        foreach(str_split($encrypted_name) as $letter) {
            if (!isset($letters_count[$letter])) {
                $letters_count[$letter] = 0; // initializing variable
            }

            $letters_count[$letter]++; // Counting
        }

        array_multisort(array_values($letters_count), SORT_DESC, array_keys($letters_count), SORT_ASC, $letters_count); // Multisort by occurence then alphabetically by letter

        $letters        = array_keys($letters_count); // We get all the letters in the good order (by occurence then alphabetically by letter)
        $temp_checksum  = implode('', array_splice($letters, 0, 5)); // We only get the first five letters for the checksum to compare

        if ($temp_checksum === $checksum) {
            $sectors_ids += $sector_id; // If it's not a decoy, we add the sector id
        }
    }

    echo "Part one : Sectors IDs sum is ".$sectors_ids;
