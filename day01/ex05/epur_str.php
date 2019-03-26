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

if ($argc != 2)
    exit();
$tab = ft_split($argv[1]);
echo implode(" ", $tab) . "\n";

?>
