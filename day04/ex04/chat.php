<?php

function get_data($file) {
    if (file_exists($file)) {
        $priv = file_get_contents($file);
        $data = unserialize($priv);
    } else {
        $data = array();
    }
    return $data;
}

date_default_timezone_set('Europe/Paris');
$file = '../private/chat';
if (file_exists($file)) {
    $fd = fopen($file, "c");
    if (flock($fd, LOCK_EX)) {

        $chat = get_data($file);

        foreach ($chat as $entry) {
            echo "[" . date('H:i', $entry['time']) . "]" . " <b>" . $entry['login'] . "</b>: " . $entry['msg'] . "<br />" . "\n";
        }

        flock($fd, LOCK_UN);
    }
    fclose($fd);
}
