<form method="post" action="<?= base_url($post_action)  ?>">
    <?php foreach ($data_scan as $key) { ?>
        <div class="form-group">
            <label>Qr Code</label>
            <input type="text" value="<?= $key['qrcode'] ?>" readonly class="form-control" id="qrcode" name="qrcode">
        </div>
    <?php } ?>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>