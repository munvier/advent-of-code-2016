<?php
    //
    // PART ONE
    //

    // We get the input from the site
    $input      = "cxdnnyjw";
    $password   = [];
    $cpt        = 0;

    while (count($password) !== 8) {
        $to_encrypt = $input.$cpt;

        $encrypted  = md5($to_encrypt);

        if (substr($encrypted, 0, 5) === "00000") {
            $password [] = $encrypted[5];

            for ($i = 0; $i < 8; $i++) {
                echo (isset($password[$i]) ? $password[$i] : "_");
            }

            echo "\n";
        }

        $cpt++;
    }

    echo "Part one : password is '".implode('', $password)."' ({$cpt} iterations).";
    echo "\n";

    //
    // PART TWO
    //

    $password   = [];
    $cpt        = 0;

    while (count($password) !== 8) {
        $to_encrypt = $input.$cpt;

        $encrypted  = md5($to_encrypt);

        if (substr($encrypted, 0, 5) === "00000" && $encrypted[5] >= 0 && $encrypted[5] < 8 && is_numeric($encrypted[5]) && !isset($password[$encrypted[5]])) {
            $password[$encrypted[5]] = $encrypted[6];

            for ($i = 0; $i < 8; $i++) {
                echo (isset($password[$i]) ? $password[$i] : "_");
            }

            echo "\n";
        }

        $cpt++;
    }

    ksort($password);

    echo "Part two : password is '".implode('', $password)."' ({$cpt} iterations).";