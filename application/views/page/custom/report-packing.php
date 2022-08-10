<?php
$no = 0;
?>
<style>
    body {
        font-family: sans-serif;
        font-size: 15px;
    }

    .styled-table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        overflow: wrap;
    }

    .styled-table thead tr {
        background-color: #15499a;
        color: #ffffff;
        text-align: left;
    }

    .styled-table th {
        padding: 12px 15px;
        color: #ffffff;
        border: 1px solid #dddddd;
    }

    .styled-table td {
        padding: 12px 15px;
        border: 1px solid #dddddd;
    }

    .styled-table tbody tr {
        border: 1px solid #dddddd;
    }

    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .styled-table tbody tr:last-of-type {
        border-bottom: 2px solid #009879;
    }

    .styled-table tbody tr.active-row {
        font-weight: bold;
        color: #009879;
    }

    .borderles td {
        padding: 0px 0px;
        border: 0px solid #dddddd;
    }
</style>
<div style="width: 100%;">
    <div style="text-align: center;">
        <h1>Laporan Data Packing</h1>
    </div>
    <div style="width: 100%;">
        <table class="styled-table" style="width: 100%;">
            <thead>
                <tr>
                    <th style="text-align: center;">No</th>
                    <th>Catatan</th>
                    <th>Detail Data</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $value) {
                    $where_pack = array(
                        'reff_note' => $value['ID']
                    );
                    $data_packing = $this->M_blueprint->get_where($where_pack, 'packing');
                ?>
                    <tr>
                        <td style="vertical-align: top;text-align: center;width:10%"><?= ++$no ?></td>
                        <td style="vertical-align: top;width:30%"><?= $value['note'] ?></td>
                        <td style="padding: 0px;width:60%;">
                            <?php if (!empty($data_packing)) { ?>
                                <table style="width: 100%;vertical-align: top;">
                                    <thead>
                                        <tr>
                                            <th>Nomor Packing</th>
                                            <th>Serial Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data_packing as $val) { ?>
                                            <tr>
                                                <td style="width: 30%;"><?= $val['no_pack'] ?></td>
                                                <td style="padding: 0px;width:30%;">
                                                    <table style="width: 100%;">
                                                        <tbody>
                                                            <?php
                                                            $where_numb = array(
                                                                'reff' => $value['ID']
                                                            );
                                                            $data_numb = $this->M_blueprint->get_where($where_numb, 'serial-number');
                                                            foreach ($data_numb as $index) {
                                                            ?>
                                                                <tr>
                                                                    <td style="margin: 0px;border:0px;vertical-align: top;"><?= $index['sn'] ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php } else {
                            } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>