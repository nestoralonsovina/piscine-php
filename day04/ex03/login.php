<?php

include 'auth.php';

session_start();
if (isset($_GET)) {
    if (isset($_GET['login']) && isset($_GET['passwd'])) {
        if ($_GET['login'] != "" && $_GET['passwd'] != "") {
            if (auth($_GET['login'], $_GET['passwd']) == TRUE) {
                $_SESSION['loggued_on_user'] = $_GET['login']; 
                echo "OK\n";
            } else {
                $_SESSION['loggued_on_user'] = ""; 
                echo "ERROR\n";
            }
        } else {
            $_SESSION['loggued_on_user'] = ""; 
            echo "ERROR\n";
        }
    }
}
