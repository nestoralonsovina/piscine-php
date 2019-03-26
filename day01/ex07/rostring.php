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

$wanted = ft_split($argv[1]);
$normal = array_slice($wanted, 1);
echo implode(" ", $normal);
if (count($normal) != 0)
    echo " ";
echo $wanted[0] . "\n";

?>
