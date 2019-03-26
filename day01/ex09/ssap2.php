#!/usr/bin/php
<?php

function ft_split($s1)
{
    $tab = explode(" ", $s1);
    sort($tab);
    return($tab);
}

function cool_cmp($a, $b)
{
	for ($i = 0; ($i < strlen($a) && $i < strlen($b)); $i++)
	{
		$c1 = $a[$i];
		$c2 = $b[$i];
		if ($c1 == $c2)
			continue ;
		if (ctype_alpha($c1))
		{
			if (ctype_alpha($c2))
			{
				if (strcmp(strtolower($c1), strtolower($c2)) == 0)
					continue ;
				return (strcmp(strtolower($c1), strtolower($c2)));
			}
			return (-1);
		}
		else if (is_numeric($c1))
		{
			if (ctype_alpha($c2))
				return (1);
			else if (is_numeric($c2))
				return (strcmp($c1, $c2));
			return (-1);
		}
		else
		{
			if (!ctype_alpha($c2) && !is_numeric($c2))
				return (strcmp($c1, $c2));
			return (1);
		}
	}
	return (strlen($a) - strlen($b));
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

usort($argv, cool_cmp); 

foreach ($argv as $e)
    echo $e . "\n";
?>
