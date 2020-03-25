<div class="box box-color box-bordered">
    <div class="box-title">
        <h3><i class=" icon-plus-sign"></i>Grafik Suara Masuk per Provinsi</h3>
    </div>
    <div class="box-content">
        <div id="piechart" style="width: 100%; height: 500px;"></div>
    </div>
</div>
<div class="box box-color box-bordered">
    <div class="box-title">
        <h3><i class=" icon-plus-sign"></i>Tabel Suara Masuk per Provinsi</h3>
    </div>
    <div class="box-content">
        <table id="myTable" width="100%" class="table table-hover" border="2">
            <thead>
                <tr>																		
                    <th rowspan="2">DPT</th>
                    <th colspan="8"><center>Paslon</center></th>
                    <th colspan="3"><center>Suara</center></th>
                    <th colspan="3"><center>TPS</center></th>
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
                    <th>Jumlah</th>
                    <th>Masuk</th>
                    <th>Kurang</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?=$tabel['dpt']?></td>
                    <td><?=$tabel['calon1']?></td>
                    <td><?=number_format($tabel['persen1'], 2, '.', '');?> %</td>
                    <td><?=$tabel['calon2']?></td>
                    <td><?=number_format($tabel['persen2'], 2, '.', '');?> %</td>
                    <td><?=$tabel['calon3']?></td>
                    <td><?=number_format($tabel['persen3'], 2, '.', '');?> %</td>
                    <td><?=$tabel['calon4']?></td>
                    <td><?=number_format($tabel['persen4'], 2, '.', '');?> %</td>
                    <td><?=$tabel['sah']?></td>
                    <td><?=$tabel['tdk']?></td>
                    <td><?=$tabel['total']?></td>
                    <td><?=$tabel['jumlah']?></td>
                    <td><?=$tabel['masuk']?></td>
                    <td><?=$tabel['keluar']?></td>
                    <td><?=number_format($tabel['partisipasi'], 2, '.', '');?> %</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- Chart code -->
<script>
var chart = AmCharts.makeChart( "piechart", {
  "type": "pie",
  "theme": "light",
  "labelText": "[[country]]: [[persen]]%",
  "dataProvider": <?=$chart?>,
  "colors":["#bfbfbf","#00cc00","#0099ff","#ffff1a"],
  "valueField": "value",
  "titleField": "country",
  "marginBottom":10,
  "marginLeft":-150,
  "marginRight":-150,
  "marginTop":10,
  "outlineAlpha": 0.4,
  "depth3D": 15,
  "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b></span>",
  "angle": 30,
  "export": {
    "enabled": true
  }
} );
</script>