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

session_start();

$file = '../private/chat';
if (isset($_SESSION['loggued_on_user']) && $_SESSION['loggued_on_user'] !== "") {
    if (isset($_POST) && isset($_POST['submit']) && isset($_POST['msg']) && $_POST['submit'] == "OK") {
        $fd = fopen($file, "c");
        if (flock($fd, LOCK_EX)) {

            # get chat and add the new entry
            $chat = get_data($file); 
            $chat[] = [
                "login" => $_SESSION['loggued_on_user'],
                "time" => time(),
                "msg" => $_POST['msg']
            ];

            # serialize data and save it
            $chat = serialize($chat);
            file_put_contents($file, $chat);

            # delete lock in read and write permissions over the file
            flock($fd, LOCK_UN);
        }
        fclose($fd);
    }
} else {
    echo "ERROR\n";
    exit();
}

?>
<html><body>
    <form method="post" action="speak.php">
        <input type="text" name="msg" />
        <input type="submit" name="submit" value="OK" />
    </form>
</body></html>
