<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_ppic extends CI_Controller
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
                'ID'        =>  '',
                'qrcode'    =>  '',
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
        $data['title'] = 'Data Scaner';
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
                'action'    => 'Admin',
                // Optional Button
                'button' => array(
                    'button_link'      => 'Admin_ppic/export',
                    'button_title'    => 'Export Excel',
                    'button_color'     => 'success'
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
        $data_search = $this->M_blueprint->get_keyword_admin($keyword, $perpage, $start, 'scan-admin')->result_array();
        $data_args = $this->M_blueprint->data_table($perpage, $start, 'scan-admin')->result_array();
        $config_pagination = $this->config_pagination();
        $config = pagination($config_pagination);
        $this->pagination->initialize($config);


        $no = 0;
        $data['t_head'] = array(
            array(
                'NO',
                'Qrcode',
                'Action',
            )
        );
        if ($data_search == '') {
            $data_table = $data_args;
        } elseif ($data_search !== '') {
            $data_table = $data_search;
        }
        if (isset($data)) {
            foreach ($data_table as $index => $key) {
                // Config button Hapus
                $config_button_hapus = array(
                    array(
                        'button' => array(
                            'button_link'      => 'Admin_ppic/delete_data/' . $key['ID'],
                            'button_title'    => 'Hapus',
                            'button_color'     => 'danger'
                        ),
                    )
                );
                $button_hapus = button_delete($config_button_hapus);
                $data['t_body'][$index] = array(
                    ++$start,
                    $key['qrcode'],
                    $button_hapus,
                );
            }
        }

        return $data;
    }

    public function config_pagination()
    {
        $total_row = $this->M_blueprint->count_data('scan-admin');
        $data = array(
            array(
                'base_url'   => base_url('Admin_ppic/index'),
                'total_rows' => $total_row,
                'per_page'  => 5,
            ),
        );
        return $data;
    }

    public function delete_data($id)
    {
        $where = array('ID' => $id);
        $this->M_blueprint->delete_data($where, 'scan-admin');
        $config_alert_danger = array(
            array(
                'title'     => 'Data Berhasil di Hapus ',
                'alert_type' => 'alert-success'
            ),
        );
        $allert_danger = allert($config_alert_danger);
        redirect('Product/index');
    }

    public function export()
    {
        // Load plugin PHPExcel nya
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('My Notes Code')
            ->setLastModifiedBy('My Notes Code')
            ->setTitle("Data Scan Package")
            ->setSubject("Scan")
            ->setDescription("Laporan Scan Package")
            ->setKeywords("Data Scan");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA SCAN PACKAGE"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "QrCode"); // Set kolom B3 dengan tulisan "NIS"

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $all_data = $this->M_blueprint->get_all('scan-admin');
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($all_data as $data) { // Lakukan looping pada variabel siswa
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->qrcode);


            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);


            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(10); // Set width kolom B

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Laporan Data Scan Package");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Scan Package.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
}
