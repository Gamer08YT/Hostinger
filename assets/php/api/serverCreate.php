<?php
require_once "api.php";
require_once "../config.php";
require_once "../../php/SessionHandle.php";
set_include_path("../ssh/");
include "../ssh/Net/SSH2.php";
$API = new api();
$SESSION = new SessionHandle();
session_start();
if (isset($_SESSION['user_hash']) && isset($_SESSION['user_id']) && !empty($_SESSION['user_hash']) && !empty($_SESSION['user_id'])) {
    $USER = $_SESSION['user_id'];
    if (isset($_POST['handshake']) && !empty($_POST['handshake'])) {
        if ($_SESSION['user_hash'] === $_POST['handshake']) {
            if (isset($_POST['server_user']) && isset($_POST['server_id']) && !empty($_POST['server_user']) && !empty($_POST['server_id'])) {
                if ($SESSION->isAdmin()) {
                    $SSH = new Net_SSH2(SSH_HOST, SSH_PORT, 3);
                    if (!$SSH->login(SSH_USER, SSH_PASSWORD)) {
                        die($API->response(false, "WRAPPER_OFFLINE"));
                    }
                    global $SSHG;
                    $SSHG = $SSH;

                    /**
                     * 1: Server erstellen
                     *    - In DB eintragen
                     * 2: Server erstellen
                     *    - FTP anlegen + PW in DB
                     */
                    $user = $SESSION->randomFTP();
                    $password = $SESSION->randomFTP();
                    $u_path = $_POST['server_user'];
                    $u_server = $_POST['server_id'];

                    $REQ = $SQL->query("SELECT * FROM " . DB_PREFIX . "server WHERE id = " . $u_server);
                    list($total) = mysqli_fetch_row($REQ);
                    if ($total != 0) {
                        $DATA = mysqli_fetch_array($SQL->query("SELECT * FROM " . DB_PREFIX . "server WHERE id = " . $u_server));
                        $SSH->exec("deluser " . $DATA['ftp_username']);
                    }

                    $SSH->exec("mkdir " . DIR_USER . $u_path);
                    $SSH->exec("mkdir " . DIR_USER . $u_path . "/" . $u_server);
                    $SSH->exec("chmod 777 " .  DIR_USER . $u_path . "/" . $u_server);
                    $SSH->exec("useradd " . $user . " -d " . DIR_USER . $u_path . "/" . $u_server . "/ -s /sbin/nologin");

                    $SSH->exec('echo -e "' . $password . '\n' . $password . '" | passwd ' . $user);

//echo $$->read();
//$SSH->exec("passwd " . $user);
//die("bash " . DIR_HOME . "start.sh --screen=BOT-" . $USER . "-" . $SERVER . " --language=" . $ROW['platform'] . " --binary=" . DIR_USER . $USER . "/" . $SERVER . "/");

                    $SSH->disablePTY();
                    $SSH->disconnect();

                    $SQL->query("UPDATE " . DB_PREFIX . "server SET ftp_user = '" . $user . "', ftp_password = '" . $password . "' WHERE id = " . $u_server);
                }
                die($API->response(false, "NOT_ADMIN"));
            } else $API->needValue();
        } else $API->needValue();
    } else $API->needValue();
} else $API->needValue();
