<?php
    session_start();
    session_unset();
    session_destroy();
    if(isset($_COOKIE['username'])) setcookie('username',$_COOKIE['username'],time()-30);
    header("Location: ../../");
?>
