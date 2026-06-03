<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<meta http-equiv="refresh" content="60">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GT painting Report</title>

  <!-- Google Font: Source Sans Pro 
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="<?= base_url() ?>/template/dist/css/adminlte.min.css"> -->
  <!-- <link rel="stylesheet" href="<?= base_url() ?>/template/theme/style.css"> -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/datatables/bootstrap.min.css">


  <!-- jQuery -->
<script src="<?= base_url() ?>/template/plugins/jquery/jquery.min.js"></script>
 <!-- Highchart -->
<script src="<?= base_url() ?>/chart_graph/code/highcharts.js"></script>
<script src="<?= base_url() ?>/chart_graph/code/series-label.js"></script>
<script src="<?= base_url() ?>/chart_graph/code/exporting.js"></script>
<script src="<?= base_url() ?>/chart_graph/code/offline-exporting.js"></script>
<script src="<?= base_url() ?>/chart_graph/code/export-data.js"></script>
<script src="<?= base_url() ?>/chart_graph/code/highcharts-3d.js"></script>


</head>

<body>
<div class="container">

<!-- <figure class="highcharts-figure">
    <div id="container1" style='min-height:500px;'></div>
    
</figure> -->
<br>
<br>
<div class="row">
      <div class="col-md-6 border bg-area">
        <p></p>
        <div id="container1"></div>

      </div>
      <div class="col-md-6 border bg-area">
        <p></p>
        <div class="card bg-area text-yellow text-bold">
        <div style="overflow:auto;height:400px">
          <table class="table">
              
                <thead>
                    <tr>
                        <th>Data statistik GT Parking AUTO</th>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>IP Code</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                        <?php $no = 1;
                        foreach ($tbl_statistik_1 as $m) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $m->MAT_IP_CODE ?></td>
                                <td><?php echo $m->Total ?></td>
                                
                                
                            </tr>
                        <?php } ?>

                    </tbody>
					
					<thead>
                            <tr>
                                
                                    <th>Total</th>
                                    <th></th>
                                    <th><?php echo $total_semua_1 ?></th> 
                                </tr>

                            </thead>            
					
          </table>
          </div>
        </div>
      </div>
    </div>
<div class="row">
      <div class="col-md-6 border bg-area">
        <p></p>
        <div id="container2"></div>

      </div>
      <div class="col-md-6 border bg-area">
        <p></p>
        <div class="card bg-area text-yellow text-bold">
        <div style="overflow:auto;height:400px">
          <table class="table">
              
                <thead>
                    <tr>
                        <th>Data statistik GT Parking MANUAL</th>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>IP Code</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                        <?php $no = 1;
                        foreach ($tbl_statistik_2 as $m) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $m->MAT_IP_CODE ?></td>
                                <td><?php echo $m->Total ?></td>
                                
                                
                            </tr>
                        <?php } ?>

                    </tbody>
					
					<thead>
                            <tr>
                                
                                    <th>Total</th>
                                    <th></th>
                                    <th><?php echo $total_semua_2 ?></th> 
                                </tr>

                            </thead>            
					
          </table>
          </div>
        </div>
      </div>
    </div>


<script type="text/javascript">
    // Radialize the colors
    Highcharts.setOptions({
        colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
            return {
                radialGradient: {
                    cx: 0.5,
                    cy: 0.3,
                    r: 0.7
                },
                stops: [
                    [0, color],
                    [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                ]
            };
        })
    });


    // Build the chart
    Highcharts.chart('container1', {
        chart: {
            renderTo: 'container1',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        credits: {
        enabled: false
    },
        title: {
            text: 'GT Painting Parking AUTO Percentage by %'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Share',
            data: [ 
            <?php $n = 1;
                    foreach ($pieparking_1 as $ppark) {
                        $matcode = isset($ppark->MAT_IP_CODE) ? ($ppark->MAT_IP_CODE) : '';
                        $total = isset($ppark->Total) ? ($ppark->Total) : '';
                        $no = $n++;
                    ?>
                        <?php if ($no == 1) { ?> {
                                name: '<?php echo $matcode ?>',
                                y: <?php echo $total ?>,
                                sliced: true,
                                selected: true
                            },
                        <?php } else { ?> {
                                name: '<?php echo $matcode ?>',
                                y: <?php echo $total ?>
                            },
                        <?php } ?>
                    <?php } ?>
            ]
        }]
    });
    // Build the chart
    Highcharts.chart('container2', {
        chart: {
            renderTo: 'container2',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        credits: {
        enabled: false
    },
        title: {
            text: 'GT Painting Parking MANUAL Percentage by %'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Share',
            data: [ 
            <?php $n = 1;
                    foreach ($pieparking_2 as $ppark) {
                        $matcode = isset($ppark->MAT_IP_CODE) ? ($ppark->MAT_IP_CODE) : '';
                        $total = isset($ppark->Total) ? ($ppark->Total) : '';
                        $no = $n++;
                    ?>
                        <?php if ($no == 1) { ?> {
                                name: '<?php echo $matcode ?>',
                                y: <?php echo $total ?>,
                                sliced: true,
                                selected: true
                            },
                        <?php } else { ?> {
                                name: '<?php echo $matcode ?>',
                                y: <?php echo $total ?>
                            },
                        <?php } ?>
                    <?php } ?>
            ]
        }]
    });
</script>
</div>
	</body>
</html>
u1cyxpNlprapEUjAXIwYdmWrUREQxkn
u1cyxpNlprapEUjAXIwYdmWrURERQxkn
