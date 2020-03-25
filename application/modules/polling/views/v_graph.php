<div class="container-fluid">
    <div class="row">
        <div>
            <p class="text"><center>Hasil Polling</center></p>
            <div id="polling_graph" style="width: 100%; height: 500px;"></div>	
        </div>
    </div>

</div>

<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<!-- Pertumbuhan Penduduk -->
<script>
    var chart = AmCharts.makeChart( "polling_graph", {
    "type": "serial",
    "theme": "light",
    "dataProvider": <?=$result?>,
    "gridAboveGraphs": true,
    "startDuration": 1,
    "graphs": [ {
        "balloonText": "[[category]]: <b>[[value]]</b>",
        "fillAlphas": 0.8,
        "lineAlpha": 0.2,
        "type": "column",
        "valueField": "visits"
    } ],
    "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
    },
    "categoryField": "country",
    "categoryAxis": {
        "labelRotation" : 45,
        "fontSize"  :   9,
        "gridPosition": "start",
        "gridAlpha": 0,
        "tickPosition": "start",
        "tickLength": 20
    },
    "export": {
        "enabled": true
    }

    } );
</script>