#!/usr/bin/php
<?php

if ($argc > 1) {
    $pattern = '/[\S]+/';
    preg_match_all($pattern, $argv[1], $matches);
    echo implode(" ", $matches[0]) . "\n";
}

?>
