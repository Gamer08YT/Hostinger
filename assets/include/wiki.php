<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hostinger | Startseite</title>
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
        <h2 class="header">Wiki</h2>
        <div class="row">
            <div class="col s6">
                <div class="card gray">
                    <div class="card-content">
                        <h5>NodeJS</h5>
                        <ul class="collapsible">
                            <li>
                                <div class="collapsible-header"><i class="material-icons">menu_book</i>Vorbereitung
                                </div>
                                <div class="collapsible-body"><span>Um deinen Bot hochzuladen benötigst du ein FTP (File Transfer Protokoll) fähigen File-Browser!</span></div>
                            </li>
                            <li>
                                <div class="collapsible-header"><i class="material-icons">cloud_upload</i>Upload</div>
                                <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                            </li>
                            <li>
                                <div class="collapsible-header"><i class="material-icons">build</i>Fehlerbehebung</div>
                                <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col s6">
                <div class="card gray">
                    <div class="card-content">
                        <h5>Java</h5>
                        <ul class="collapsible">
                            <li>
                                <div class="collapsible-header"><i class="material-icons">menu_book</i>Vorbereitung
                                </div>
                                <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                            </li>
                            <li>
                                <div class="collapsible-header"><i class="material-icons">cloud_upload</i>Upload</div>
                                <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                            </li>
                            <li>
                                <div class="collapsible-header"><i class="material-icons">build</i>Fehlerbehebung</div>
                                <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="card gray">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s9">
                                <h5>Deine Plattform ist nicht dabei, dann melde dich einfach bei uns!</h5>
                            </div>
                            <div class="col s3">
                                <button class="btn waves-effect waves-light" style="float: right; top: 20px; bottom: 20px;" type="submit" name="action">Anfrage stellen
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<br><br>
<?php
include "assets/include/other/footer.php";
?>


<script src="assets/js/jquery-3.4.1.min.js" type="application/javascript"></script>
<script src="assets/js/materialize.js" type="application/javascript"></script>
<script src="assets/js/byte-site.js" type="application/javascript"></script>
<script>
    $('.collapsible').collapsible();
</script>
</body>
</html>