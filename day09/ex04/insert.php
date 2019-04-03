<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (file_get_contents('list.csv') !== "") {
		$fd = fopen('list.csv', "a");
		fputcsv($fd, $_POST['element']);
		fclose($fd);
		echo "success";
	}
	echo "failure";
}
