<?php

function ft_is_sort($tab)
{
    $a = $tab;
    $b = $tab;
    sort($b);
    if ($a === $b)
        return true;
    else
        return false;
}

?>
