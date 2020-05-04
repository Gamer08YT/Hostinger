<?php
require_once "api.php";
require_once "../../php/SessionHandle.php";
require_once "../../php/config.php";
$API = new api();
$SESSION = new SessionHandle();
session_start();

if (isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    $KEY = base64_encode($_POST['password']);
    $REQ = $SQL->query("SELECT * FROM " . DB_PREFIX . "user WHERE email = '" . $_POST['email'] . "' AND password = '" . $KEY . "'");
    list($total) = mysqli_fetch_row($REQ);
    if ($total != 0) {
        $REQ = $SQL->query("SELECT * FROM " . DB_PREFIX . "user WHERE email = '" . $_POST['email'] . "' AND password = '" . $KEY . "'");
        $ROW = mysqli_fetch_array($REQ);
        $SESSION->startUser($ROW['id']);
        die($API->response(true, "LOGIN_SUCCESS"));
    } else {
        die($API->response(false, "LOGIN_INCORRECT"));
    }
} else $API->needValue();
