<?php
function dropzone_setting()
{
?>
    <script>
        Dropzone.autoDiscover = false;
        var foto_upload = new Dropzone(".dropzone", {
            url: "<?= base_url('Activity/dropzone_add') ?>", // Set the url for your upload script location
            paramName: "userfile", // The name that will be used to transfer the file
            maxFiles: 4,
            method: "post",
            quality: 0.6,
            acceptedFiles: "image/*",
            maxFilesize: .100,
            maxThumbnailFilesize: .100,
            addRemoveLinks: true,
            dictInvalidFileType: "Type file ini tidak dizinkan",
            init: function() {
                console.log('init');
                this.on("error", function(file, message) {
                    alert("File terlalu besar, Max: 100kb");
                    this.removeFile(file);
                });

            }
        });
        //Event ketika Memulai mengupload
        foto_upload.on("sending", function(a, b, c) {
            a.token = Math.random();
            c.append("token_foto", a.token); //Menmpersiapkan token untuk masing masing foto
        });

        //Event ketika foto dihapus
        function remove_file_list(val) {
            foto_upload.on("removedfile", function(a) {
                var token = a.token;
                $.ajax({
                    type: "post",
                    data: {
                        token: token
                    },
                    url: "<?= base_url('Activity/dropzone_remove') ?>",
                    cache: false,
                    dataType: 'json',
                    success: function() {
                        console.log("File Deleted");
                    },
                    error: function() {
                        console.log("Error");

                    }
                });
            });
        }

        function remove_dz(val, id) {

            var token = val;
            var ID = "#" + id
            console.log(id)
            $.ajax({
                type: "post",
                data: {
                    token: token
                },
                url: "<?= base_url('Activity/dropzone_remove') ?>",
                cache: false,
                dataType: 'json',
                success: function() {
                    console.log("File Deleted");
                },
                error: function() {
                    console.log("Error");

                }
            });
            $(ID).closest("div").remove();

        }
    </script>
<?php
}

function mpdf_setting($data = array())
{
    // ===================Documentation====================
    // ================MPDF Configuration==================
    // ==============Copy paste On Controller==============
    // $data_pdf = array(
    //     'setings' => 'blabla bla'
    // );
    // $config_mpdf = array(
    //     'format'        => 'a4',
    //     'position'      => 'P',
    //     'margin_left'   => 10,
    //     'margin_right'  => 10,
    //     'margin_top'    => 10,
    //     'margin_bottom' => 10,
    //     'margin_header' => 10,
    //     'margin_footer' => 10,
    //     'header'     => array(
    //         'location'     => 'template/template-pdf/test-header',
    //         'data'              => $data_pdf
    //     ),
    //     'content'     => array(
    //         array(
    //             'location'     => 'template/template-pdf/report-pdf',
    //             'data'              => $data_pdf
    //         ),
    //         array(
    //             'location'     => 'template/template-pdf/report-pdftest',
    //             'data'              => $data_pdf
    //         ),
    //     ),
    //     'footer'     => array(
    //         'location'     => 'template/template-pdf/test-footer',
    //         'data'              => $data_pdf
    //     ),
    // );

    // mpdf_setting($config_mpdf);

    // ====================================================
    $ci = get_instance();
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => $data['format'],
        'orientation' => $data['position'],
        'margin_left' => $data['margin_left'],
        'margin_right' => $data['margin_right'],
        'margin_top' => $data['margin_top'],
        'margin_bottom' => $data['margin_bottom'],
        'margin_header' => $data['margin_header'],
        'margin_footer' => $data['margin_footer'],
        'setAutoTopMargin' => '',
        'defaultheaderline' => 0,
        'defaultfooterline' => 0,
    ]);

    if (isset($data['background_content'])) {
        $mpdf->SetDefaultBodyCSS('background', "url('" . $data['background_content'] . "')");
        $mpdf->SetDefaultBodyCSS('background-image-resize', 6);
    } else {
    }
    if (isset($data['header'])) {
        $html_header = $ci->load->view(isset($data['header']['location']) ? $data['header']['location'] : '', ['data' => $data['header']['data']], true);
        $mpdf->SetHTMLHeader($html_header);
    } else {
    }
    if (isset($data['footer'])) {
        $html_footer = $ci->load->view(isset($data['footer']['location']) ? $data['footer']['location'] : '', ['data' => $data['footer']['data']], true);
        $mpdf->SetFooter($html_footer);
    } else {
    }

    foreach ($data['content'] as $val) {
        $data_html = $ci->load->view($val['location'], ['data' => $val['data']], true);
        $mpdf->WriteHTML($data_html);
    }
    if (isset($data['output_name'])) {
        $mpdf->Output($data['output_name'] . '.pdf', "I");
    } else {
        $mpdf->Output('Doc.pdf', "I");
    }
}

function scan()
{
    ob_start(); ?>
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Latest Trasaction</h4>
                    <video autoplay style="width:100%" class="rounded" id="preview"></video>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <div id="title-form" class="text-center pb-4">
                        <h1>Input Data Qrcode</h1>
                    </div>
                    <div class="card rounded shadow p-3 mb-5 bg-white rounded" id="form_scan" style="min-height: 326px;">

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $contents = ob_get_clean();
    return $contents;
}

function instascan()
{
    ob_start(); ?>
    <!-- Instan-Scan -->
    <script script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?= base_url('assets/plugin/') ?>instascan/js/instascan.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", event => {
            let scanner = new Instascan.Scanner({
                video: document.getElementById('preview')
            });
            Instascan.Camera.getCameras().then(cameras => {
                scanner.camera = cameras[cameras.length - 1];
                scanner.start();
            }).catch(e => console.error(e));

            scanner.addListener('scan', content => {
                console.log(content);

                $.ajax({
                    type: "POST",
                    url: "<?= base_url('Scan_admin/check_data') ?>",
                    data: {
                        value: content
                    },
                }).done(function(data) {
                    // you may safely use results here
                    console.log(data);

                    if (data == 'true') {
                        window.alert("Qrcode already found");
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url('Scan_admin/form_ajax') ?>",
                            data: {
                                value: content
                            },
                            success: function(response) {
                                $('#form_scan').html(response);
                                $("#title-form").fadeIn(700);
                                $('#qrcode').val(content);
                                $('html, body').animate({
                                    scrollTop: $("#destinate").offset().top
                                }, 2000);
                            },
                        })
                    } else {
                        window.alert("Success");
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url('Scan_admin/form_ajax') ?>",
                            data: {
                                value: content
                            },
                            success: function(response) {
                                $('#form_scan').html(response);
                                $("#title-form").fadeIn(700);
                                $('#qrcode').val(content);
                                $('html, body').animate({
                                    scrollTop: $("#destinate").offset().top
                                }, 2000);
                            },
                        })
                    }
                });
            });

        });
    </script>
<?php $contents = ob_get_clean();
    return $contents;
}
