<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hostinger | Control-CP</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" type="text/css" href="assets/css/byte-site.css">
    <link rel="stylesheet" type="text/css" href="assets/css/materialize.css">
    <link rel="stylesheet" type="text/css" href="assets/js/table/DataTables-1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="assets/js/table/Editor-2019-11-12-1.9.2/css/editor.dataTables.css">
    <link rel="stylesheet" type="text/css" href="assets/js/table/Responsive-2.2.3/css/responsive.dataTables.css">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

<?php
include "assets/include/other/header.php";
?>
<main>
    <div class="container">
        <?php if ($SESSION->isAdmin()) { ?>
            <h2 class="header">Controll-CP</h2>
            <div class="card horizontal gray">
                <div class="card-content" style="width: 100%">
                    <canvas id="server_usage">

                    </canvas>
                </div>
            </div>

            <h3 class="header">Benutzer</h3>
            <a name="user_add"
               onclick="addUser();" class="waves-effect amber accent-4 waves-light btn-small"><i
                        class="material-icons right">add</i>Hinzufügen</a>
            <div class="card horizontal gray">
                <div class="card-content" style="width: 100%">
                    <table id="user_table">
                        <thead>
                        <tr>
                            <th>Vorname</th>
                            <th>Nachname</th>
                            <th>EMail</th>
                            <th>ID / Aktion</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $DATA = $SQL->query("SELECT * FROM " . DB_PREFIX . "user");
                        while ($ROW = $DATA->fetch_array()) {
                            ?>
                            <tr>
                                <td><?php if (!empty($ROW['first_name'])) {
                                        echo $ROW['first_name'];
                                    } else {
                                        echo "<b>NOT-ACTIVATED: " . $ROW['email'] . "</b>";
                                    } ?></td>
                                <td><?php echo $ROW['last_name']; ?></td>
                                <td><?php echo $ROW['email']; ?></td>
                                <td style="width: 35%">
                                    <a name="not_exits"
                                       class="waves-effect amber accent-4 waves-light btn-small"
                                       value="<?php echo $ROW['id']; ?>"><i
                                                class="material-icons right">arrow_right_alt</i>Anmelden</a>
                                    <a name="delete_user"
                                       class="waves-effect grey lighten-1 waves-light btn-small"
                                       value="<?php echo $ROW['id']; ?>"><i
                                                class="material-icons right">restore_from_trash</i>Löschen</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <h3 class="header">Dienste</h3>
            <a name="server_add" onclick="addServer();"
               class="waves-effect amber accent-4 waves-light btn-small"><i
                        class="material-icons right">add</i>Hinzufügen</a>
            <div class="card horizontal gray">
                <div class="card-content" style="width: 100%">
                    <table id="service_table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Kunde</th>
                            <th>Platform</th>
                            <th>ID / Aktion</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $DATA = $SQL->query("SELECT * FROM " . DB_PREFIX . "server");
                        while ($ROW = $DATA->fetch_array()) {
                            ?>
                            <tr>
                                <td><?php echo $ROW['name'] ?></td>
                                <td>Jan Heil</td>
                                <td><img height="30px" src="<?php echo $PLATFORM->getImg($ROW['platform']); ?>"></td>
                                <?php if (empty($ROW['ftp_user']) && empty($ROW['ftp_password'])) { ?>
                                <td style="width: 50%">
                                    <?php } else {
                                    ?>
                                <td style="width: 35%">
                                    <?php
                                    } ?><a name="server_start" value="<?php echo $ROW['id']; ?>"
                                           class="waves-effect light-green darken-2 waves-light btn-small"><i
                                                class="material-icons right">play_arrow</i>Starten&nbsp;</a>
                                    <a name="server_stop" value="<?php echo $ROW['id']; ?>"
                                       class="waves-effect red darken-2 waves-light btn-small"><i
                                                class="material-icons right">stop</i>Stoppen&nbsp;</a>
                                    <a name="server_stop" value="<?php echo $ROW['id']; ?>"
                                       class="waves-effect grey lighten-1 waves-light btn-small"><i
                                                class="material-icons right">restore_from_trash</i>Löschen</a>
                                    <?php
                                    if (empty($ROW['ftp_user']) && empty($ROW['ftp_password'])) {
                                        ?>
                                        <a onclick="installServer(<?php echo $ROW['id']; ?>, <?php echo $ROW['user']; ?>)" class="waves-effect deep-orange darken-1 btn-small"><i
                                                    class="material-icons right">build</i>Installieren</a>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>
    </div>
</main>
<?php
include "assets/include/other/footer.php";
?>

<script src="assets/js/jquery-3.4.1.min.js" type="application/javascript"></script>
<script src="assets/js/materialize.js" type="application/javascript"></script>
<script src="assets/js/sweetalert2.all.min.js" type="application/javascript"></script>
<script src="assets/js/byte-site.js" type="application/javascript"></script>
<script src="assets/js/byte-controll.js" type="application/javascript"></script>
<script src="assets/js/Chart.js" type="application/javascript"></script>
<script src="assets/js/table/DataTables-1.10.20/js/jquery.dataTables.js" type="application/javascript"></script>
<script src="assets/js/table/Editor-2019-11-12-1.9.2/js/dataTables.editor.js" type="application/javascript"></script>
<script src="assets/js/table/Responsive-2.2.3/js/dataTables.responsive.js" type="application/javascript"></script>

<script>
    async function setCustomer(platform) {
        const {value: user} = await Swal.fire({
            title: 'Benutzer',
            input: 'select',
            inputOptions: {
                <?php    $DATA = $SQL->query("SELECT * FROM " . DB_PREFIX . "user WHERE `key` = 'verify'");
                while ($ROW = $DATA->fetch_array()) {
                    echo $ROW['id'] . ": '" . $ROW['first_name'] . " " . $ROW['last_name'] . "', ";
                } ?>
            },
            inputPlaceholder: 'Bitte Runtime für Server-BIN auswählen!',
            showCancelButton: true,
        });

        if (user) {
            $.ajax({
                type: "POST",
                url: 'assets/php/api/serverAdd.php',
                data: {
                    handshake: $("#byte_api_hash").val(),
                    user_server: user,
                    platform_server: platform
                },
                success: function (data) {
                    Swal.fire({
                        type: 'info',
                        html: 'Der Dienst wurde erfolgreich angelegt! Bitte wähle noch <b>den Installations Button</b> an!',
                    }).then(function () {
                        window.location.reload();
                    });
                }
            });
        }
    }
</script>

<script>
    var chart = new Chart(document.getElementById("server_usage"), {
            type: 'line',
            "data": {
                "datasets": [
                    {
                        "label": "CPU Auslastung",
                        "fill": true,
                        "borderColor": "rgb(75, 192, 192)",
                        "lineTension": 0.1
                    }
                ],
            },
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                hover: {
                    mode: 'label'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Uhrzeit'
                        },
                        scales: {
                            xAxes: [{
                                type: 'time',
                                time: {
                                    unit: 'month'
                                }
                            }]
                        }
                    }],
                    yAxes:
                        [{
                            display: true,
                            stacked: true,
                            ticks: {
                                beginAtZero: true,
                                max: 100
                            }
                        }]
                }
            }
        })
    ;

    $(document).ready(function () {
        $('#user_table').DataTable();
        $('#service_table').DataTable();

        addData(this.chart);
    });
    var labels = 0;

    function addData(chart) {
        setTimeout(function () {
            addData(this.chart);
        }, 6000);

        var today = new Date();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        chart.data.labels.push("" + time);
        chart.data.datasets.forEach((dataset) => {
            dataset.data.push(Math.random() * 100);
        });
        chart.update();

        if (labels < 15) {
            labels++;
        } else {
            removeData(chart);
            removeData(chart);
            labels--;
        }
    }

    function removeData(chart) {
        chart.data.labels.splice(0, 1);
        chart.data.datasets[0].data.splice(0, 1);
        chart.update();
    }
</script>
</body>
</html>

