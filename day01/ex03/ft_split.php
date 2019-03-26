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
    sort($tab);
    return ($tab);
}

?>
