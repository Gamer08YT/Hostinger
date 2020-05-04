<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hostinger | Produkte</title>
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
        <h2 class="header">Meine Produkte</h2>
        <?php
        $RO = $SQL->query("SELECT * FROM " . DB_PREFIX . "server WHERE user = " . $SESSION->getUser());
        $ROD = $RO;
        if (!empty($ROD)) {
            while ($ROW = $RO->fetch_array()) {
                ?>
                <div class="col s12 m7">
                    <div class="card horizontal gray">
                        <div class="card-image">
                            <img class="bot-icon" src="assets/img/discord_bot_blue.png">
                            <a class="bot-language">
                                <img src="<?php echo $PLATFORM->getImg($ROW['platform']); ?>">
                            </a>
                        </div>
                        <div class="card-stacked">
                            <div class="card-content">
                                <p>
                                    <?php if (!empty($ROW['ftp_user']) && !empty($ROW['ftp_password'])) { ?>
                                <h5>IP-Adresse: <?php echo SSH_HOST; ?></h5>
                                <h5>Nutzername: <?php echo $ROW['ftp_user']; ?></h5>
                                <h5>Passwort: <?php echo $ROW['ftp_password']; ?></h5>
                                <?php } else { ?>
                                    <h4>Produkte wird installiert!</h4>
                                    <h6>Ein Mitarbeiter muss dein Produkt erst zur Installation freigeben!</h6>
                                    <h6>Sollte dieser Text innerhalb 10 Minuten nicht verschwinden, so melde dich in unserem Support!</h6>
                                    <div class="progress">
                                        <div class="indeterminate"></div>
                                    </div>
                                <?php } ?>
                                </p>
                            </div>
                            <div class="card-action">
                                <a href="#" content="id" value="<?php echo $ROW['id']; ?>"
                                   name="server_start">Starten</a>
                                <a href="#" content="id" value="<?php echo $ROW['id']; ?>"
                                   name="server_stop">Stoppen</a>
                                <a href="?page=extended&id=<?php echo $ROW['id']; ?>">Erweiterte Ansicht</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
        } else {
            ?>
            <div class="col s12 m7">
                <div class="card horizontal gray">
                    <div class="card-stacked">
                        <div class="card-content">
                            <p>
                            <h4>Kein Produkt vorhanden!</h4>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } ?>
    </div>
</main>
<?php
include "assets/include/other/footer.php";
?>

<script src="assets/js/jquery-3.4.1.min.js" type="application/javascript"></script>
<script src="assets/js/materialize.js" type="application/javascript"></script>
<script src="assets/js/byte-site.js" type="application/javascript"></script>
<script src="assets/js/sweetalert2.all.min.js" type="application/javascript"></script>
</body>
</html>