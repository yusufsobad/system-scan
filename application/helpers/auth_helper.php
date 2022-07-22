<?php
function is_logged_in()
{
    $ci = get_instance();
    $session = $ci->session->userdata();
    if (!$session['data_session']) {
        redirect('Login');
    }
}

function data_session()
{
    $ci = get_instance();
    $data = $ci->session->userdata();

    return $data['data_session'];
}
