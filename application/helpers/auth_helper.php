<?php
function is_logged_in()
{
    $ci = get_instance();
    $session = $ci->session->userdata();
    var_dump($session);
    die();
    if (!$session['data_session']) {
        redirect('Login');
    }
}

function acces_page($data)
{
    $data_session = data_session();
    if (in_array($data_session['ID'], $data['key_id'])) {
    } else {
        redirect('Login');
    }
}


function data_session()
{
    $ci = get_instance();
    $data = $ci->session->userdata();

    return $data['data_session'];
}
