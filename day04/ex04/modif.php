<?php

function check_existance($data, $username, $passwd) {
    foreach ($data as $user) {
        if ($user['login'] == $username && $user['passwd'] == $passwd) {
            return true;
        }
    }
    return false;
}

function getData($file) {
    if (file_exists($file)) {
        $priv = file_get_contents($file);
        $data = unserialize($priv);
    } else {
        $data = array();
    }
    return $data;
}

function modifPasswd() {
    $data = getData('../private/passwd');

    $username = $_POST['login'];
    $oldpw = $_POST['oldpw'];
    $newpw = $_POST['newpd'];

    $oldpw = hash('whirlpool', $oldpw);
    $newpw = hash('whirlpool', $newpw);

    if (check_existance($data, $username, $oldpw) == false) {
        echo "ERROR\n";
    } else {
        $i = -1;
        foreach ($data as $key => $value) {
            if ($value['login'] == $username && $value['passwd'] == $oldpw) {
                $i = $key;
                break;
            }
        }
        $data[$i] = ["login" => $username, "passwd" => $newpw];

        $data = serialize($data);
        file_put_contents('../private/passwd', $data);
        header('Location: index.html');
        echo "OK\n";
    }
}

if (isset($_POST)) {
    if (isset($_POST['submit']) && isset($_POST['login']) && isset($_POST['oldpw']) && isset($_POST['newpw'])) {
        if ($_POST['submit'] == "OK" && $_POST['oldpw'] != "" && $_POST['newpw'] != "") {
            modifPasswd();
        } else {
            echo "ERROR\n";
        }
    } else {
        echo "ERROR\n";
    }
}
