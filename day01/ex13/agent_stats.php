#!/usr/bin/php
<?php

function ft_split($line)
{
    if (!is_string($line))
        return ([]);
    $tab = explode(";", $line);
    foreach ($tab as $index => $word) {
        if ($word == "") {
            unset($tab[$index]);
        } else if (is_numeric($word)) {
            $tab[$index] = (int)$word;
        }
    }
    $tab = array_values($tab);
    return ($tab);
}


$opt = ft_split(fgets(STDIN));
$students = [];

while (1)
{
    $line = fgets(STDIN); 
    $line = trim($line);
    $line = ft_split($line);
    $student = $line[0];

    if ($student && isset($students[$student]) == false) {
        $students[$student] = [
            'peer_notes' => 0,
            'peer_corrections' => 0,
            'moulinette_notes' => 0,
            'moulinette_corrections' => 0
        ];
    }
    if (gettype($line[1]) === integer)
    {
        if (count($line) > 2 && $line[2] == "moulinette")
        {
            $students[$student]['moulinette_notes'] += $line[1];
            $students[$student]['moulinette_corrections'] += 1;
        }
        else {
            $students[$student]['peer_notes'] += $line[1];
            $students[$student]['peer_corrections'] += 1;
        }
    }
    if (feof(STDIN))
        break;
}

if ($argc == 2) {
    if ($argv[1] == "moyenne")
    {
        $sum = 0;
        $corr = 0;
        foreach ($students as $stud) {
            $sum += $stud['peer_notes'];
            $corr += $stud['peer_corrections'];
        } 
        echo $sum / $corr . "\n";
    } else if ($argv[1] == "moyenne_user") {
        ksort($students);
        foreach ($students as $key => $stud) {
            echo $key . ":" . $stud['peer_notes'] / $stud['peer_corrections'] . "\n";
        }
    }
    else if ($argv[1] == "ecart_moulinette") {
        ksort($students); 
        foreach ($students as $key => $stud) {
            echo $key . ":" . (($stud['peer_notes'] / $stud['peer_corrections']) - ($stud['moulinette_notes'] / $stud['moulinette_corrections'])) . "\n";
        }
    }
}

?>
