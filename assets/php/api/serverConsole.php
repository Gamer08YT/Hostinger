<?php
error_reporting(E_ERROR | E_PARSE);
require_once "api.php";
require_once "../config.php";
set_include_path("../ssh/");
include "../ssh/Net/SSH2.php";
$API = new api();
session_start();
if (isset($_SESSION['user_hash']) && isset($_SESSION['user_id']) && !empty($_SESSION['user_hash']) && !empty($_SESSION['user_id'])) {
    $USER = $_SESSION['user_id'];
    if (isset($_POST['handshake']) && !empty($_POST['handshake']) && isset($_POST['serverID']) && !empty($_POST['serverID'])) {
        if ($_SESSION['user_hash'] === $_POST['handshake']) {
            $SERVER = $_POST['serverID'];

            $DATA = $SQL->query("SELECT * FROM " . DB_PREFIX . "server WHERE id = " . $SERVER . " AND `user` = " . $USER);
            $ROW = $DATA->fetch_assoc();

            $SSH = new Net_SSH2(SSH_HOST, SSH_PORT, 3);
            if (!$SSH->login(SSH_USER, SSH_PASSWORD)) {
                die($API->response(false, "WRAPPER_OFFLINE"));
            }
            global $SSHG;
            $SSHG = $SSH;

            $SSH->enablePTY();
            //die("bash " . DIR_HOME . "start.sh --screen=BOT-" . $USER . "-" . $SERVER . " --language=" . $ROW['platform'] . " --binary=" . DIR_USER . $USER . "/" . $SERVER . "/");
            $SSH->exec("screen -x BOT-" . $USER . "-" . $SERVER);
            $rep = $SSH->read();
            $SSH->disablePTY();
            $SSH->disconnect();
            $rep = "" . str_replace("\r\n", "&#13;", $rep);
            die($API->response(true, str_replace("\b\n", "&#13;", $rep)));

        } else $API->needValue();
    } else $API->needValue();
} else $API->needValue();

function send($CMD)
{
    global $SSHG;
    $SSHG->enablePTY();
    $rep = $SSHG->exec($CMD);
    $SSHG->disablePTY();
    return $rep;
}