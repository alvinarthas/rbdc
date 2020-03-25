
<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Dashboard</h1>
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
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="#">Informasi Retribusi</a>
						</li>
					</ul>
					<div class="close-bread">
						<a href="#"><i class="icon-remove"></i></a>
					</div>
				</div>
				
				<div class="row-fluid">
					<div class="span4">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-bar-chart"></i>
									Target Vs Realisasi
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div><!--box title-->
							<div class="box-content">
								<table class="table table-hover table-nomargin">
									<thead>
										<tr>
											<th>SKPD</th>
											<th>TARGET</th>
											<th>REALISASI</th>
											
										</tr>
									</thead>
									<tbody>
										<?php
											foreach($cek as $key){
												$id = $key['id_dinas'];
										?>
											<tr>
												<td colspan="2"><strong><center><?=$key['nama'];?><center></strong></td>
												<td><input type="button" value="+" id="change_btn<?=$id?>" onclick="ajx_dash(<?=$id?>)"></input> 
</td>
											</tr>
									</tbody>
									<tbody id="row_retribusi<?=$id?>" class="rowsss<?=$id?>">
									</tbody>
																			<?php
											}
										?>
								</table>
							</div><!--box content-->
						</div><!--box box-color box-bordered-->
					</div> <!--span-4-->
					<div class="span8">
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
							<div id="chartdiv" style="width: 100%; height: 400px;"></div>		
							</div><!--box content-->
						</div><!--box box-color box-bordered-->
					</div><!--span-8-->
				</div><!--row fluid-->
</div><!--container fluid-->
	<script>
		function ajx_dash(id){
			var btn = $("#change_btn"+id).val();
			if(btn=="+"){
				$.ajax({
					url : '<?php echo site_url('dashboard/ajx_dash');?>/'+id,
					type : 'GET',
					dataType : 'json',
					success : function(data) {
						for (i = 0; i < Object.keys(data).length; i++) { 
							$("#row_retribusi"+id).append("<tr><td>" + data[i].nama + "</td><td>" + data[i].target + "</td><td>" + data[i].realisasi + "</td></tr>");
						}
						document.getElementById("change_btn"+id).value = "-";
					},
					error : function() {
						console.log('error');
					}
					
				});
			}
			else if(btn=="-"){
				$("#row_retribusi"+id).empty();
				document.getElementById("change_btn"+id).value = "+";
			}
		}
	</script>						
	<script src="<?php echo base_url()?>assets_users/amcharts/amcharts.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets_users/amcharts/serial.js" type="text/javascript"></script>
	<script type="text/javascript">
            var chart;

             var chartData = [

                {
                    "country": "DINAS PERHUBUNGAN",
                    "visits": 4025,
                    "color": "#FF0F00"
                },
                {
                    "country": "DINAS PEKERJAAN UMUM",
                    "visits": 1882,
                    "color": "#FF6600"
                },
                {
                    "country": "DINAS DAMKAR",
                    "visits": 1809,
                    "color": "#FF9E01"
                },
                {
                    "country": "DINAS ",
                    "visits": 1322,
                    "color": "#FCD202"
                },
                {
                    "country": "DINAS",
                    "visits": 1122,
                    "color": "#F8FF01"
                },
                {
                    "country": "DINAS",
                    "visits": 1114,
                    "color": "#B0DE09"
                },
                {
                    "country": "DINAS",
                    "visits": 984,
                    "color": "#04D215"
                },
                {
                    "country": "DINAS",
                    "visits": 711,
                    "color": "#0D8ECF"
                },
                {
                    "country": "DINAS",
                    "visits": 665,
                    "color": "#0D52D1"
                },
                {
                    "country": "DINAS",
                    "visits": 580,
                    "color": "#2A0CD0"
                }
            ];


            AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "country";
                // the following two lines makes chart 3D
                chart.depth3D = 20;
                chart.angle = 30;

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.labelRotation = 90;
                categoryAxis.dashLength = 5;
                categoryAxis.gridPosition = "start";

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.title = "Realisasi";
                valueAxis.dashLength = 5;
                chart.addValueAxis(valueAxis);

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.valueField = "visits";
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