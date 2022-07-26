<form method="post" action="<?= base_url($post_action)  ?>">
    <?php foreach ($data_scan as $key) { ?>
        <div class="form-group">
            <label>Qr Code</label>
            <input type="text" value="<?= $key['delivery_code'] ?>" readonly class="form-control" id="delivery_code" name="delivery_code">
        </div>
        <div class="form-group">
            <label>Quantity</label>
            <input type="text" value="<?= $key['qty'] ?>" class="form-control" id="qty" name="qty" placeholder="Input Quantity">
        </div>
        <div class="form-group">
            <label>Penerima</label>
            <input type="text" value="<?= $key['penerima'] ?>" class="form-control" id="penerima" name="penerima" placeholder="Input Nama Penerima">
        </div>
        <div class="form-group">
            <label>No Telp</label>
            <input type="text" value="<?= $key['no_telp'] ?>" class="form-control" id="no_telp" name="no_telp" placeholder="Input Nomor Telephone">
        </div>
        <div class="form-group">
            <label>Note</label>
            <input type="text" value="<?= $key['note'] ?>" class="form-control" id="note" name="note" placeholder="Input Catatan Jika ada">
        </div>
    <?php } ?>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>