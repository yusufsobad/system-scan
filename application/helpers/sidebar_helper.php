<?php
function config_sidebar()
{
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    $data = array(
        array(
            'title-group' => 'Menu Pengiriman',
            'title' => 'Data Pengiriman',
            'icon' => 'fas fa-truck',
            'link' => '#', //Jika tidak menggunakan submenu Isi dengan Link , Jika memakai submenu isi dengan #
            'sub_menu' => menu_pengiriman(), // Jika tidak ada sub menu dikosongkan saja  , Jika pakai submenu isi dengan function 
            'id_collapse' => '',
            'condition' =>  $uri_segments[2] == "Data_pengiriman"  ||  $uri_segments[2] == "Scan_pengiriman"   ? 'true' : 'false'
        ),
        array(
            'title-group' => 'Menu Packing',
            'title' => 'Packing',
            'icon' => 'fas fa-box-open',
            'link' => 'Scan_packing', //Jika tidak menggunakan submenu Isi dengan Link , Jika memakai submenu isi dengan #
            'sub_menu' => menu_packing(), // Jika tidak ada sub menu dikosongkan saja  , Jika pakai submenu isi dengan function 
            'id_collapse' => '',
            'condition' => $uri_segments[2] == "Pland_delivery"  ||  $uri_segments[2] == "Scan_packing"  ||  $uri_segments[2] == "Data_packing"  ? 'true' : 'false'
        ),
    );

    $data_session = data_session();
    if ($data_session['ID'] == 15) {
        unset($data[1]);
        unset($data[2]);
        unset($data[3]);
    } else if ($data_session['ID'] == 10) {
        unset($data[4]);
    }
    return $data;
}

function menu_pengiriman()
{
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    $data = array(
        array(
            'title-group' => '',
            'title' => 'Data Pengiriman',
            'icon' => 'fas fa-qrcode',
            'link' => 'Data_pengiriman', //Jika tidak menggunakan submenu Isi dengan Link , Jika memakai submenu isi dengan #
            'sub_menu' => '', // Jika tidak ada sub menu dikosongkan saja  , Jika pakai submenu isi dengan function 
            'id_collapse' => '',
            'condition' =>  $uri_segments[2] == "Data_pengiriman"  ? 'true' : 'false'
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
        array(
            'title-group' => '',
            'title' => 'Scan Pengiriman Group',
            'icon' => 'fas fa-qrcode',
            'link' => 'Scan_pengiriman_group', //Jika tidak menggunakan submenu Isi dengan Link , Jika memakai submenu isi dengan #
            'sub_menu' => '', // Jika tidak ada sub menu dikosongkan saja  , Jika pakai submenu isi dengan function 
            'id_collapse' => '',
            'condition' =>  $uri_segments[2] == "Scan_pengiriman_group"  ? 'true' : 'false'
        ),
    );
    return $data;
}

function menu_packing()
{
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    $data = array(
        array(
            'title-group' => '',
            'title' => 'History Packing',
            'icon' => 'fas fa-qrcode',
            'link' => 'History_packing', //Jika tidak menggunakan submenu Isi dengan Link , Jika memakai submenu isi dengan #
            'sub_menu' => '', // Jika tidak ada sub menu dikosongkan saja  , Jika pakai submenu isi dengan function 
            'id_collapse' => '',
            'condition' =>  $uri_segments[2] == "History_packing"  ? 'true' : 'false'
        ),
        array(
            'title-group' => '',
            'title' => 'Data Packing',
            'icon' => 'fas fa-qrcode',
            'link' => 'Data_packing', //Jika tidak menggunakan submenu Isi dengan Link , Jika memakai submenu isi dengan #
            'sub_menu' => '', // Jika tidak ada sub menu dikosongkan saja  , Jika pakai submenu isi dengan function 
            'id_collapse' => '',
            'condition' =>  $uri_segments[2] == "Data_packing"  ? 'true' : 'false'
        ),
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
