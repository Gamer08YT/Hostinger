<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hostinger | Status</title>
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
        <h2 class="header">Status</h2>
        <div class="col s12 m7">
            <div class="card horizontal gray">
                <div class="card-content">
                    <p>
                    </p>
                    <h4>Haupt-Server:</h4>
                    <h5>Core-1 Server: <b><a style="color: green;">ONLINE</a></b></h5>
                    <h5>Core-2 Server: <b><a style="color: red;">OFFLINE</a></b></h5><br>
                    <h4>Weitere Dienste:</h4>
                    <h5>Datenbank Server: <b><?php if ($SQL) {?><a style="color: green;">ONLINE</a><?php } else { ?> <a style="color: red;">OFFLINE</a><?php } ?></b></h5>
                    <h5>FTP Server: <b><a style="color: green;">ONLINE</a></b></h5>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include "assets/include/other/footer.php";
?>

<script src="assets/js/jquery-3.4.1.min.js" type="application/javascript"></script>
<script src="assets/js/materialize.js" type="application/javascript"></script>
<script src="assets/js/byte-site.js" type="application/javascript"></script>
</body>
</html>