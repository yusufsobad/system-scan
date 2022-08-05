<?php
function config_sidebar()
{
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    $data = array(
        array(
            'title-group' => 'Marketing',
            'title' => 'Admin',
            'icon' => 'fas fa-desktop',
            'link' => '#', //Jika tidak menggunakan submenu Isi dengan Link , Jika memakai submenu isi dengan #
            'sub_menu' => menu_marketing(), // Jika tidak ada sub menu dikosongkan saja  , Jika pakai submenu isi dengan function 
            'id_collapse' => '',
            'condition' =>  $uri_segments[2] == "Admin"  ? 'true' : 'false'
        ),
        array(
            'title-group' => '',
            'title' => 'Admin Ppic',
            'icon' => 'fas fa-desktop',
            'link' => 'Admin_ppic', //Jika tidak menggunakan submenu Isi dengan Link , Jika memakai submenu isi dengan #
            'sub_menu' => '', // Jika tidak ada sub menu dikosongkan saja  , Jika pakai submenu isi dengan function 
            'id_collapse' => '',
            'condition' =>  $uri_segments[2] == "Admin_ppic"  ? 'true' : 'false'
        ),
        array(
            'title-group' => '',
            'title' => 'Scan Admin',
            'icon' => 'fas fa-qrcode',
            'link' => 'Scan_admin', //Jika tidak menggunakan submenu Isi dengan Link , Jika memakai submenu isi dengan #
            'sub_menu' => '', // Jika tidak ada sub menu dikosongkan saja  , Jika pakai submenu isi dengan function 
            'id_collapse' => '',
            'condition' =>  $uri_segments[2] == "Scan_admin"  ? 'true' : 'false'
        ),
        array(
            'title-group' => 'Menu Packing',
            'title' => 'Packing',
            'icon' => 'fas fa-qrcode',
            'link' => 'Scan_packing', //Jika tidak menggunakan submenu Isi dengan Link , Jika memakai submenu isi dengan #
            'sub_menu' => menu_packing(), // Jika tidak ada sub menu dikosongkan saja  , Jika pakai submenu isi dengan function 
            'id_collapse' => '',
            'condition' => $uri_segments[2] == "Pland_delivery"  ||  $uri_segments[2] == "Scan_packing"  ||  $uri_segments[2] == "Scan_packing"  ? 'true' : 'false'
        ),
    );

    $data_session = data_session();
    if ($data_session['ID'] == 15) {
        unset($data[1]);
        unset($data[2]);
        unset($data[3]);
    } else if ($data_session['ID'] == 10) {
        unset($data[0]);
        unset($data[4]);
    }
    return $data;
}

function menu_packing()
{
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    $data = array(
        // array(
        //     'title-group' => '',
        //     'title' => 'Data Packing',
        //     'icon' => 'fas fa-qrcode',
        //     'link' => 'Data_packing', //Jika tidak menggunakan submenu Isi dengan Link , Jika memakai submenu isi dengan #
        //     'sub_menu' => '', // Jika tidak ada sub menu dikosongkan saja  , Jika pakai submenu isi dengan function 
        //     'id_collapse' => '',
        //     'condition' =>  $uri_segments[2] == "Data_packing"  ? 'true' : 'false'
        // ),
        array(
            'title-group' => '',
            'title' => 'Scan Packing',
            'icon' => 'fas fa-qrcode',
            'link' => 'Scan_packing', //Jika tidak menggunakan submenu Isi dengan Link , Jika memakai submenu isi dengan #
            'sub_menu' => '', // Jika tidak ada sub menu dikosongkan saja  , Jika pakai submenu isi dengan function 
            'id_collapse' => '',
            'condition' =>  $uri_segments[2] == "Scan_packing"  ? 'true' : 'false'
        ),
    );
    return $data;
}

function menu_marketing()
{
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    $data = array(
        array(
            'title-group' => '',
            'title' => 'Scan Pengiriman',
            'icon' => 'fas fa-qrcode',
            'link' => 'Admin', //Jika tidak menggunakan submenu Isi dengan Link , Jika memakai submenu isi dengan #
            'sub_menu' => '', // Jika tidak ada sub menu dikosongkan saja  , Jika pakai submenu isi dengan function 
            'id_collapse' => '',
            'condition' =>  $uri_segments[2] == "Admin"  ? 'true' : 'false'
        ),
        array(
            'title-group' => '',
            'title' => 'Scan Pengiriman',
            'icon' => 'fas fa-qrcode',
            'link' => 'Scan_pengiriman', //Jika tidak menggunakan submenu Isi dengan Link , Jika memakai submenu isi dengan #
            'sub_menu' => '', // Jika tidak ada sub menu dikosongkan saja  , Jika pakai submenu isi dengan function 
            'id_collapse' => '',
            'condition' =>  $uri_segments[2] == "Scan_pengiriman"  ? 'true' : 'false'
        ),
    );
    return $data;
}
