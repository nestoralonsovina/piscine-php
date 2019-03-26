#!/usr/bin/php
<?php

function ft_split($line)
{
    if (!is_string($line))
        return ([]);
    $tab = explode(";", $line);
    foreach ($tab as $index => $word) {
        if ($word == "") {
            unset($tab[$index]);
        }
    }
    $tab = array_values($tab);
    return ($tab);
}


$opt = ft_split(fgets(STDIN));
var_dump($opt);
$students = [];

while (1)
{
    $line = fgets(STDIN); 
    $line = trim($line);
    $line = ft_split($line);

    if (feof(STDIN))
        break;
}

?>
