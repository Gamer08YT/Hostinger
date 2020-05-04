<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hostinger | Erweiterte Ansicht</title>
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
        <input id="byte_api_cache" hidden value="<?php echo $_GET['id']; ?>">
        <h2 class="header">Bot: #IDKA</h2>
        <a value="<?php echo $_GET['id']; ?>" name="server_start"
           class="waves-effect light-green darken-2 waves-light btn-small"><i
                    class="material-icons right">play_arrow</i>Starten</a>
        <a value="<?php echo $_GET['id']; ?>" name="server_stop"
           class="waves-effect red darken-2 waves-light btn-small"><i class="material-icons right">stop</i>Stoppen</a>
        <div class="col s12 m7">
            <div class="card horizontal gray">
                <div class="card-stacked">
                    <!--[TEST]&#13;&#10;[TEST]-->
                    <a style="font-size: 2rem;" id="ssh_load">&nbsp;Versuche SSH2-Serverstream von Triox2019
                        aufzulösen</a>
                    <textarea style="white-space: pre-wrap;" class="bot-console" id="ssh_console" disabled>
                    </textarea>
                    <div class="card-action">
                        <input id="password" type="password" class="validate">
                        <label for="password" class="">Befehl / Kommando</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include "assets/include/other/footer.php";
?>

<script src="assets/js/jquery-3.4.1.min.js" type="application/javascript"></script>
<script src="assets/js/sweetalert2.all.min.js" type="application/javascript"></script>
<script src="assets/js/materialize.js" type="application/javascript"></script>
<script src="assets/js/byte-site.js" type="application/javascript"></script>
<script src="assets/js/byte-console.js" type="application/javascript"></script>
</body>
</html>