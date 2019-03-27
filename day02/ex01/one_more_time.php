#!/usr/bin/php
<?php

if ($argc != 2)
    exit();

$monthnames = array(
 1 => 'janvier',
 2 => 'fevrier',
 3 => 'mars',
 4 => 'avril',
 5 => 'mai',
 6 => 'juin',
 7 => 'juillet',
 8 => 'aout',
 9 => 'septembre',
 10 => 'octobre',
 11 => 'novembre',
 12 => 'decembre');

$pattern .= '/^';
$pattern .= '([Ll]undi|[Mm]ardi|[Mm]ercredi|[Jj]eudi|[Vv]endredi|[Ss]amedi|[Dd]imanche)';
$pattern .= ' ';
$pattern .= '([0-9]|[1]?[0-9]|[2]?[0-9]|[3][0-1])';
$pattern .= ' ';
$pattern .= '([Jj]anvier|[Ff]evrier|[Mm]ars|[Aa]vril|[Mm]ai|[Jj]uin|[Jj]uillet|[Aa]out|[Ss]eptembre|[Oo]ctobre|[Nn]ovembre|[Dd]ecembre)';
$pattern .= ' ';
$pattern .= '(\d{4})';
$pattern .= ' ';
$pattern .= '([0-2][0-9]):([0-5][0-9]):([0-5][0-9])';
$pattern .= '$/';

$output = array();
if (preg_match($pattern, trim($argv[1]), $output)) {
    date_default_timezone_set("Europe/Paris");
    $m = array_search(strtolower($output[3]), $monthnames);
    if (checkdate($m, (int)$output[2], (int)$output[4])) {
        $date = sprintf("%s-%d-%sT%s:%s:%s", $output[4], $m, $output[2], $output[5], $output[6], $output[7]); 
        echo strtotime($date) . "\n";
    } else {
        echo "Wrong Format\n";
    }
} else {
    echo "Wrong Format\n";
}

?>
