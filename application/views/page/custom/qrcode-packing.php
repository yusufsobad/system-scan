
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

        	if(strlen($name)>25){
        		$name = substr($name, 0,22);
        		$name .= '...';
        	}

        	$dt_qr[] = array(
        		'name'		=> $name,
        		'code'		=> $vl['sn'],
        		'year'		=> '20' . substr($vl['no_sn'], 0,2)
        	);
        }

        $brs = -1;$col = 2;
        $data_qr = array();
        foreach ($dt_qr as $key => $val) {
        	$col += 1;
        	if($col % 3 == 0){
        		$col = 0;$brs += 1;
        		$data_qr[$brs] = array();
        	}

        	$data_qr[$brs][] = $val;
        }
	}

foreach ($data_qr as $key => $val) {
	foreach ($val as $ky => $vl) {
		$top = 49 + ($ky * 136);
		?>
			<div style="width: 100%;height: 33mm;position: relative;font-family: 'inter-regular';">
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
			
			<?php if($ky < 2) : ?>
				<div style="height: 3mm;font-size:6px;">&nbsp;</div>
			<?php endif; ?>

			<div style="position: absolute;top:<?= $top ;?>;right:15;width:12mm;height:2.5mm;rotate:-90;text-align: center;font-size: 7px;border: 1px solid #000;">
				MFY : <?= $vl['year'] ;?>
			</div>
		<?php
	}
}