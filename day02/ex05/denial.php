#!/usr/bin/php
<?php

if ($argc < 3)
    exit();
if (!file_exists($argv[1]))
    exit();

$fd = fopen($argv[1], "r");


$keys = explode(";", trim(fgets($fd)));

if (in_array($argv[2], $keys) == FALSE) {
    fclose($fd);
    exit();
}

$data = array();
$data['nom'] = array(); 
$data['prenom'] = array();  
$data['mail'] = array();  
$data['IP'] = array();  
$data['pseudo'] = array();  

while (!feof($fd)) {
    $line = trim(fgets($fd));
    if (!$line)
        continue;
    $line = explode(";", $line);
    $data['nom'][] = $line[0];
    $data['prenom'][] = $line[1];
    $data['mail'][] = $line[2];
    $data['IP'][] = $line[3];
    $data['pseudo'][] = $line[4];
}
fclose($fd);

$name = array_combine($data[$argv[2]], $data['nom']);
while (1) {
    echo "Enter your command: ";
    $line = fgets(STDIN);
    $line = trim($line);

    if (feof(STDIN))
    {
        echo "\n";
        exit();
    }
    else
    {
        eval($line);
    }
}

?>
