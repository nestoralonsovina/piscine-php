#!/usr/bin/php
<?php

function ft_split($line)
{
    if (!is_string($line))
        return ([]);
    $tab = explode(" ", $line);
    foreach ($tab as $index => $word) {
        if ($word == "") {
            unset($tab[$index]);
        }
    }
    $tab = array_values($tab);
    return ($tab);
}

if ($argc == 1)
    exit();

$wanted = array_slice($argv, 1);
$return = array();
foreach($wanted as $arg) {
    $tmp = ft_split($arg);
    $return = array_merge($return, $tmp);
}
sort($return);
foreach($return as $line)
    echo $line . "\n";
?>
