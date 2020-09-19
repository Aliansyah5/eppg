<?php
	if (!empty($data)):
		$data = $data[0];
?>
	<div class="x_panel">
		<div class="x_content">
			<div class="form-group col-xs-12">
				<label class="control-label">Kode :</label>
				<span class="form-control"><?=$data->{"No_"};?></span>
            </div>
			<div class="form-group col-xs-12">
				<label class="control-label">Nama :</label>
				<span class="form-control"><?=$data->{"Description"};?></span>
            </div>
			<div class="form-group col-xs-12">
				<label class="control-label">Lokasi :</label>
				<span class="form-control"><?=$data->{"FA Location Code"};?></span>
            </div>
			<div class="form-group col-xs-12">
				<label class="control-label">Status :</label>
				<span class="form-control">
                    <?=$data->{"Kondisi Aset"};?>
                </span>
			</div>
		</div>
	</div>
<?php
	endif;
?>

