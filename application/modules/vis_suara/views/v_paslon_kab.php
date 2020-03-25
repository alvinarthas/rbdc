<div class="box box-color box-bordered">
    <div class="box-title">
        <h3><i class=" icon-plus-sign"></i>Visualisasi Data  </h3>
    </div>
    <div class="box-content">
        <center><h5>Pemetaan Pemilih Calon Gubernur Riau</h5></center>
        <center><h5>Berdasarkan: <?=$kategori?> per <?=$daerah?></h5></center>
        <div id="chartdiv" style="width: 100%; height: 500px;"></div>
    </div>
    <div class="box-content">
        <center><h5>Persentase Pemilih Calon Gubernur Riau</h5></center>
        <center><h5>Yang Telah Disurvey</h5></center>
        <center><h5>Berdasarkan: <?=$kategori?> per <?=$daerah?></h5></center>
        <div id="piechart" style="width: 100%; height: 500px;"></div>
    </div>
    <div class="box-content">
        <center><h5>Persentase Target Suara</h5></center>
        <center><h5>Berdasarkan: <?=$kategori?> per <?=$daerah?></h5></center>
        <div id="piechart2" style="width: 100%; height: 500px;"></div>
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

<script>
var chart = AmCharts.makeChart( "piechart", {
  "type": "pie",
  "theme": "light",
  "dataProvider": <?=$piechart?>,
  "valueField": "value",
  "titleField": "country",
  "legend": {
    "autoMargins":false,
    "position":"bottom",
    "marginRight":100,
    "data": <?=$piedata2?>
  },
  "marginBottom":10,
  "marginLeft":-150,
  "marginRight":-150,
  "marginTop":10,
  "outlineAlpha": 0.4,
  "depth3D":25,
  "balloonText": "[[title]]<br><span style='font-size:12px'><b>[[value]]</b> ([[percents]]%)</span>",
  "angle": 30,
  "export": {
    "enabled": true
  }
} );
</script>

<script>
var chart = AmCharts.makeChart( "piechart2", {
  "type": "pie",
  "theme": "light",
  "dataProvider": <?=$piechart2?>,
  "valueField": "value",
  "titleField": "country",
  "legend": {
    "autoMargins":false,
    "position":"bottom",
    "marginRight":100,
    "data": <?=$piedata?>
  },
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