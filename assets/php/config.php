<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "bothosting");
define("DB_PASSWORD", "PASSWORD");
define("DB_DATABASE", "DATABASE");
define("DB_PREFIX", "kresu24_");

$SQL = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
global $DB;
$DB = $SQL;

define("SSH_PORT", 22);
define("SSH_HOST", "ADDRESS");
define("SSH_USER", "root");
define("SSH_PASSWORD", "PASSWORD");

define("DIR_HOME", "/home/bots/");
define("DIR_USER", DIR_HOME . "user/");

$MAINTENANCE = array("wiki");
$SITE_KEY = "weoihfioewhfoiew";