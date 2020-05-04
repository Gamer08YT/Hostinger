<?php
require_once "api.php";
require_once "../../php/SessionHandle.php";
require_once "../../php/config.php";
$API = new api();
$SESSION = new SessionHandle();
session_start();

if (isset($_SESSION['user_hash']) && isset($_SESSION['user_id']) && !empty($_SESSION['user_hash']) && !empty($_SESSION['user_id'])) {
    if (isset($_POST['user_server']) && isset($_POST['platform_server']) && !empty($_POST['user_server']) && !empty($_POST['platform_server'])) {
        if ($SESSION->isAdmin()) {
            $USER = $_POST['user_server'];
            $PLATFORM = $_POST['platform_server'];
            if (isset($_POST['handshake']) && !empty($_POST['handshake'])) {
                if ($_SESSION['user_hash'] === $_POST['handshake']) {
                    $SQL->query("INSERT INTO " . DB_PREFIX . "server (`name`, `user` , platform) VALUES ('Discord-Bot', " . $USER . ", '" . $PLATFORM . "')");
                } else $API->needValue();
            } else $API->needValue();
        } else die($API->response(false, "NOT_ADMIN"));
    } else $API->needValue();
} else $API->needValue();
