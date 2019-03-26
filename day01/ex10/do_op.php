#!/usr/bin/php
<?php

if ($argc != 4) {
    echo "Incorrect Parameters\n";
    exit();
}

$final = [];
foreach ($argv as $arg) {
    if ($arg == $argv[0])
        continue;
    $final[] = trim($arg);
}

$p = eval('return ' . implode("", $final) . ';');
echo $p . "\n";

?>
