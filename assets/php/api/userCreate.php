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
    if (isset($_POST['handshake']) && !empty($_POST['handshake']) && isset($_POST['email']) && !empty($_POST['email'])) {
        if ($_SESSION['user_hash'] === $_POST['handshake']) {
            if ($SESSION->isAdmin()) {
                $email = strtolower($_POST['email']);
                $DATA = mysqli_fetch_array($SQL->query("SELECT email FROM " . DB_PREFIX . "user WHERE email = '" . $email . "'"));
                if (strtolower($DATA['email']) != $email) {
                    try {
                        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                        $mail->isSMTP();                                            // Send using SMTP
                        $mail->Host = 'mailhostname.com';                    // Set the SMTP server to send through
                        $mail->SMTPAuth = true;                                   // Enable SMTP authentication
                        $mail->SMTPOptions = array(
                            'ssl' => array(
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            )
                        );
                        $mail->Username = 'hostmaster@byte-store.de';                     // SMTP username
                        $mail->Password = 'password';                               // SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                        $mail->Port = 25;                                    // TCP port to connect to
                        $mail->setLanguage("de");

                        //Recipients
                        $mail->setFrom('hostmaster@byte-store.de', 'Hostmaster');
                        $mail->addAddress($email);

                        // Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = 'Hostmaster-Byte-Store.DE Benutzeraccount';
                        $hash = $SESSION->random();
                        $url = "https://hostinger.byte-store.de/?page=verify&verify=" . $hash;
                        $mail->Body = mb_convert_encoding(str_replace("%VERIFY_URL%", $url, file_get_contents("html/verify-email.html")), 'HTML-ENTITIES', "UTF-8");
                        $mail->AltBody = 'Ein Benutzeraccount für Hostmaster-Byte-Store.DE wurde erfolgreich erstellt! Da dein EMail-Client kein HTML unterstützt bitten wir dich diesen Link in deinem Browser zu öffnen: ' . $url;

                        $SQL->query("INSERT INTO " . DB_PREFIX . "user (email, `key`) VALUES ('" . $email . "', '" . $hash . "')");

                        $mail->send();
                        die($API->response(true, "MAIL_SENT"));
                    } catch (Exception $e) {
                        die($API->response(false, "MAIL_ERROR"));
                        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                } else {
                    die($API->response(false, "MAIL_EXITS"));
                }
            } else {
                die($API->response(false, "NOT_ADMIN"));
            }
        } else $API->needValue();
    } else $API->needValue();
} else $API->needValue();