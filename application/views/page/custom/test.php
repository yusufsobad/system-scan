<!doctype html>
<html lang="en">

<head>

    <title>Solo Abadi</title>
</head>

<body>

    <video style="width:100%" id="preview"></video>

    <div id="title-form" class="text-center pb-4">
        <h1>Input Data Qrcode</h1>
    </div>
    <div class="card rounded shadow p-3 mb-5 bg-white rounded" id="form_scan" style="min-height: 326px;">
    </div>
    <div id="destinate"></div>


    <script script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?= base_url('assets/vendor/') ?>JQuery/jquery.min.js"></script>
    <!-- <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> -->
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
                                // $('#show-barcode').text(content);
                                $('#form_scan').html(response);
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
                                // $('#show-barcode').text(content);
                                $('#form_scan').html(response);
                                $("#title-form").fadeIn(700);
                                $("#form_scan").fadeIn(700);
                                $('#qrcode').val(content);
                                $('html, body').animate({
                                    scrollTop: $("#destinate").offset().top
                                }, 2000);
                            },
                        })
                        // $('#show-barcode').text(content);
                        // $('#form_scan').show();

                        // $("#form").fadeIn()
                    }
                });
            });

        });
    </script>


</body>

</html>