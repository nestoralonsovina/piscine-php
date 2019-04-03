<?php

if ($_SERVER['REQUEST_METHOD'] == "GET") {
	if (file_get_contents('list.csv') !== "") {
		$fd = fopen('list.csv', "r");
		while ($line = fgetcsv($fd, 0, ";")) {
			$data .= $line . "\n";
		}
		fclose($fd);
		echo file_get_contents('list.csv');
	}
}

