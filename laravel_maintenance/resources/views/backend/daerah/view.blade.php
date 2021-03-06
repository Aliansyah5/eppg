<?php
	if (!empty($data)):
		$data = $data[0];
?>
<div class="x_panel">
    <div class="x_content">
        <div class="form-group col-xs-12">
            <label class="control-label">ID :</label>
            <span class="form-control"><?=$data->id;?></span>
        </div>
        <div class="form-group col-xs-12">
            <label class="control-label">Nama Daerah :</label>
            <span class="form-control"><?=$data->nama_daerah;?></span>
        </div>
        <div class="form-group col-xs-12">
            <label class="control-label">Level :</label>
            <span class="form-control"><?=$data->active;?></span>
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
