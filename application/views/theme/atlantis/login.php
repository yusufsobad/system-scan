<!doctype html>
<html lang="en">
<?php $data_company = profile_company(); ?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title><?= $data_company['company_name'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?= $data_company['company_icon'] ?>" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url("assets/login/"); ?>fonts/icomoon/style.css">

    <link rel="stylesheet" href="<?= base_url("assets/login/"); ?>css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url("assets/login/"); ?>css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="<?= base_url("assets/login/"); ?>css/style.css">

    <title>Login #7</title>
</head>

<body>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="<?= base_url("assets/login/"); ?>images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-lg-5">
                                <img style="width:180px;" src="<?= $data_company['company_logo'] ?>">
                            </div>
                            <div class="mb-4">
                                <h4>Log In</h4>
                                <p class="mb-4"><?= $data_company['company_slogan'] ?></p>
                            </div>
                            <form class="form" action="<?= base_url('login'); ?>" method="post">
                                <div class="form-group first">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username">
                                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <input type="submit" value="Log In" class="btn btn-block btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="<?= base_url("assets/login/"); ?>js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url("assets/login/"); ?>js/popper.min.js"></script>
    <script src="<?= base_url("assets/login/"); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url("assets/login/"); ?>js/main.js"></script>
</body>

</html>