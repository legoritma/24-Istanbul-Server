<?php
    include_once "header.php";
    if (isset($body)) {
        foreach ($body as $b) {
            include $b;
        }
    }
    include_once "footer.php";
?>