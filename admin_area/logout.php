<?php

    session_start();
    session_destroy();

    echo "<script>window.open('login.php?logout=You Successfully logged out, Come back again.', '_self')</script>";
?>