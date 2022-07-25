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
            'title' => 'Scan Admin',
            'icon' => 'fas fa-desktop',
            'link' => 'Scan_admin', //Jika tidak menggunakan submenu Isi dengan Link , Jika memakai submenu isi dengan #
            'sub_menu' => '', // Jika tidak ada sub menu dikosongkan saja  , Jika pakai submenu isi dengan function 
            'id_collapse' => '',
            'condition' =>  $uri_segments[2] == "Scan_admin"  ? 'true' : 'false'
        ),
    );


    $data_session = data_session();
    if ($data_session['ID'] == 15) {
        unset($data[1]);
    } else {
    }
    return $data;
}
