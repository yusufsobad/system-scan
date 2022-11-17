
<?php
	$dt_qr = array();
	foreach ($data as $key => $val) {
		$where_numb = array(
            'reff' => $val['ID']
        );

        $s_num = $this->M_blueprint->get_where($where_numb, 'serial-number');
        foreach ($s_num as $ky => $vl) {
        	$where_serial = array(
            	'code' => $vl['sku']
        	);

        	$name = $this->M_blueprint->get_where($where_serial, 'code-setting');
        	$name = isset($name[0]) ? $name[0]['name'] : '';

        	$dt_qr[] = array(
        		'name'		=> $name,
        		'code'		=> $vl['sn'],
        		'year'		=> '20' . substr($vl['no_sn'], 0,2)
        	);
        }
	}

foreach ($dt_qr as $ky => $vl) {
	?>
		<div style="width: 25mm;height: 33mm;position: relative;font-family: 'inter-regular'">
			<img src="assets/data/solo-abadi/Logo Metrisis.png" style="text-align: center;">
			<hr style="margin-top: 4px;margin-bottom: 4px;color: #000;">
			<div style="word-wrap: break-word;text-align: left;font-size: 8px;line-height: 1;height:4.6mm;">
				<?= $vl['name'] ;?>
			</div>
			<div style="text-align: left;padding-top: 5px;">
				<barcode disableborder="1" code="<?= $vl['code'] ?>" class="barcode pb-lg pt-sm" type="QR" size="0.5" />
			</div>
			<div style="text-align: left;font-size: 8px;font-weight: Bold;padding-top: 4px;">
				<?= $vl['code'] ;?>
			</div>
		</div>
		<div style="position: absolute;bottom:28;right:15;width:12.5mm;height:2.5mm;rotate:-90;text-align: center;font-size: 7px;background: #000;color:#fff;">
			MFY : <?= $vl['year'] ;?>
		</div>    								
	<?php
}