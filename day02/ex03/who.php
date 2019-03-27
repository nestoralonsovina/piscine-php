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
    var_dump($array);
    foreach($array as $key => $value)
    {
        $line = $value["a"] . "\t" . $value["c"] . "\n";
    }
    echo $line;
}
    
?>
