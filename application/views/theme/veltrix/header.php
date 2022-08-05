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

    <link href="<?= base_url('assets/veltrix/') ?>libs/chartist/chartist.min.css" rel="stylesheet">

    <!-- Bootstrap Css -->
    <link href="<?= base_url('assets/veltrix/') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url('assets/veltrix/') ?>css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url('assets/veltrix/') ?>css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- Custom -->
    <link href="<?= base_url('assets/plugin/') ?>multiple-select/css/multiple-select.min.css" rel="stylesheet" type="text/css" />

</head>

<body data-sidebar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">