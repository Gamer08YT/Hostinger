$(document).ready(function () {
    setTimeout(function () {
        reloadSocket();
    }, 3000);
});

function reloadSocket() {
    setTimeout(function () {
            $.ajax({
                type: "POST",
                url: 'assets/php/api/serverConsole.php',
                data: {
                    handshake: $("#byte_api_hash").val(),
                    serverID: $("#byte_api_cache").val()
                },
                success: function (data) {
                    //console.log(data);
                    var json = JSON.parse(data);
                    if (json.status === "success") {
                        var elements = document.getElementById('ssh_load');
                        if (typeof (elements) != 'undefined' && elements != null) {
                            elements.remove();
                        }
                        document.getElementById("ssh_console").innerText = json.value.toString().replace("\r\n", "&#13;&#10;");
                    } else {
                        Swal.fire({
                            type: 'error',
                            text: 'Wir konnten die Console anzapfen, das Problem liegt bei uns!',
                        });
                    }
                }
            });
            reloadSocket();
        }

        ,
        3000
    )
    ;
}