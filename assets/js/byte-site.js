var logout = 10;
var title = "";
var ssh_loader = "";
var ssh_stand = 0;

$(document).ready(function () {
    $('.sidenav').sidenav();
    $('.datepicker').datepicker();
    $(".dropdown-login").dropdown();
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        $(".dropdown-login-m").dropdown();
    }

    title = document.title;
    console.log(title);
    document.addEventListener('visibilitychange', function (e) {
        if (document.hidden === true) {
            document.title = "Du willst schon gehen?";
        } else {
            document.title = title;
        }

    });

    var element = document.getElementById('logout_redirect');
    if (typeof (element) != 'undefined' && element != null) {
        redirect();
    }

    document.addEventListener('DOMContentLoaded', function () {
        var elems = document.querySelectorAll('.fixed-action-btn');
        var instances = M.FloatingActionButton.init(elems, options);
    });

    /*var instances = M.TapTarget.getInstance(document.getElementById(""));
    instances.open();*/



    $(document).ready(function () {
        $('.fixed-action-btn').floatingActionButton();
    });


    var elements = document.getElementById('ssh_load');
    if (typeof (elements) != 'undefined' && elements != null) {
        ssh_loader = elements.innerText;
        loadSSH(9907);
    }

    function loadSSH(baud) {
        var textele = document.getElementById('ssh_load');
        if (ssh_stand > 3) {
            textele.innerText = ssh_loader;
            ssh_stand = 0;
        } else {
            ssh_stand++;
            textele.innerText += ".";
        }
        setTimeout(function () {
            loadSSH(9907);
        }, 1000);
    }

    $("a").click(function (ev) {
        var val = $(this).val();
        if ($(this).attr('name') === "server_start") {
            $.ajax({
                type: "POST",
                url: 'assets/php/api/serverStart.php',
                data: {
                    handshake: $("#byte_api_hash").val(),
                    serverID: $(this).attr('value')
                },
                success: function (data) {
                    console.log(data);
                    var json = JSON.parse(data);
                    if (json.status === "error") {
                        if (json.value === "SERVER_ONLINE") {
                            Swal.fire({
                                type: 'info',
                                text: 'Wir konnten deinen Bot nicht starten, da er bereits aktiv ist!',
                            });
                        } else if (json.value === "SERVER_BINARY") {
                            Swal.fire({
                                type: 'error',
                                html: 'Dein Bot verfügt über keine <u><b>index.js</b></u> oder <u><b>DiscordBot.jar</b></u> Datei!',
                            });
                        } else if (json.value === "WRAPPER_OFFLINE") {
                            Swal.fire({
                                type: 'error',
                                text: 'Wir konnten deinen Bot nicht starten, das Problem liegt bei uns!',
                            });
                        }
                    } else {
                        Swal.fire({
                            type: 'success',
                            text: 'Dein Bot wurde erfolgreich gestartet!',
                        });
                    }
                }
            });
        } else if ($(this).attr('name') === "delete_user") {
            $.ajax({
                type: "POST",
                url: 'assets/php/api/userDelete.php',
                data: {
                    handshake: $("#byte_api_hash").val(),
                    id: $(this).attr('value')
                },
                success: function (data) {
                    console.log(data);
                    var json = JSON.parse(data);
                    if (json.status === "error") {

                    } else {
                        Swal.fire({
                            type: 'success',
                            text: 'Der Benutzer wurde erfolgreich gelöscht!',
                        }).then(function () {
                            window.location.reload();
                        });
                    }
                }
            });
        } else if ($(this).attr('name') === "server_stop") {
            $.ajax({
                type: "POST",
                url: 'assets/php/api/serverStop.php',
                data: {
                    handshake: $("#byte_api_hash").val(),
                    serverID: $(this).attr('value')
                },
                success: function (data) {
                    var json = JSON.parse(data);
                    if (json.status === "error") {
                        if (json.value === "WRAPPER_OFFLINE") {
                            Swal.fire({
                                type: 'error',
                                text: 'Wir konnten deinen Bot nicht starten, das Problem liegt bei uns!',
                            });
                        } else if (json.value === "SERVER_OFFLINE") {
                            Swal.fire({
                                type: 'info',
                                text: 'Dein Bot ist bereits Offline!',
                            });
                        } else {
                            Swal.fire({
                                type: 'error',
                                text: 'Wir konnten deinen Bot nicht stoppen!',
                            });
                        }
                    } else if (json.status === "success") {
                        Swal.fire({
                            type: 'success',
                            text: 'Dein Bot wurde erfolgreich gestoppt!',
                        });
                    }
                }
            });
        } else if ($(this).attr('name') === "not_exits") {
            Swal.fire({
                type: 'info',
                text: 'Du hast keine Rechte auf diese Funktion!',
            });
        } else {
            if ($(this).attr('href') !== undefined) {
                window.location.href = $(this).attr('href');
            }
        }
    });
    $('#login_form').submit(function (e) {

        e.preventDefault();
        var $form = $(this);

        // check if the input is valid
        if (!$form.valid()) return false;

        $.ajax({
            type: 'POST',
            url: 'assets/php/api/login.php',
            data: $form.serialize(),
            success: function (response) {
                console.log(response);
                var json = JSON.parse(response);
                if (json.status === "error") {
                    Swal.fire({
                        type: 'error',
                        title: 'Oh nein...',
                        text: 'Es sieht so aus als würde es die Daten nicht geben!',
                    });
                } else if (json.status === "success") {
                    Swal.fire({
                        type: 'success',
                        title: 'Weiterleitung',
                        text: 'Du wurdest erfolgreich angemeldet, die Weiterleitung folgt in kürze!',
                    });
                    setTimeout(function () {
                        window.location.href = '?page=server';
                    }, 5000);
                }
            }

        });
    });

    $('#verify_form').submit(function (e) {

        e.preventDefault();
        var $form = $(this);

        // check if the input is valid
        if (!$form.valid()) return false;

        $.ajax({
            type: 'POST',
            url: 'assets/php/api/verify.php',
            data: $form.serialize(),
            success: function (response) {
                console.log(response);
                var json = JSON.parse(response);
                if (json.status === "error") {
                    Swal.fire({
                        type: 'error',
                        title: 'Oh nein...',
                        text: 'Es sieht so aus als würde es die Daten nicht geben!',
                    });
                } else if (json.status === "success") {
                    Swal.fire({
                        type: 'success',
                        title: 'Weiterleitung',
                        text: 'Du wurdest erfolgreich angemeldet, die Weiterleitung folgt in kürze!',
                    });
                    setTimeout(function () {
                        window.location.href = '?page=server';
                    }, 5000);
                }
            }

        });
    });
})
;

function redirect() {
    setTimeout(function () {
        logout = logout - 1;
        document.getElementById("logout_redirect").innerText = logout;
        if (logout > 0) {
            redirect();
        } else {
            window.location.href = '?page=index';
        }
    }, 1000);
}