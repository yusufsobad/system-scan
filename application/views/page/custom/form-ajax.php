<form method="post" action="<?= base_url($post_action)  ?>">
    <?php foreach ($data_scan as $key) { ?>
        <div class="form-group">
            <label>Qr Code</label>
            <input type="text" value="<?= $key['qrcode'] ?>" readonly class="form-control" id="qrcode" name="qrcode">
        </div>
        <div class="form-group">
            <label>Quantity</label>
            <input type="text" value="<?= $key['jumlah'] ?>" class="form-control" id="qty" name="qty" placeholder="Input Quantity">
        </div>
        <div class="form-group">
            <label>Penerima</label>
            <input type="text" value="<?= $key['receiver'] ?>" class="form-control" id="penerima" name="penerima" placeholder="Input Nama Penerima">
        </div>
    <?php } ?>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>