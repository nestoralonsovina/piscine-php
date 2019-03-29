<?php

session_start();

if (!isset($_SESSION['login']) && !isset($_SESSION['passwd'])) {
    $_SESSION['login'] = "";
    $_SESSION['passwd'] = "";
}

if (isset($_GET)) {
    if (isset($_GET['submit']) && isset($_GET['login']) && isset($_GET['passwd'])) {
        if ($_GET['submit'] == "OK") {
            $_SESSION['login'] = $_GET['login'];
            $_SESSION['passwd'] = $_GET['passwd'];
        }
    }
}

?>
<html><body>
<form method="get" action="index.php">
    Username: <input type="text" name="login" value="<?php echo $_SESSION['login']; ?>" />
    <br />
    Password: <input type="text" name="passwd" value="<?php echo $_SESSION['passwd']; ?>" />
    <input type="submit" name="submit" value="OK" />
</form>
</body></html>
