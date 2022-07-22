<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="page-title-box">
                        <h4 class="font-size-18"> <?php if (isset($title)) {
                                                        echo $title;
                                                    } else {
                                                        echo "title Kosong";
                                                    } ?></h4>
                        </h4>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="<?= base_url($this->uri->segment(0))  ?>">Home</a></li>
                            <?php if ($this->uri->segment(1) !== null) { ?>
                                <li class="breadcrumb-item"><a href="<?= base_url($this->uri->segment(1))  ?>"><?= $this->uri->segment(1) ?></a></li>
                            <?php } else {
                            } ?>
                            <?php if ($this->uri->segment(2) !== null) { ?>
                                <li class="breadcrumb-item"><a href="<?= base_url($this->uri->segment(2))  ?>"><?= $this->uri->segment(2) ?></a></li>
                            <?php } else {
                            } ?>
                            <?php if ($this->uri->segment(3) !== null) { ?>
                                <li class="breadcrumb-item"><a href="<?= base_url($this->uri->segment(3))  ?>"><?= $this->uri->segment(3) ?></a></li>
                            <?php } else {
                            } ?>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="col-md-12">
                <?php if (isset($card)) {
                    echo $card;
                } else {
                    echo "Config Card Tidak ada";
                } ?>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->