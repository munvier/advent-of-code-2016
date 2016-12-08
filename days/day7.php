<?php
    //
    // PART ONE
    //

    // We get the input from the site
    $input              = file_get_contents('inputs/day7.txt');

    $lines              = explode("\n", $input);
    $tls_support_count  = 0;
    
    foreach($lines as $line_index => $line) {
        preg_match_all("/(\w+)/i", $line, $matches);
        
        $strings            = $matches[0];
        $hasTlsSupport      = false;
        
        foreach($strings as $index => $string) {
            $hasABBA        = false;

            foreach(str_split($string) as $char_index => $char) {
                if (!isset($string[$char_index + 3])) {
                    break;
                }
                
                if ($char == $string[$char_index + 3]
                    && $char != $string[$char_index + 1]
                    && $string[$char_index + 1] == $string[$char_index + 2]) {
                    $hasABBA = true;
                    break;
                }
            }
            
            if ($hasABBA && $index%2 == 1) {
                continue 2;
            }
            
            if ($hasABBA && $index%2 == 0) {
                $hasTlsSupport = true;
            }
        }
        
        if ($hasTlsSupport) {
            $tls_support_count++;
        }
    }
    
    echo "Part one : number of adresses that support tls : ".$tls_support_count;
    echo "\n";
    
    $ssl_support_count  = 0;
    
    foreach($lines as $line_index => $line) {
        preg_match_all("/\[(\w+)\]/i", $line, $brackets_strings);
        
        $strings            = $matches[0];
        $hasTlsSupport      = false;
        
        foreach($strings as $index => $string) {
            $hasABBA        = false;

            foreach(str_split($string) as $char_index => $char) {
                if (!isset($string[$char_index + 3])) {
                    break;
                }
                
                if ($char == $string[$char_index + 3]
                    && $char != $string[$char_index + 1]
                    && $string[$char_index + 1] == $string[$char_index + 2]) {
                    $hasABBA = true;
                    break;
                }
            }
            
            if ($hasABBA && $index%2 == 1) {
                continue 2;
            }
            
            if ($hasABBA && $index%2 == 0) {
                $hasTlsSupport = true;
            }
        }
        
        if ($hasTlsSupport) {
            $tls_support_count++;
        }
    }
    
    echo "Part two : number of adresses that support tls : ".$ssl_support_count;
    echo "\n";