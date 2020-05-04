<?php
error_reporting(E_ERROR | E_PARSE);
require_once "api.php";
require_once "../config.php";
set_include_path("../ssh/");
include "../ssh/Net/SSH2.php";
$API = new api();
session_start();

$SSH = new Net_SSH2(SSH_HOST, SSH_PORT, 3);
if (!$SSH->login(SSH_USER, SSH_PASSWORD)) {
    die($API->response(false, "WRAPPER_OFFLINE"));
}

$SSH->enablePTY();
//die("bash " . DIR_HOME . "start.sh --screen=BOT-" . $USER . "-" . $SERVER . " --language=" . $ROW['platform'] . " --binary=" . DIR_USER . $USER . "/" . $SERVER . "/");
$SSH->exec("mpstat -P ALL -o JSON");
$rep = $SSH->read();
$SSH->disablePTY();
$SSH->disconnect();

$JSON = json_decode($rep, true);
//print_r(['number-of-cpus']);
$cores = $JSON['sysstat']['hosts'][0]['number-of-cpus'];
$coreUsage = 0;
$coresCount = 0;
while ($coresCount < $cores) {
    $usage = $JSON['sysstat']['hosts'][0]['statistics'][0]['cpu-load'][$coresCount]['idle'];
//    echo "<br>";
    $coreUsage = $coreUsage + $usage;
    $coresCount++;
}
$coreUsage = $coreUsage / $coresCount;
$coreUsage = 100 - $coreUsage;

die($API->response(true, json_encode(array("cores" => $cores, "usage" => $coreUsage))));
//print_r($JSON);

?>

