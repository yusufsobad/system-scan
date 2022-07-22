<?php

function config_sidebar()
{
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    $data = array(
        array(
            'title-group' => '',
            'title' => 'Admin',
            'icon' => 'fas fa-desktop',
            'link' => 'Admin', //Jika tidak menggunakan submenu Isi dengan Link , Jika memakai submenu isi dengan #
            'sub_menu' => '', // Jika tidak ada sub menu dikosongkan saja  , Jika pakai submenu isi dengan function 
            'id_collapse' => '',
            'condition' =>  $uri_segments[2] == "Admin"  ? 'true' : 'false'
        ),
        array(
            'title-group' => '',
            'title' => 'Scan',
            'icon' => 'fas fa-desktop',
            'link' => 'Scan', //Jika tidak menggunakan submenu Isi dengan Link , Jika memakai submenu isi dengan #
            'sub_menu' => '', // Jika tidak ada sub menu dikosongkan saja  , Jika pakai submenu isi dengan function 
            'id_collapse' => '',
            'condition' =>  $uri_segments[2] == "Sobad_scan"  ? 'true' : 'false'
        ),
    );
    return $data;
}
