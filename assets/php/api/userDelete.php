<?php
/*
 * hostmaster@Byte-Store.DE.com
 * 03fp0W@q
 */
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once "api.php";
require_once "../SessionHandle.php";
require_once "../config.php";
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer(false);
$API = new api();
$SESSION = new SessionHandle();

if (isset($_SESSION['user_hash']) && isset($_SESSION['user_id']) && !empty($_SESSION['user_hash']) && !empty($_SESSION['user_id'])) {
    $ADMIN = $_SESSION['user_id'];
    if (isset($_POST['handshake']) && !empty($_POST['handshake']) && isset($_POST['id']) && !empty($_POST['id'])) {
        if ($_SESSION['user_hash'] === $_POST['handshake']) {
            $ID = $_POST['id'];
            if ($SESSION->isAdmin()) {
                $SQL->query("DELETE FROM " . DB_PREFIX . "user WHERE id = " . $ID);
                die($API->response(true, "USER_DELETED"));
            } else {
                die($API->response(false, "NOT_ADMIN"));
            }
        } else $API->needValue();
    } else $API->needValue();
} else $API->needValue();