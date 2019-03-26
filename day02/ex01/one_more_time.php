#!/usr/bin/php
<?php

$pattern .= '/^';
$pattern .= '([Ll]undi|[Mm]ardi|[Mm]ercredi|[Jj]eudi|[Vv]endredi|[Ss]amedi|[Dd]imanche)';
$pattern .= ' ';
$pattern .= '([0-9]|[1]?[0-9]|[2]?[0-9]|[3][0-1])';
$pattern .= ' ';
$pattern .= '\d{4}';
$pattern .= ' ';
$pattern .= '[0-2][0-9]:[0-6][0-9]:[0-6][0-9]';
$pattern .= '$/';


'(^[Ll]undi|[Mm]ardi|[Mm]ercredi|[Jj]eudi|[Vv]endredi|[Ss]amedi|[Dd]imanche) ([0-9]|[1]?[0-9]|[2]?[0-9]|[3][0-1]) ([Jj]anvier|[Ff]evrier|[Mm]ars|[Aa]vril|[Mm]ai|[Jj]uin|[Aa]out|[Ss]eptembre|[Oo]ctobre|[Nn]ovembre|[Dd]ecembre) ([1][9][7-9][0-9]|[2-9][0-9][0-9][0-9]) ([0-2][0-9]):([0-5][0-9]):([0-5][0-9])'
?>
