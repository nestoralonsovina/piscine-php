<?php

function ft_is_sort($tab)
{
    $a = $b = array_values($tab);
    sort($b);
    return ($a === $b);
}

?>
