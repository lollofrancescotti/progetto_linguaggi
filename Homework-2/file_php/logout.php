<?php
    session_start();
    session_unset();
    session_destroy();

    header("Location: ../file_html/index.html");
    exit;
?>