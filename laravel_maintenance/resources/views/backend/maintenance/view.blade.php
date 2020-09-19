<?php

	if (!empty($data)):
        $data = $data[0];

?>

	<div class="x_panel">
		<div class="x_content">
            <h2>Data Maintenance</h2>
            <div class="form-group col-xs-12">
				<label class="control-label">Kode Maintenance :</label>
				<span class="form-control"><?=$data->kode;?></span>
            </div>
            <div class="form-group col-xs-12">
                <label class="control-label">Kategori Maintenance :</label>
				<span class="form-control"><?=$kategori[0]->category;?></span>
            </div>
            <div class="form-group col-xs-12">
				<label class="control-label">Terakhir Maintenance :</label>
				<span class="form-control"><?=date('d-M-y', strtotime($asset[0]->LastMaintDate));?></span>
            </div>
            <div class="form-group col-xs-12">
				<label class="control-label">Hour Meter :</label>
				<span class="form-control"><?=$asset[0]->MaintHour.' (Jam)';?></span>
            </div>
            <div class="form-group col-xs-12">
				<label class="control-label">Keterangan :</label>
				<span class="form-control"><?=$data->keterangan;?></span>
            </div>

			<div class="form-group col-xs-12">
				<label class="control-label">PIC</label>
				<span class="form-control"><?=$data->pic;?></span>
            </div>
            <h2>Data Asset</h2>
			<div class="form-group col-xs-12">
				<label class="control-label">Kode Asset :</label>
				<span class="form-control"><?=$asset[0]->Kode;?></span>
            </div>
			<div class="form-group col-xs-12">
				<label class="control-label">Asset :</label>
				<span class="form-control"><?=$asset[0]->Nama;?></span>
            </div>
            <div class="form-group col-xs-12">
				<label class="control-label">Tipe :</label>
				<span class="form-control"><?=$asset[0]->Tipe;?></span>
            </div>
            <div class="form-group col-xs-12">
				<label class="control-label">Jenis :</label>
				<span class="form-control"><?=$asset[0]->Jenis;?></span>
            </div>
            <div class="form-group col-xs-12">
				<label class="control-label">Department :</label>
				<span class="form-control"><?=$asset[0]->Department;?></span>
            </div>
            <div class="form-group col-xs-12">
				<label class="control-label">Lokasi :</label>
				<span class="form-control"><?=$asset[0]->Lokasi;?></span>
            </div>

		</div>
	</div>
<?php
	endif;
?>

