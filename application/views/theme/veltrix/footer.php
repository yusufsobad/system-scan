<?php $data_company = profile_company(); ?>
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                © <?= date('Y') ?> <span class="d-none d-sm-inline-block"> - <?= $data_company['company_slogan'] ?> - <i class="mdi mdi-heart text-danger"></i><?= $data_company['company_name'] ?></span>
            </div>
        </div>
    </div>
</footer>

</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title px-3 py-4">
            <a href="javascript:void(0);" class="right-bar-toggle float-right">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
            <h5 class="m-0">Settings</h5>
        </div>

        <!-- Settings -->
        <hr class="mt-0" />
        <h6 class="text-center">Choose Layouts</h6>

        <div class="p-4">
            <div class="mb-2">
                <img src="<?= base_url('assets/veltrix/') ?>images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="custom-control custom-switch mb-3">
                <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked />
                <label class="custom-control-label" for="light-mode-switch">Light Mode</label>
            </div>

            <div class="mb-2">
                <img src="<?= base_url('assets/veltrix/') ?>images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="custom-control custom-switch mb-3">
                <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsStyle="<?= base_url('assets/veltrix/') ?>css/bootstrap-dark.min.css" data-appStyle="<?= base_url('assets/veltrix/') ?>css/app-dark.min.css" />
                <label class="custom-control-label" for="dark-mode-switch">Dark Mode</label>
            </div>

            <div class="mb-2">
                <img src="<?= base_url('assets/veltrix/') ?>images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="custom-control custom-switch mb-5">
                <input type="checkbox" class="custom-control-input theme-choice" id="rtl-mode-switch" data-appStyle="<?= base_url('assets/veltrix/') ?>css/app-rtl.min.css" />
                <label class="custom-control-label" for="rtl-mode-switch">RTL Mode</label>
            </div>

            <a href="https://1.envato.market/grNDB" class="btn btn-primary btn-block mt-3" target="_blank"><i class="mdi mdi-cart mr-1"></i> Purchase Now</a>

        </div>

    </div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>


<!-- JAVASCRIPT -->
<script src="<?= base_url('assets/veltrix/') ?>libs/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/veltrix/') ?>libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/veltrix/') ?>libs/metismenu/metisMenu.min.js"></script>
<script src="<?= base_url('assets/veltrix/') ?>libs/simplebar/simplebar.min.js"></script>
<script src="<?= base_url('assets/veltrix/') ?>libs/node-waves/waves.min.js"></script>
<!-- <script src="<?= base_url('assets/vendor/') ?>multi-modal/js/multimodal.js"></script> -->

<!-- Peity chart-->
<script src="<?= base_url('assets/veltrix/') ?>libs/peity/jquery.peity.min.js"></script>

<!-- Plugin Js-->
<!-- <script src="<?= base_url('assets/veltrix/') ?>libs/chartist/chartist.min.js"></script> -->
<!-- <script src="<?= base_url('assets/veltrix/') ?>libs/chartist-plugin-tooltips/chartist-plugin-tooltip.min.js"></script> -->

<!-- <script src="<?= base_url('assets/veltrix/') ?>js/pages/dashboard.init.js"></script> -->

<script src="<?= base_url('assets/veltrix/') ?>js/app.js"></script>

<!-- Custom -->
<script src="<?= base_url('assets/plugin/') ?>multiple-select/js/multiple-select.js"></script>

<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>


</body>

</html>