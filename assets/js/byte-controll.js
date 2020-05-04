async function addUser() {
    const {value: email} = await Swal.fire({
        title: 'Kunde anlegen',
        input: 'email',
        validationMessage: 'Bitte das Email Format beachten!',
        confirmButtonText: 'Erstellen',
        inputPlaceholder: 'kunde@provider.dns'
    });

    if (email) {
        $.ajax({
            type: "POST",
            url: 'assets/php/api/userCreate.php',
            data: {
                handshake: $("#byte_api_hash").val(),
                email: email
            },
            success: function (data) {
                console.log(data);
                var json = JSON.parse(data);
                if (json.status === "error") {
                    if (json.value === "MAIL_EXITS") {
                        Swal.fire({
                            type: 'error',
                            text: 'Der Benutzer mit der Email ' + email + ' existiert bereits!',
                        }).then(function () {
                            addUser();
                        });
                    } else if (json.value === "MAIL_ERROR") {
                        Swal.fire({
                            type: 'error',
                            text: 'Der Mailserver konnte die Anfrage nicht verarbeiten!',
                        });
                    }
                } else {
                    Swal.fire({
                        type: 'success',
                        text: 'Der Benutzer mit der Email ' + email + ' wurde erfolgreich erstellt! Der neue Benutzer erhält eine Email in welcher er seine Daten setzten kann!',
                    }).then(function () {
                        window.location.reload();
                    });
                }
            }
        });
    }
}

function installServer(id, customer) {
    $.ajax({
        type: "POST",
        url: 'assets/php/api/serverCreate.php',
        data: {
            handshake: $("#byte_api_hash").val(),
            server_user: customer,
            server_id: id
        },
        success: function (data) {
            console.log(data);

            Swal.fire({
                type: 'info',
                html: 'Der Dienst wurde erfolgreich installiert! Der Benutzer kann <b>per FTP</b> seine Bot Binaries hochladen!',
            }).then(function () {
                window.location.reload();
            });
        }
    });
}

async function addServer() {
    const {value: fruit} = await Swal.fire({
        title: 'Runtime',
        input: 'select',
        inputOptions: {
            javascript: 'JavaScript',
            java: 'Java',
        },
        inputPlaceholder: 'Bitte Runtime für Server-BIN auswählen!',
        showCancelButton: true,
    });
    // setCustomer(fruit);

    if (fruit) {
        console.log(fruit);
        setCustomer(fruit);
    }
}

