<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Title of the document</title>
</head>

<body>
<h3>Form Data Masyarakat Kosong</h3>
<div class="control-group">
                	<label for="textfield" class="control-label">Nama Lengkap</label>
                		<div class="controls">
                			<input type="text" name="nama" id="nama" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->nama_lengkap)?$field->nama_lengkap:'';?>">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Nama panggilan</label>
                		<div class="controls">
                			<input type="text" name="nama_pgl" id="nama_pgl" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->nama_panggilan)?$field->nama_panggilan:'';?>">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Jenis Kelamin</label>
                    <div class="controls">
                    <input type="text" name="keluarga" id="keluarga" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->anggota_kel)?$field->anggota_kel:'';?>">
                </div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Alamat</label>
                		<div class="controls">
                			<input type="text" name="alamat" id="alamat" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->alamat)?$field->alamat:'';?>">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">No KTP</label>
                		<div class="controls">
                			<input type="text" name="ktp" id="ktp" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->ktp)?$field->ktp:'';?>">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">No HP</label>
                		<div class="controls">
                			<input type="text" name="hp" id="hp" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->hp)?$field->hp:'';?>">
						</div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Kabupaten/Kota</label>
                    <div class="controls">
                    <input type="text" name="keluarga" id="keluarga" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->anggota_kel)?$field->anggota_kel:'';?>">
                </div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Kecamatan</label>
                    <div class="controls">
                    <input type="text" name="keluarga" id="keluarga" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->anggota_kel)?$field->anggota_kel:'';?>">
                </div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Kelurahan</label>
                    <div class="controls">
                    <input type="text" name="keluarga" id="keluarga" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->anggota_kel)?$field->anggota_kel:'';?>">
                </div>
				</div>
				
				<div class="control-group">
                	<label for="textfield" class="control-label">Pekerjaan</label>
                    <div class="controls">
                    <input type="text" name="keluarga" id="keluarga" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->anggota_kel)?$field->anggota_kel:'';?>">
                </div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Penghasilan</label>
                    <div class="controls">
                    <input type="text" name="keluarga" id="keluarga" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->anggota_kel)?$field->anggota_kel:'';?>">
                </div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Umur</label>
                    <div class="controls">
                    <input type="text" name="keluarga" id="keluarga" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->anggota_kel)?$field->anggota_kel:'';?>">
                </div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Pendidikan Terakhir</label>
                        <div class="controls">
                        <input type="text" name="keluarga" id="keluarga" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->anggota_kel)?$field->anggota_kel:'';?>">
                    </div>
				</div>

				<div class="control-group">
                	<label for="textfield" class="control-label">Jumlah Anggota Keluarga</label>
                		<div class="controls">
                			<input type="text" name="keluarga" id="keluarga" class="input-xxlarge" data-rule-required="true" value="<?php echo isset($field->anggota_kel)?$field->anggota_kel:'';?>">
						</div>
				</div>
</body>

</html>