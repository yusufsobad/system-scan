
// sourcode
$(document).ready(function () {
    $("#form").hide();
});
let scanner = new Instascan.Scanner({
    video: document.getElementById('preview')
});
scanner.addListener('scan', function (content) {
    // menampilkan hasil dari scan qr code
    var qrcode = a.content;
    $.ajax({
        type: "POST",
        url: "<?= base_url('Scan/check_data') ?>",
        data: { value: content },
        success: function (data) {
            alert(data)
        }
    });



    $('#qrcode').val(content);
    $('#show-barcode').text(content);
    $("#form").fadeIn()
});
Instascan.Camera.getCameras().then(function (cameras) {
    if (cameras.length > 0) {
        scanner.start(cameras[0]);
    } else {
        console.error('camera tidak di temukan');
    }
}).catch(function (e) {
    console.error(e);
});
