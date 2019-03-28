<?php

function displayHtml() {
    $img = file_get_contents('../img/42.png');
    $img = base64_encode($img);

    echo "<html><body>" . "\n";
    echo "Hello Zaz<br />" . "\n";
    echo "<img src='data:image/png;base64,$img'>" . "\n";
    echo "</body></html>" . "\n";
}

function displayError() {
    header("WWW-Authenticate: Basic realm=''Member area''");
    header('HTTP/1.0 401 Unauthorized');
    $code = "<html><body>That area is accessible for members only</body></html>" . "\n";
    echo $code;
}

if ($_SERVER['PHP_AUTH_USER'] && $_SERVER['PHP_AUTH_PW']) {
    if ($_SERVER['PHP_AUTH_USER'] == "zaz" && $_SERVER['PHP_AUTH_PW'] == "jaimelespetitsponeys") {
        displayHtml();
    } else {
        displayError();
    }
} else {
    displayError();
}

?>
