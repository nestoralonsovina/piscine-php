#!/usr/bin/php
<?php

if (file_exists('/var/run/utmpx')) {
    date_default_timezone_set('Europe/Paris');
    $file = fopen("/var/run/utmpx", "r");
    while ($utmpx = fread($file, 628)){
        $unpack = unpack("a256a/a4b/a32c/id/ie/I2f/a256g/i16h", $utmpx);
        $array[$unpack['c']] = $unpack;
    }

    $array = array_slice($array, 1);

    foreach($array as $key => $value)
    {
        if ($value["e"] == 7) {
            $line = trim($value["a"]) . "  " . trim($value["c"]) . "  " . date('M d H:i', $value["f1"]) . " ";
            echo str_replace("\0", '', $line) . "\n";
        }
    }
}
    
?>
