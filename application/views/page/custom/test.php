<!doctype html>
<html lang="en">

<head>

    <title>Solo Abadi</title>
</head>

<body>

    <video style="width:100%" id="preview"></video>


    <script script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?= base_url('assets/vendor/') ?>JQuery/jquery.min.js"></script>
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
            });

        });
    </script>
</body>

</html>