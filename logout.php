<?php
session_start();
session_unset();
session_destroy();
if(isset($_COOKIE['cookielogin']))      
{
$time = time();
    setcookie("cookielogin[username]", $time - 3600);
    setcookie("cookielogin[password]", $time - 3600);
}
header('Location: http://localhost/');
exit();
?>