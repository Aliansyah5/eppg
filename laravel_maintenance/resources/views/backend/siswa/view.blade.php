<?php
	if (!empty($data)):
		$data = $data[0];
?>
	<div class="x_panel">
		<div class="x_title">
            <h2>Data Murid</h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
        </div>
		<div class="x_content">
			<div class="form-group col-xs-12">
				<label class="control-label">ID :</label>
				<span class="form-control"><?=$data->id;?></span>
            </div>
			<div class="form-group col-xs-12">
				<label class="control-label">Nama :</label>
				<span class="form-control"><?=$data->nama;?></span>
            </div>
			<div class="form-group col-xs-12">
				<label class="control-label">Tgl Lahir :</label>
				<span class="form-control"><?=date('d-m-Y', strtotime($data->tgl_lahir));?></span>
			</div>
			<div class="form-group col-xs-12">
				<label class="control-label">Jenis Kelamin :</label>
				<span class="form-control"><?=$data->jk == 'L' ? 'Cowok' : 'Cewek'?></span>
			</div>
			<div class="form-group col-xs-12">
				<label class="control-label">Kelas :</label>
				<span class="form-control"><?=$data->kelas;?></span>
			</div>
			<div class="form-group col-xs-12">
				<label class="control-label">Status Perkawinan :</label>
				<span class="form-control"><?=$data->status_nikah == 0 ? 'Belum Menikah' : 'Sudah Menikah'?></span>
			</div>
			<div class="form-group col-xs-12">
				<label class="control-label">Alamat :</label>
				<span class="form-control"><?=$data->alamat;?></span>
			</div>
			<div class="form-group col-xs-12">
				<label class="control-label">Email :</label>
				<span class="form-control"><?=$data->email;?></span>
			</div>
			<div class="form-group col-xs-12">
				<label class="control-label">No HP :</label>
				<span class="form-control"><?=$data->telp_murid;?></span>
			</div>
			<div class="form-group col-xs-12">
				<label class="control-label">Kelompok :</label>
				<span class="form-control"><?=$data->kelompok;?></span>
			</div>
			<div class="x_title">
				<h2>Data Dapukan & Pendidikan</h2>
				<ul class="nav navbar-right panel_toolbox">
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="form-group col-xs-12">
				<label class="control-label">Pendidikan</label>
				<span class="form-control"><?=$pendidikan;?></span>
			</div>
			<div class="form-group col-xs-12">
				<label class="control-label">Nama Sekolah :</label>
				<span class="form-control"><?=$data->sekolah;?></span>
			</div>
			<div class="form-group col-xs-12">
				<label class="control-label">Jurusan :</label>
				<span class="form-control"><?=$data->jurusan;?></span>
			</div>
			<div class="form-group col-xs-12">
				<label class="control-label">Dapukan :</label>
				<span class="form-control"><?=$data->dapukan;?></span>
			</div>
			<div class="x_title">
				<h2>Data Wali Murid</h2>
				<ul class="nav navbar-right panel_toolbox">
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="form-group col-xs-12">
				<label class="control-label">Nama Wali :</label>
				<span class="form-control"><?=$data->walimurid;?></span>
			</div>
			<div class="form-group col-xs-12">
				<label class="control-label">No HP :</label>
				<span class="form-control"><?=$data->telp_wali;?></span>
			</div>
			<div class="form-group col-xs-12">
				<label class="control-label">Alamat :</label>
				<span class="form-control"><?=$data->alamat_wali;?></span>
			</div>
			<div class="form-group col-xs-12">
				<label class="control-label">Email</label>
				<span class="form-control"><?=$data->email_wali;?></span>
			</div>
			<div class="form-group col-xs-12">
				<label class="control-label">Last Modified :</label>
				<span class="form-control"><?=date('d M Y H:i:s', strtotime($data->updated_at));?></span>
			</div>
			<div class="form-group col-xs-12">
				<label class="control-label">Last Modified by :</label>
				<span class="form-control"><?=$data->user_modified;?></span>
			</div>
		</div>
	</div>
<?php
	endif;
?>

