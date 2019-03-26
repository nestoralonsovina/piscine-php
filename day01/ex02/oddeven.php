#!/usr/bin/php
<?php

while (1) {
    echo "Enter a number: ";
    $line = fgets(STDIN);
    $line = trim($line);

    if (is_numeric($line))
    {
        if ($line % 2 == 0)
            echo "The number $line is even\n";
        else
            echo "The number $line is odd\n";
    }
    else
    {
        if (feof(STDIN))
        {
            echo "\n";
            exit();
        }
        else
            echo "'$line' is not a number\n";
    }
}
?>
