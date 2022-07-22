<!doctype html>
<html lang="en">
<?php $data_company = profile_company(); ?>

<head>
    <meta charset="utf-8" />
    <title><?= $data_company['company_name'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= $data_company['company_icon'] ?>">

    <!-- Bootstrap Css -->
    <link href="<?= base_url('assets/veltrix/') ?>css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url('assets/veltrix/') ?>css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url('assets/veltrix/') ?>css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body class="account-pages">

    <!-- Begin page -->
    <div class="accountbg" style="background: url('<?= base_url('assets/veltrix/') ?>images/bg.jpg');background-size: cover;background-position: center;"></div>

    <div class="wrapper-page account-page-full">

        <div class="card shadow-none">
            <div class="card-block">

                <div class="account-box">

                    <div class="card-box shadow-none p-4">
                        <div class="p-2">
                            <div class="text-center mt-4">
                                <a href="index.html"><img src="<?= $data_company['company_logo'] ?>" height="35" alt="logo"></a>
                            </div>

                            <h4 class="font-size-18 mt-5 text-center"><?= $data_company['company_name'] ?></h4>
                            <p class="text-muted text-center"><?= $data_company['company_slogan'] ?></p>

                            <form class="form" action="<?= base_url('login'); ?>" method="post">

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="userpassword">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 text-left">
                                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                                    </div>
                                </div>
                            </form>
                            <div class="mt-5 pt-4 text-center">
                                <p>© <?= date('Y') ?> <i class="mdi mdi-heart text-danger"></i> <?= $data_company['company_name'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- JAVASCRIPT -->
    <script src="<?= base_url('assets/veltrix/') ?>libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/veltrix/') ?>libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/veltrix/') ?>libs/metismenu/metisMenu.min.js"></script>
    <script src="<?= base_url('assets/veltrix/') ?>libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url('assets/veltrix/') ?>libs/node-waves/waves.min.js"></script>

    <script src="<?= base_url('assets/veltrix/') ?>js/app.js"></script>

</body>

</html>