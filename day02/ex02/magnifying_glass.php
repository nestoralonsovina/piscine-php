#!/usr/bin/php
<?php

function callback_toupper($matches) {
    return ($matches[1] . "" . strtoupper($matches[2]) . "" . $matches[3]);
}

function callback($matches) {
    $title = '/( title=\")(.*?)(\")/mi';
    $matches[0] = preg_replace_callback($title, "callback_toupper", $matches[0]);

    $text = '/(>)(.*?)(<)/si';
    $matches[0] = preg_replace_callback($text, "callback_toupper", $matches[0]);

    return ($matches[0]);
}

if ($argc > 1 && file_exists($argv[1]))
{
    $fd = fopen($argv[1], "r");

    while (!feof($fd))
    {
        $line .= fgets($fd);
    }
    fclose($fd);

    $anchor = "/(<a\s+)(.*?)(>)(.*)(<\/a>)/si";
    $line = preg_replace_callback($anchor,"callback", $line);

    echo "$line";
}
?>
