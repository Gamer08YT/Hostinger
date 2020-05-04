<?php
session_start();
if (isset($_GET['key'])) {
    if ($_GET['key'] === $SITE_KEY) {
        $_SESSION['site_key'] = $SITE_KEY;
        echo("KEY_USED");
    } else {
        echo("KEY_NOT_EXIT");
    }
}