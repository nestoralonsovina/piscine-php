<?php

function check_existance($data, $username) {
    $val = array_values($data);
    foreach ($val as $user) {
        if ($user['login'] == $username) {
            return true;
        }
    }
    return false;
}

function storePasswd() {

    # check if there are stored users, unserialize information
    # or create empty array
    if (!file_exists('../private')) {
        mkdir('../private');
    }
    if (file_exists('../private/passwd')) {
        $priv = file_get_contents('../private/passwd');
        $data = unserialize($priv);
    } else {
        $data = array();
    }

    # get login and passwd
    $username = $_POST['login'];
    $passwd = $_POST['passwd'];

    # get hashed format of the passwd
    $passwd = hash('whirlpool', $passwd);

    # append username to the array, error if already set 
    if (check_existance($data, $username)) {
        echo "ERROR\n";
    } else {
        $data[] = ["login" => $username, "passwd" => $passwd];

        # serialize data again and store it
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
