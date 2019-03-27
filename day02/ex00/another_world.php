#!/usr/bin/php
<?php

if ($argc > 1) {
    $pattern = '/[^ \t]+/';
    preg_match_all($pattern, $argv[1], $matches);
    echo implode(" ", $matches[0]) . "\n";
}

?>
