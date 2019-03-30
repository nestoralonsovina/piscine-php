<?php

function getData($file) {
    if (file_exists($file)) {
        $priv = file_get_contents($file);
        $data = unserialize($priv);
    } else {
        $data = array();
    }
    return $data;
}

function auth($login, $passwd) {
    $data = getData('../private/passwd');
    $passwd = hash('whirlpool', $passwd);
    foreach ($data as $user) {
        if ($login === $user[login] && $passwd === $user[passwd]) {
            return TRUE;
        }
    }
    return FALSE;

}



