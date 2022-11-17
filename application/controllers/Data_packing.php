<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_packing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Helper
        $acces_page = $this->acces_this_page();
        acces_page($acces_page);
        is_logged_in();
        $this->load->model('M_blueprint');
        $this->load->library('form_validation');
    }

    public function acces_this_page()
    {
        $data = array(
            'key_id'   => array(
                '10',
            ),
        );
        return $data;
    }

    public function default_data()
    {
        $data = array(
            array(
                'ID'       =>  '',
                'note'    =>  '',
            ),
        );
        return $data;
    }

    public function index()
    {
        $data_session = data_session();
        $config_search = $this->config_search();
        $config_card = $this->config_card();
        $config_table = $this->config_table();
        $table = data_table($config_table);
        $search = search($config_search);
        $pagination =  $this->pagination->create_links();
        $content = array(
            $search,
            $table,
            $pagination
        );
        $data['title'] = 'Data Packing';
        // Get Sidebar
        $data['sidebar'] = config_sidebar();

        // All Config
        $data['card'] = card($config_card, $content);

        $this->load->view('theme/veltrix/header');
        $this->load->view('theme/veltrix/topbar');
        $this->load->view('theme/veltrix/sidebar', $data);
        $this->load->view('theme/veltrix/content');
        $this->load->view('theme/veltrix/footer');
    }

    public function config_card()
    {
        $data = array(
            array(
                'title'    => 'Data Scaner',
                'action'    => 'Data_packing',
                // Optional Button
                'button' => array(
                    'button_link'      => 'Data_packing/print',
                    'button_title'    => 'Export PDF',
                    'button_color'     => 'danger'
                ),
                'button_secondary' => array(
                    'button_link'      => 'Pland_delivery/index',
                    'button_title'    => 'Tambah Data',
                    'button_color'     => 'primary'
                ),
            )
        );
        return $data;
    }

    public function config_search()
    {
        $data = array(
            array(
                'id'    => 'search',
                'name'  => 'search'
            ),
        );
        return $data;
    }

    public function config_table()
    {
        $data_session = data_session();
        $this->load->library('pagination');
        $start = $this->uri->segment(3);
        $perpage  = 5;
        $keyword = $this->input->post('search');
        $data_keyword = array(
            'note'   => $keyword
        );
        $data_search = $this->M_blueprint->keyword($data_keyword, $perpage, $start, 'note_deliv')->result_array();
        $data_args = $this->M_blueprint->data_table($perpage, $start, 'note_deliv')->result_array();
        $config_pagination = $this->config_pagination();
        $config = pagination($config_pagination);
        $this->pagination->initialize($config);

        $data['t_head'] = array(
            array(
                'NO',
                'Catatan',
                'Detail Packing',
                'Print',
                'Edit',
                'Hapus',
            )
        );
        if ($data_search == '') {
            $data_table = $data_args;
        } elseif ($data_search !== '') {
            $data_table = $data_search;
        }
        if (isset($data_table)) {
            foreach ($data_table as $index => $key) {
                // Config button Hapus
                $config_button_edit = array(
                    array(
                        'button' => array(
                            'button_link'     => 'Pland_delivery/index/' . $key['ID'],
                            'button_title'    => 'Edit',
                            'button_color'    => 'warning',
                        ),
                    )
                );
                $config_button_delete = array(
                    array(
                        'button' => array(
                            'button_link'     => 'Data_packing/delete_data/' . $key['ID'],
                            'button_title'    => 'Hapus',
                            'button_color'    => 'danger',
                        ),
                    )
                );
                $config_button_print = array(
                    array(
                        'button' => array(
                            'button_link'     => 'Data_packing/print_qrcode/' . $key['ID'],
                            'button_title'    => 'QRcode',
                            'button_color'    => 'primary',
                        ),
                    )
                );
                $config_button_detail = array(
                    array(
                        'id'   => 'detail_pack' . $key['ID'],
                        'button' => array(
                            'button_link'   => '',
                            'button_title'  => 'Detail',
                            'button_color'  => 'primary',
                        ),
                        'modal' => array(
                            'modal_title'   => 'Data Packing',
                            'content'       => $this->table_detail($key['ID']),
                        ),
                    )
                );
                $button_edit = button_edit($config_button_edit);
                $button_delete = button_delete($config_button_delete);
                $button_print = button_print($config_button_print);
                $button_detail = modal($config_button_detail);
                $data['t_body'][$index] = array(
                    ++$start,
                    $key['note'],
                    $button_detail,
                    $button_print,
                    $button_edit,
                    $button_delete,
                );
            }
        }
        return $data;
    }

    public function config_pagination()
    {
        $total_row = $this->M_blueprint->count_data('note_deliv');
        $data = array(
            array(
                'base_url'   => base_url('Data_packing/index'),
                'total_rows' => $total_row,
                'per_page'  => 5,
            ),
        );
        return $data;
    }

    public function table_detail($id)
    {

        $no = 0;
        $where = array(
            'reff_note'  => @$id
        );
        $data_table = $this->M_blueprint->get_where($where, 'packing');

        // var_dump($data_table);


        $data['t_head'] = array(
            array(
                'NO',
                'Nomor Packing',
                'Detail SN',
                'Hapus',
            )
        );

        foreach ($data_table as $key => $val) {
            $config_button_delete = array(
                array(
                    'button' => array(
                        'button_link'     => 'Data_packing/delete_data_packing/' . $val['ID'],
                        'button_title'    => 'Hapus',
                        'button_color'    => 'danger',
                    ),
                )
            );
            $button_delete = button_delete($config_button_delete);
            $config_button_detail = array(
                array(
                    'id'   => 'detail_sn' . $val['ID'],
                    'button' => array(
                        'button_link'   => '',
                        'button_title'  => 'Detail',
                        'button_color'  => 'primary',
                    ),
                    'modal' => array(
                        'modal_title'   => 'Data Serial Number',
                        'content'       => $this->table_sn($val['ID']),
                    ),
                )
            );
            $button_detail = modal($config_button_detail);
            $data['t_body'][$key] = array(
                ++$no,
                $val['no_pack'],
                $button_detail,
                $button_delete,
            );
        }

        return data_table($data);
    }

    public function table_sn($id)
    {
        $no = 0;
        $where = array(
            'reff'  => @$id
        );
        $data_table = $this->M_blueprint->get_where($where, 'serial-number');

        // var_dump($data_table);


        $data['t_head'] = array(
            array(
                'NO',
                'Nomor Serial Number',
                'Hapus'
            )
        );

        foreach ($data_table as $key => $val) {
            $config_button_delete = array(
                array(
                    'button' => array(
                        'button_link'     => 'Data_packing/delete_data_sn/' . $val['ID'],
                        'button_title'    => 'Hapus',
                        'button_color'    => 'danger',
                    ),
                )
            );
            $button_delete = button_delete($config_button_delete);
            $data['t_body'][$key] = array(
                ++$no,
                $val['sn'],
                $button_delete
            );
        }

        return data_table($data);
    }

    public function form($id = '')
    {
        $data_session = data_session();
        $config_card = $this->card_form($id);
        $form = $this->form_input($id);


        $content = array(
            $form,

        );
        $data['title'] = 'Data Packing';
        // Get Sidebar
        $data['sidebar'] = config_sidebar();

        // All Config
        $data['card'] = card($config_card, $content);

        $this->load->view('theme/veltrix/header');
        $this->load->view('theme/veltrix/topbar');
        $this->load->view('theme/veltrix/sidebar', $data);
        $this->load->view('theme/veltrix/content');
        $this->load->view('theme/veltrix/footer');
    }

    public function card_form($id)
    {
        $data = array(
            array(
                'title'    => 'Data Scaner',
                'action'    => $id == '' ? 'Data_packing/add_data' : 'Data_packing/update_data',
                'button_save' => array(
                    'button_title'    => 'Save',
                    'button_color'     => 'success',
                    'button_action'      => '#',
                ),
                'button_cancel' => array(
                    'button_title'    => 'Cancel',
                    'button_color'     => 'danger',
                    'button_action'      => 'Data_packing',
                ),
            )
        );
        return $data;
    }

    public function form_input($id)
    {
        $default_data = $this->default_data();
        $where = array(
            'ID' =>  @$id
        );
        $where_pack = array(
            'reff_note' =>  $id
        );

        $where_packing = array(
            'reff_note' => 0
        );
        $get_packing = $this->M_blueprint->get_where($where_packing, 'packing');
        $data_value =  $this->M_blueprint->get_where($where, 'note_deliv');
        $data_pack = $this->M_blueprint->get_where($where_pack, 'packing');

        if (is_array($data_value) && isset($data_value) && empty($data_value)) {
            $query = $default_data;
        } else {
            $query = $data_value;
        }

        foreach ($query as  $key) {
            $data = array(
                array(
                    'column'    => 'col-lg-6',
                    'form' => array(
                        array(
                            'form_title'    => '', // Judul Form
                            'place_holder'  => '', // Isi PlaceHolder
                            'note'          => '', // Note form
                            'type'          => 'hidden',
                            'id'            => 'id',
                            'name'          => 'id',
                            'validation'    =>  'false',
                            'value'         =>  @$key['ID'],
                            'input-type'    => 'form'
                        ),
                        array(
                            'form_title'    => 'Note', // Judul Form
                            'place_holder'  => '', // Isi PlaceHolder
                            'note'          => '', // Note form
                            'type'          => '',
                            'id'            => 'note',
                            'name'          => 'note',
                            'validation'    =>  'false',
                            'value'         =>  @$key['note'],
                            'input-type'    => 'text-area'
                        ),
                        array(
                            'form_title'   => 'Select Packing',
                            'place_holder'  => 'Pilih Data Packing',
                            'note'          => '',
                            'type'          => 'multiple-select',
                            'id'            => 'packing',
                            'name'          => 'packing',
                            'validation'    =>  'false',
                            'value'         =>  $id !== '' ? $data_pack : '',
                            'content_id'    => 'ID',
                            'content'       => 'no_pack',
                            'data'          => $get_packing,
                            'input-type'    => 'multiple-select'
                        ),
                    ),
                ),
            );
        }
        return form($data);
    }

    public function add_data()
    {
        $packing = $this->input->post('packing');
        $note   = $this->input->post('note');

        $data_note = array(
            'note'  => $note
        );
        $id = $this->M_blueprint->insert_lastId($data_note, 'note_deliv');

        $data_pack = array(
            'reff_note' => $id
        );
        foreach ($packing as $val) {
            $where = array(
                'ID'   => $val
            );
            $this->M_blueprint->update_data($where, $data_pack, 'packing');
        }
        redirect('Data_packing/index');
    }

    public function update_data()
    {
        $id = $this->input->post('id');
        $packing = $this->input->post('packing');
        $note   = $this->input->post('note');

        $data_note = array(
            'note'  => $note
        );

        $where_note = array(
            'ID'    => $id
        );

        $this->M_blueprint->update_data($where_note, $data_note, 'note_deliv');

        //  Remove Data Packing Terlebih Dahulu
        $data_pack_remove = array(
            'reff_note' => 0
        );
        $where_del = array(
            'reff_note'   => $id
        );

        foreach ($packing as $val) {
            $this->M_blueprint->update_data($where_del, $data_pack_remove, 'packing');
        }

        // ==============================

        $data_pack = array(
            'reff_note' => $id
        );
        foreach ($packing as $val) {
            $where = array(
                'ID'   => $val
            );
            $this->M_blueprint->update_data($where, $data_pack, 'packing');
        }
        redirect('Data_packing/index');
    }

    public function delete_data($id)
    {
        $where = array('ID' => $id);
        $this->M_blueprint->delete_data($where, 'note_deliv');
        $config_alert_danger = array(
            array(
                'title'     => 'Data Berhasil di Hapus ',
                'alert_type' => 'alert-success'
            ),
        );

        //  Remove Data Packing Terlebih Dahulu
        $data_pack_remove = array(
            'reff_note' => 0
        );
        $where_del = array(
            'reff_note'   => $id
        );

        $this->M_blueprint->update_data($where_del, $data_pack_remove, 'packing');

        $allert_danger = allert($config_alert_danger);

        redirect('Data_packing/index');
    }

    public function delete_data_packing($id)
    {
        //  Remove Data Packing Terlebih Dahulu
        $data_pack_remove = array(
            'reff_note' => 0
        );
        $where_del = array(
            'reff_note'   => $id
        );

        $this->M_blueprint->update_data($where_del, $data_pack_remove, 'packing');

        $config_alert_danger = array(
            array(
                'title'     => 'Data Berhasil di Hapus ',
                'alert_type' => 'alert-success'
            ),
        );
        $allert_danger = allert($config_alert_danger);

        redirect('Data_packing/index');
    }

    public function delete_data_sn($id)
    {
        //  Remove Data Packing Terlebih Dahulu

        $where_del = array(
            'ID'   => $id
        );

        $this->M_blueprint->delete_data($where_del, 'serial-number');

        $config_alert_danger = array(
            array(
                'title'     => 'Data Berhasil di Hapus ',
                'alert_type' => 'alert-success'
            ),
        );
        $allert_danger = allert($config_alert_danger);

        redirect('Data_packing/index');
    }

    public function print()
    {
        $data_pdf = $this->M_blueprint->get_data_table('note_deliv');
        $config_mpdf = array(
            'format'        => 'a4',
            'position'      => 'P',
            'output_name'   => 'Data Packing',
            'margin_left'   => 5,
            'margin_right'  => 5,
            'margin_top'    => 5,
            'margin_bottom' => 5,
            'margin_header' => 10,
            'margin_footer' => 10,
            'background_content' => '',
            'content'     => array(
                array(
                    'location'     => 'page/custom/report-packing',
                    'data'         => $data_pdf
                ),
            ),
        );

        mpdf_setting($config_mpdf);
    }

    public function print_qrcode($id)
    {
        $where = array(
            'reff_note' =>  @$id
        );

        $data_pdf = $this->M_blueprint->get_data($where,'packing');
        $config_mpdf = array(
            'format'        => array(25, 33),
            'position'      => 'P',
            'output_name'   => 'qrcode',
            'margin_left'   => 4,
            'margin_right'  => 4,
            'margin_top'    => 3,
            'margin_bottom' => 2,
            'margin_header' => 10,
            'margin_footer' => 10,
            'background_content' => '',
            'content'     => array(
                array(
                    'location'     => 'page/custom/qrcode-packing',
                    'data'         => $data_pdf
                ),
            ),
        );

        mpdf_setting($config_mpdf);
    }
}
