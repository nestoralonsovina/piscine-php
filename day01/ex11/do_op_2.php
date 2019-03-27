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

if ($argc != 2) {
    echo "Incorrect Parameters\n";
}
else {
    $op = explode(";", "+;-;*;/;%");
    $test = sscanf($argv[1], "%f %c %f %s");
    if (count($test) >= 3 && $test[1] && in_array($test[1], $op) && !$test[3]) {
        switch($test[1]) {
            case "*":
                $result = $test[0] * $test[2];
                break;
            case "-":
                $result = $test[0] - $test[2];
                break;
            case "/":
                $result = $test[0] / $test[2];
                break;
            case "%":
                $result = $test[0] % $test[2];
                break;
            case "+":
                $result = $test[0] + $test[2];
                break;
        }
        echo $result . "\n";
    }
    else {
        echo "Syntax Error\n";
    }
}
?>
