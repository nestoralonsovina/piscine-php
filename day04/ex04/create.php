<?php

function check_existance($data, $username) {
    foreach ($data as $user) {
        if ($user['login'] == $username) {
            return true;
        }
    }
    return false;
}

function storePasswd() {
    if (!file_exists('../private')) {
        mkdir('../private');
    }
    if (file_exists('../private/passwd')) {
        $priv = file_get_contents('../private/passwd');
        $data = unserialize($priv);
    } else {
        $data = array();
    }

    $username = $_POST['login'];
    $passwd = $_POST['passwd'];

    $passwd = hash('whirlpool', $passwd);

    if (check_existance($data, $username)) {
        echo "ERROR\n";
    } else {
        $data[] = ["login" => $username, "passwd" => $passwd];

        $data = serialize($data);
        file_put_contents('../private/passwd', $data);
        header('Location: index.html');
        echo "OK\n";
    }
}

if (isset($_POST)) {
    if (isset($_POST['submit']) && isset($_POST['login']) && isset($_POST['passwd'])) {
        if ($_POST['submit'] == "OK" && $_POST['passwd'] != "") {
            storePasswd();
        } else {
            echo "ERROR\n";
        }
    }
}
