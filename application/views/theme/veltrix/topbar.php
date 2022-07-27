<?php $data_session = data_session(); ?>
<?php $data_company = profile_company(); ?>

<header id="page-topbar">
    <div id="allert-success" style="position: absolute; right:0;top: 70px;display:none" class="alert alert-success bg-success text-white border-0" role="alert">
        <strong>Data Berhasil Discan!</strong>
    </div>
    <div id="allert-warning" style="position: absolute; right:0;top: 70px;display:none" class="alert alert-warning bg-warning text-white border-0" role="alert">
        <strong>Data Sudah Ada!</strong>
    </div>
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?= $data_company['company_icon'] ?>" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= $data_company['company_logo_secondary'] ?>" alt="" height="25">
                    </span>
                </a>
            </div>
            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-menu"></i>
            </button>
        </div>
        <div class="d-flex">
            <div class="dropdown d-none d-lg-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="mdi mdi-fullscreen"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="https://s.soloabadi.com/system-absen/asset/img/user/<?= $data_session['notes_pict'] ?>" alt="Header Avatar">
                </button>
                <div class="dropdown-menu dropdown-menu-right p-3">
                    <!-- item-->
                    <h6><?= $data_session['name'] ?></h6>
                    <p class="text-muted"><?= $data_session['_email'] ?></p>
                    <p class="text-muted"><?= $data_session['_address'] ?></p>
                    <p class="text-muted"><?= $data_session['phone_no'] ?></p>
                    <a class="dropdown-item bg-danger text-light rounded text-center" href="<?= site_url("Login/logout") ?>"><i class="bx bx-power-off font-size-13 align-center "></i>Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>