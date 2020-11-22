<?php
define("DB_HOST", "sql7.freemysqlhosting.net");
define("DB_USER", "sql7377964");
define("DB_PASSWORD", "P5tpQ5XuJv");
define("DB_DATABASE", "sql7377964");
define("DB_PREFIX", "sql7377964");

$SQL = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
global $DB;
$DB = $SQL;

define("SSH_PORT", 22);
define("SSH_HOST", "usa.lionssh.xyz");
define("SSH_USER", "Jappe-lionssh.com");
define("SSH_PASSWORD", "0415668017");

define("DIR_HOME", "/home/bots/");
define("DIR_USER", DIR_HOME . "user/");

$MAINTENANCE = array("wiki");
$SITE_KEY = "weoihfioewhfoiew";
