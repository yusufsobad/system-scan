<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/bootstrap-4/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/bootstrap-4/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/bootstrap-4/css/bootstrap.min.css">

    <title>Solo Abadi</title>
</head>

<body>

    <div class="row align-items-center">
        <div class="col text-center p-5">
            <h1 class="bold">Scan Barcode Disini</h1>
            <video autoplay style="width:100%;transform: scaleX(-1);" class="rounded" id="preview"></video>
        </div>
        <div class="col p-5 bg-light-primary">
            <div id="title-form" class="text-center pb-4">
                <h1>Input Data Qrcode</h1>
            </div>
            <div class="card rounded shadow p-3 mb-5 bg-white rounded" id="form_scan" style="min-height: 326px;">

            </div>
        </div>
    </div>
    <div id="destinate"></div>


    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Instan-Scan -->
    <script script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?= base_url('assets/plugin/') ?>instascan/js/instascan.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", event => {
            let scanner = new Instascan.Scanner({
                video: document.getElementById('preview')
            });
            Instascan.Camera.getCameras().then(cameras => {
                scanner.camera = cameras[cameras.length - 1];
                scanner.start();
            }).catch(e => console.error(e));

            scanner.addListener('scan', content => {
                console.log(content);

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('Scan/check_data') ?>",
                    data: {
                        value: content
                    },
                }).done(function(data) {
                    // you may safely use results here
                    console.log(data);

                    if (data == 'true') {
                        window.alert("Qrcode already found");
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url('Scan/form_ajax') ?>",
                            data: {
                                value: content
                            },
                            success: function(response) {
                                $('#form_scan').html(response);
                                $('#form_scan').html(response);
                                $("#title-form").fadeIn(700);
                                $('#qrcode').val(content);
                                $('html, body').animate({
                                    scrollTop: $("#destinate").offset().top
                                }, 2000);
                            },
                        })
                    } else {
                        window.alert("Success");
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url('Scan/form_ajax') ?>",
                            data: {
                                value: content
                            },
                            success: function(response) {
                                $('#form_scan').html(response);
                                $("#title-form").fadeIn(700);
                                $('#qrcode').val(content);
                                $('html, body').animate({
                                    scrollTop: $("#destinate").offset().top
                                }, 2000);
                            },
                        })
                    }
                });
            });

        });
    </script>





    <!-- Bootstrap - Js -->
    <script src="<?= base_url('assets') ?>/vendor/bootstrap-4/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets') ?>/vendor/bootstrap-4/js/bootstrap.bundle.min.js"></script>

</body>

</html>