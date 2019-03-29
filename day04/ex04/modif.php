<?php

function check_existance($data, $username, $passwd) {
    $val = array_values($data);
    foreach ($val as $user) {
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

    # get login and passwd
    $username = $_POST['login'];
    $oldpw = $_POST['oldpw'];
    $newpw = $_POST['newpd'];


    # get hashed format of the passwd
    $oldpw = hash('whirlpool', $oldpw);
    $newpw = hash('whirlpool', $newpw);

    # append username to the array, error if already set 
    if (check_existance($data, $username, $oldpw) == false) {
        echo "ERROR\n";
    } else {
        $i = array_search($data, ["login" => $username, "passwd" => $oldpw]);
        $data[$i] = ["login" => $username, "passwd" => $newpw];

        # serialize data again and store it
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
