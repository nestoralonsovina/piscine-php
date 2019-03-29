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

$file = '../private/chat';
if (file_exists($file)) {
    $fd = fopen($file, "c");
    if (flock($fd, LOCK_EX)) {

        # get chat and add the new entry
        $chat = get_data($file);

        #iterate over the chat and print entrys
        foreach ($chat as $entry) {
            echo "[" . date('H:i', $entry['time']) . "]" . " <b>" . $entry['login'] . "</b>: " . $entry['msg'] . "<br />" . "\n";
        }

        # take out lock in read and write permissions over the file
        flock($fd, LOCK_UN);
    }
    fclose($fd);
}
