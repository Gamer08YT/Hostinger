<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hostinger | Anmelden</title>
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
session_destroy();
include "assets/include/other/header.php";
?>
<main>
    <div class="container">
        <br><br><br><br>
        <div class="row">
            <div class="col s7" style="margin-right: 15%; margin-left: 20%;">
                <div class="card horizontal gray">
                    <div class="card-content" style="width: 100%">
                        <?php if ($SQL) { ?>
                            <form id="login_form">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="email" type="email" name="email" class="validate" required>
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="password" name="password" type="password" class="validate" required>
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col m3">
                                        <a>Angemeldet bleiben:</a>
                                    </div>
                                    <div class="input-field col m3">
                                        <div class="switch">
                                            <label>
                                                Nein
                                                <input type="checkbox">
                                                <span class="lever"></span>
                                                Ja
                                            </label>
                                        </div>
                                    </div>
                            </form>
                            <div class="input-field col m3" style="float: right;">
                                <button class="btn waves-effect waves-light" type="submit">
                                    Anmelden
                                    <i class="material-icons right">arrow_forward</i>
                                </button>
                            </div>
                        <?php } else { ?>
                        <div class="card-content">
                            <p>
                            <h4>Leider sind unsere Dienste derzeit nicht erreichbar!</h4>
                            <h5>Datenbank Server: <b><a style="color: red;">OFFLINE</a></b>
                                </b></h5><br>
                            <a href="?page=status">Server-Status-Seite</a>
                            </p>
                            <?php } ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<br><br><br><br>
<?php
include "assets/include/other/footer.php";
?>

<script src="assets/js/jquery-3.4.1.min.js" type="application/javascript"></script>
<script src="assets/js/jquery.validate.min.js" type="application/javascript"></script>
<script src="assets/js/materialize.js" type="application/javascript"></script>
<script src="assets/js/byte-site.js" type="application/javascript"></script>
<script src="assets/js/sweetalert2.all.min.js" type="application/javascript"></script>
</body>
</html>