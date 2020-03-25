<div class="box box-color box-bordered">
    <div class="box-title">
        <h3><i class=" icon-plus-sign"></i>Visualisasi Data</h3>
    </div>
    <div class="box-content">
        <center><h5><?=$jenis?></h5></center>
        <center><h5>Berdasarkan <?php if(isset($kategori)){echo $kategori;}?> per <?=$daerah?></h5></center>
        <div id="piechart" style="width: 100%; height: 500px;"></div>
    </div>
</div>
<!-- Chart code -->
<script>
var chart = AmCharts.makeChart( "piechart", {
  "type": "pie",
  "theme": "light",
  "dataProvider": <?=$piechart?>,
  "valueField": "value",
  "titleField": "country",
  "marginBottom":10,
  "marginLeft":-150,
  "marginRight":-150,
  "marginTop":10,
  "outlineAlpha": 0.4,
  "depth3D": 15,
  "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
  "angle": 30,
  "export": {
    "enabled": true
  }
} );
</script>