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
            $SSH->exec("cd " . DIR_HOME . " && bash start.sh --screen=BOT-" . $ROW['user'] . "-" . $SERVER . " --language=" . $ROW['platform'] . " --binary=" . DIR_USER . $ROW['user'] . "/" . $SERVER . "/");
            $rep = $SSH->read();
            $SSH->disablePTY();
            $SSH->disconnect();

            if (strstr($rep, "SERVER_BINARY")) {
                die($API->response(false, "SERVER_BINARY"));
            } else if (strstr($rep, "SERVER_ONLINE")) {
                die($API->response(false, "SERVER_ONLINE"));
            } else if (strstr($rep, "SERVER_STARTING")) {
                die($API->response(true, "SERVER_STARTED"));
            } else {
                die($API->response(true, $rep));
            }

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