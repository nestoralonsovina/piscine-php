#!/usr/bin/php
<?php

function ft_split($s1)
{
	$tab = explode(" ", $s1);
	sort($tab);
	return($tab);
}

if ($argc == 1)
    exit();

$final = [];
foreach ($argv as $arg) {
   if ($arg == $argv[0])
       continue;
   $tmp = ft_split($arg);
   $final = array_merge($final, $tmp);
}
$argv = $final;

$numeric = [];

foreach ($argv as $element) {
    if (is_numeric($element))
        $numeric[] = $element;
}

sort($numeric, SORT_STRING);

$string = [];

foreach ($argv as $element) {
    if (ctype_alpha($element))
        $string[] = $element;
}

sort($string, SORT_NATURAL | SORT_FLAG_CASE);

$strange = [];

foreach ($argv as $element) {
    if (is_numeric($element) == FALSE && ctype_alpha($element) == FALSE)
        $strange[] = $element;
}

sort($strange);

$print = array_merge($string, $numeric, $strange);
foreach ($print as $e)
    echo $e . "\n";

?>
