<?php

// this is acommand line program to count lines
// invoked as php count.php <file>
function ending($line) {
    $CR = 13;
    $LF = 10;
    $lastchar = -1;
    $secondlastchar = -1;
    if (strlen($line) > 0) {
        $lastchar = ord(substr($line, strlen($line) - 1));
        if (strlen($line) > 1) {
            $secondlastchar = ord(substr($line, strlen($line) - 2));
        }
    }
    $engind = "";
    if ($lastchar == $CR) {
        $ending = "CR";
    } else if ($lastchar == $LF) {
        $ending = "LF";
    } else {
        $ending = "??";
    }
    if ($lastchar == $CR || $lastchar == $LF) {
        if ($secondlastchar == $CR) {
            $ending = "CR" . $ending;
        } else if ($secondlastchar == $LF) {
            $ending = "LF" . $ending;
        }
    }
    return $ending;
}

if ($argc > 1) {
    array_shift($argv);
    foreach ($argv as $file) {
        //echo "handling file: " . $file . PHP_EOL;
        $lines = file($file);
        $endings = array();
        foreach ($lines as $linenum => $line) {
            //echo "line " . $linenum . " has length: " . strlen($line) . PHP_EOL;
            $e = ending($line);
            if ($e != "LF" && $e != "CRLF") {
                if ($linenum == (count($lines) - 1)) {
                    $e = "LAST_NOEOL";
                } else {
                    echo "line " . $linenum . " ends with: " . $e . PHP_EOL;
                }
            }
            if (isset($endings[$e])) {
                $endings[$e] += 1;
            } else {
                $endings[$e] = 1;
            }
        }
        $endings["TOTAL"] = count($lines);
        //echo "file " . $file . " has " . count($lines) . " lines " . PHP_EOL;
        echo "" . $file . " endings: " . json_encode($endings) . PHP_EOL;
        ;
    }
} else {
    echo "usage : php  " . $argv[0] . " file1 [file2 [... fileN]]" . PHP_EOL;
}


//$lines = count(file($file));
//echo "There are $lines lines in $file";
?>
