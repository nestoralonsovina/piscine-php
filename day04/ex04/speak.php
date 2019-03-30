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

            $chat = get_data($file);
            $chat[] = [
                "login" => $_SESSION['loggued_on_user'],
                "time" => time(),
                "msg" => $_POST['msg']
            ];

            $chat = serialize($chat);
            file_put_contents($file, $chat);

            flock($fd, LOCK_UN);
        }
        fclose($fd);
    }
} else {
    echo "ERROR\n";
    exit();
}

?>
<html>

<head>
</head>
<script langage="javascript">top.frames['chat'].location = 'chat.php' ;</script>
<body>
    <form method="post" action="">
        <input type="text" name="msg" />
        <input type="submit" name="submit" value="OK" />
    </form>
</body></html>
