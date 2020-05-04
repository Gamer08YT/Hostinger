<?php
require_once "api.php";
require_once "../../php/SessionHandle.php";
require_once "../../php/config.php";
$API = new api();
$SESSION = new SessionHandle();
session_start();

if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['birthday']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['birthday'])) {
    if (isset($_POST['password_new']) && isset($_POST['password']) && !empty($_POST['password'])) {
        if ($_POST['password'] === $_POST['password_new']) {
            if (isset($_POST['byte_verify_key'])) {
                $REQ = $SQL->query("SELECT * FROM " . DB_PREFIX . "user WHERE `key` = '" . $_POST['byte_verify_key'] . "'");
                list($total) = mysqli_fetch_row($REQ);
                if ($total != 0) {
                    $SQL->query("UPDATE " . DB_PREFIX . "user SET `key` = 'verify', password = '" . base64_encode($_POST['password']) . "', first_name = '" . $_POST['first_name'] . "', last_name = '" . $_POST['last_name'] . "', birthday = '" . $_POST['birthday'] . "' WHERE `key` = '" . $_POST['byte_verify_key'] . "'");
                    die($API->response(true, "VERIFY_SUCCESS"));
                } else {
                    die($API->response(false, "KEY_INCORRECT"));
                }
            } else die($API->response(false, "PASSWORD_FALSE"));
        } else $API->needValue();
    } else $API->needValue();
} else $API->needValue();
