<?php $data_company = profile_company(); ?>
<?php $data_session = data_session(); ?>
<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="blue">
        <a href="<?= $data_company['company_site'] ?>" class="logo">
            <img style="width:150px" src="<?= $data_company['company_logo_secondary'] ?>" alt="navbar brand" class="navbar-brand">
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm bg-light rounded">
                            <img src="https://s.soloabadi.com/system-absen/asset/img/user/<?= $data_session['notes_pict'] ?>" alt="..." class="avatar-img rounded-circle">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg"><img src="https://s.soloabadi.com/system-absen/asset/img/user/<?= $data_session['notes_pict'] ?>" alt="image profile" class="avatar-img rounded"></div>
                                    <div class="u-text">
                                        <h4><?= $data_session['name'] ?></h4>
                                        <p class="text-muted"><?= $data_session['_email'] ?></p>
                                        <p class="text-muted"><?= $data_session['_address'] ?></p>
                                        <p class="text-muted"><?= $data_session['phone_no'] ?></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= site_url("Login/logout") ?>">Logout</a>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div id="notifications"><?php echo $this->session->flashdata('data'); ?></div>
    <!-- End Navbar -->
</div>