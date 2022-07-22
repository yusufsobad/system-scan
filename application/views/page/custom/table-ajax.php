<table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Code</th>
            <th scope="col">Qty</th>
            <th scope="col">Penerima</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0; ?>
        <?php foreach ($data_scan as $key) { ?>
            <tr>
                <th scope="row"><?= ++$no ?></th>
                <th scope="row"><?= $key['qrcode'] ?></th>
                <th scope="row"><?= $key['jumlah'] ?></th>
                <th scope="row"><?= $key['receiver'] ?></th>
                <th><button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal">
                        Edit
                    </button></th>
            </tr>
        <?php } ?>
    </tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('Scan/insert_data')  ?>">
                <?php foreach ($data_scan as $key) { ?>
                    <div class="modal-body text-left">
                        <div class="form-group">
                            <label>Product ID</label>
                            <input type="text" value="<?= $key['qrcode'] ?>" disabled="true" class="form-control" id="qrcode" name="qrcode">
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="text" value="<?= $key['jumlah'] ?>" class="form-control" id="qty" name="qty" placeholder="Input Quantity">
                        </div>
                        <div class="form-group">
                            <label>Penerima</label>
                            <input type="text" value="<?= $key['receiver'] ?>" class="form-control" id="penerima" name="penerima" placeholder="Input Nama Penerima">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                <?php } ?>
            </form>
        </div>
    </div>
</div>