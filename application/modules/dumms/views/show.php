<meta http-equiv="refresh" content="30">
<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Profile Dinas</h1>
					</div>
					<div class="pull-right">
						
						<ul class="stats">
							
							<li class='lightred'>
								<i class="icon-calendar"></i>
								<div class="details">
									<span class="big">February 22, 2013</span>
									<span>Wednesday, 13:56</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="#">Beranda</a>
						</li>
					</ul>
					<div class="close-bread">
						<a href="#"><i class="icon-remove"></i></a>
					</div>
				</div>
				
				<div class="row-fluid">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-bar-chart"></i>
									Grafik
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div><!--box title-->
							<div class="box-content">
							<div id="chartdiv" style="width: 100%; height: 500px;"></div>		
							</div><!--box content-->
						</div><!--box box-color box-bordered-->
				</div><!--row fluid-->
</div><!--container fluid-->
	<script src="<?php echo base_url()?>assets_users/amcharts/amcharts.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets_users/amcharts/serial.js" type="text/javascript"></script>
	<script type="text/javascript">
    $( document ).ready(function() {
		console.log('a');
	});
			var chart;
			var chartData = <?=$chart?>;
            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "nama";
                // the following two lines makes chart 3D
                chart.depth3D = 0;
                chart.angle = 0;

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.labelRotation = 45;
				categoryAxis.fontSize= 10;
                categoryAxis.dashLength = 5;
                categoryAxis.gridPosition = "start";

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.title = "Nilai";
                valueAxis.dashLength = 5;
                chart.addValueAxis(valueAxis);

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.valueField = "value";
                graph.colorField = "color";
                graph.balloonText = "<span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 1;
                chart.addGraph(graph);

                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chartCursor.cursorAlpha = 0;
                chartCursor.zoomable = false;
                chartCursor.categoryBalloonEnabled = false;
                chart.addChartCursor(chartCursor);

                chart.creditsPosition = "top-right";


                // WRITE
                chart.write("chartdiv");
            });
        </script>