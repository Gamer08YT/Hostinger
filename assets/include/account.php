<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hostinger | Account</title>
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
        <?php if ($SESSION->isLogged()) {
            $DATA = $SQL->query("SELECT * FROM " . DB_PREFIX . "user WHERE id = " . $SESSION->getUser());
            if (!empty($DATA)) {
                $DATA = $DATA->fetch_array();
                ?>
                <h2 class="header">Benutzer</h2>
                <div class="card horizontal gray">
                    <div class="card-content" style="width: 100%">
                        <div class="row">
                            <div class="input-field col m6">
                                <input id="first_name" value="<?php if (!empty($DATA['first_name'])) {
                                    echo $DATA['first_name'];
                                } ?>" type="text">
                                <label for="first_name">Vorname</label>
                            </div>
                            <div class="input-field col m6">
                                <input id="last_name" value="<?php if (!empty($DATA['last_name'])) {
                                    echo $DATA['last_name'];
                                } ?>" type="text">
                                <label for="last_name">Nachname</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="email" value="<?php if (!empty($DATA['email'])) {
                                    echo $DATA['email'];
                                } ?>" type="email" class="validate">
                                <label for="email" class="">Email</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="birthday" value="<?php if (!empty($DATA['birthday'])) {
                                    echo $DATA['birthday'];
                                } ?>" type="text" class="datepicker">
                                <label for="birthday" class="">Geburtstag</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m3">
                                <a>Störungen per EMail erhalten:</a>
                            </div>
                            <div class="input-field col m2">
                                <div class="switch">
                                    <label>
                                        Nein
                                        <input type="checkbox">
                                        <span class="lever"></span>
                                        Ja
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button class="btn waves-effect waves-light" style="float: right;" type="submit"
                                disabled name="action">
                            Speichern
                            <i class="material-icons right">save</i>
                        </button>
                    </div>
                </div>
            <?php }
        } else { ?>
            <br><br><br><br>
            <div class="col s12 m7">
                <div class="card horizontal gray">
                    <div class="card-content">
                        <p>
                        <h4>Einstellungen</h4>
                        <h5>Weitere Einstellungen werden nach dem Login angezeigt!</h5>
                        <br>
                        <a class="waves-effect waves-light btn">Cookies löschen</a>
                        </p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</main>
<?php
include "assets/include/other/footer.php";
// 46.167.13.16 // 212.241.119.114
?>

<script src="assets/js/jquery-3.4.1.min.js" type="application/javascript"></script>
<script src="assets/js/materialize.js" type="application/javascript"></script>
<script src="assets/js/byte-site.js" type="application/javascript"></script>
</body>
</html>
