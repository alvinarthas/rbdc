<div class="box box-color box-bordered">
    <div class="box-title">
        <h3><i class=" icon-plus-sign"></i>Grafik Suara Masuk per <?=strtoupper($daerah)?></h3>
    </div>
    <div class="box-content">
        <div id="chartdiv" style="width: 100%; height: 500px;"></div>
    </div>
</div>
<div class="box box-color box-bordered">
    <div class="box-title">
        <h3><i class=" icon-plus-sign"></i>Tabel Suara Masuk per <?=strtoupper($daerah)?></h3>
    </div>
    <div class="box-content">
		<div class="table-responsive">				
		<table id="myTable" width="100%" class="table table-hover" border="2">
			<thead>
				<tr>																		
					<th rowspan="2">No</th>
					<?php if($daerah == "kabupaten"){?>
						<th rowspan="2">Kecamatan</th>
					<?php }elseif($daerah == "kecamatan"){ ?>
						<th rowspan="2">Kelurahan</th>
					<?php }elseif($daerah == "kelurahan"){ ?>
						<th rowspan="2">No TPS</th>
					<?php } ?>
					<th rowspan="2">DPT</th>
					<th colspan="8"><center>Paslon</center></th>
					<th colspan="3"><center>Suara</center></th>
					<?php if($daerah != "kelurahan"){?>
						<th colspan="3"><center>TPS</center></th>
					<?php } ?>
					<th rowspan="2">Partisipasi</th>
				</tr>
				<tr>
					<th style="background-color:#bfbfbf" colspan="2">Syamsuar - Edy Nasution</th>
					<th style="background-color:#00cc00" colspan="2">Lukman Edy - Hardianto</th>
					<th style="background-color:#0099ff" colspan="2">Firdaus - Rusli Effendi</th>
					<th style="background-color:#ffff1a" colspan="2">Andi Rachman - Suyatno</th>
					<th>Sah</th>
					<th>Tidak Sah</th>
					<th>Total</th>
					<?php if($daerah != "kelurahan"){?>
						<th>Jumlah</th>
						<th>Masuk</th>
						<th>Kurang</th>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
			<?php
			$i=1; 
			foreach($tabel as $key) { ?>
				<tr>
					<td><?=$i?></td>
					<td><?=$key['nama_tps']?></td>
					<td><?=$key['dpt']?></td>
					<td><?=$key['calon1']?></td>
					<td><?=number_format($key['persen1'], 2, '.', '');?> %</td>
					<td><?=$key['calon2']?></td>
					<td><?=number_format($key['persen2'], 2, '.', '');?> %</td>
					<td><?=$key['calon3']?></td>
					<td><?=number_format($key['persen3'], 2, '.', '');?> %</td>
					<td><?=$key['calon4']?></td>
					<td><?=number_format($key['persen4'], 2, '.', '');?> %</td>
					<td><?=$key['sah']?></td>
					<td><?=$key['tdk']?></td>
					<td><?=$key['total']?></td>
					<?php if($daerah != "kelurahan"){?>
						<td><?=$key['jumlah']?></td>
						<td><?=$key['masuk']?></td>
						<td><?=$key['keluar']?></td>
					<?php } ?>
					<td><?=number_format($key['partisipasi'], 2, '.', '');?> %</td>
				</tr>
			<?php $i++;
			}?>
			</tbody>
		</table>
	</div>
</div>

<!-- Chart code -->
<script>
var chart = AmCharts.makeChart("chartdiv",
{
    "type": "serial",
    "theme": "light",
    "dataProvider": <?=$chart?>,
    "startDuration": 1,
    "fillAlphas": 1,
    "graphs": [{
        "balloonText": "<span style='font-size:13px;'>[[category]]: <b>[[value]]</b> ([[persen]]%)</span>",
        "bulletOffset": 10,
        "bulletSize": 70,
        "colorField": "color",
        "cornerRadiusTop": 8,
        "customBulletField": "bullet",
        "fillAlphas": 0.8,
        "lineAlpha": 0,
        "type": "column",
        "valueField": "points",
    }],
    "marginTop": 0,
    "marginRight": 0,
    "marginLeft": 0,
    "marginBottom": 0,
    "autoMargins": false,
    "categoryField": "name",
    "categoryAxis": {
        "axisAlpha": 0,
        "gridAlpha": 0,
        "inside": true,
        "boldLabels":true,
        "tickLength": 0
    },
    "export": {
    	"enabled": true
     }
});
</script>