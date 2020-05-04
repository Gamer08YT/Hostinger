<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hostinger | Verifizierung</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" type="text/css" href="assets/css/byte-site.css">
    <link rel="stylesheet" type="text/css" href="assets/css/materialize.css">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

<?php
include "assets/include/other/header.php";
?>
<main>
    <div class="container">
        <?php
        if (isset($_GET['verify'])) {
            $DATA = $SQL->query("SELECT * FROM " . DB_PREFIX . "user WHERE `key` = '" . $_GET['verify'] . "'");
            list($total) = mysqli_fetch_row($DATA);
            if ($total != 0) {
                ?>
                <form id="verify_form">
                    <input name="byte_verify_key" hidden value="<?php echo $_GET['verify']; ?>">
                    <h2 class="header">Benutzer vervollständigen</h2>
                    <div class="card horizontal gray">
                        <div class="card-content" style="width: 100%">
                            <div class="row">
                                <div class="input-field col m6">
                                    <input id="first_name" name="first_name" type="text" required>
                                    <label for="first_name">Vorname</label>
                                </div>
                                <div class="input-field col m6">
                                    <input id="last_name" name="last_name" type="text" required>
                                    <label for="last_name">Nachname</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="birthday" name="birthday" type="text" class="datepicker" required>
                                    <label for="birthday" class="">Geburtstag</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col m6">
                                    <input id="password" name="password" type="password" required>
                                    <label for="password">Passwort</label>
                                </div>
                                <div class="input-field col m6">
                                    <input id="password_new" name="password_new" type="password" required>
                                    <label for="password_new">Passwort wiederholen</label>
                                </div>
                            </div>
                            <button class="btn waves-effect waves-light" style="float: right;" type="submit"
                                    name="user_verify">
                                Speichern
                                <i class="material-icons right">save</i>
                            </button>
                        </div>
                    </div>
                </form>
                <?php
            } else {
                ?>
                <br><br><br><br>
                <div class="col s12 m7">
                    <div class="card horizontal gray">
                        <div class="card-content">
                            <p>
                            <h4>Du wurdest bereits verifiziert!</h4>
                            <h5>Weiterleitung erfolgt in <b id="logout_redirect">10</b></h5>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
            }
        } ?>
    </div>
</main>
<?php
include "assets/include/other/footer.php";
// 46.167.13.16 // 212.241.119.114
?>

<script src="assets/js/jquery-3.4.1.min.js" type="application/javascript"></script>
<script src="assets/js/jquery.validate.min.js" type="application/javascript"></script>
<script src="assets/js/materialize.js" type="application/javascript"></script>
<script src="assets/js/byte-site.js" type="application/javascript"></script>
<script src="assets/js/sweetalert2.all.min.js" type="application/javascript"></script>
</body>
</html>
