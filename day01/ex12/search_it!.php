#!/usr/bin/php
<?php
if ($argc > 2) {
    $key = $argv[1];
    $argv = array_slice($argv, 2);
    $array = [];
    foreach ($argv as $arg) {
        $tmp = explode(":", $arg);
        $array[$tmp[0]] = $tmp[1];
    }
    echo $array[$key] . "\n";
}
?>
