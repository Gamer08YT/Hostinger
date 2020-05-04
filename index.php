<?php
error_reporting(E_ERROR | E_PARSE);
require_once "assets/php/config.php";
require_once "assets/php/SessionHandle.php";
require_once "assets/php/PlatformHandle.php";
$SESSION = new SessionHandle();
$PLATFORM = new PlatformHandle();

session_start();
//$SESSION->startUser(1);
//echo "KEY: " . $_SESSION['site_key'];
if (isset($_GET['page']) && !empty($_GET['page'])) {
    if (file_exists("assets/include/" . $_GET['page'] . ".php")) {
        if (!in_array($_GET['page'], $MAINTENANCE)) {
            include "assets/include/" . $_GET['page'] . ".php";
        } else {
            if (!isset($_SESSION['site_key'])) {
                if (!$_SESSION['site_key'] == $SITE_KEY) {
                    include "assets/include/maintenance.php";
                } else include "assets/include/" . $_GET['page'] . ".php";
            } else include "assets/include/" . $_GET['page'] . ".php";
        }
    }
} else {
    include "assets/include/index.php";
}

// https://materializecss.com/feature-discovery.html