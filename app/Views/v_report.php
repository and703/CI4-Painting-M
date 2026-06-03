<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GT painting Takeout Report</title>

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
<!-- <script src="<?= base_url() ?>/template/plugins/Highcharts-9.3.2/code/highcharts.js"></script>
<script src="<?= base_url() ?>/template/plugins/Highcharts-9.3.2/code/series-label.js"></script>
<script src="<?= base_url() ?>/template/plugins/Highcharts-9.3.2/code/exporting.js.js"></script>
<script src="<?= base_url() ?>/template/plugins/Highcharts-9.3.2/code/offline-exporting.js"></script>
<script src="<?= base_url() ?>/template/plugins/Highcharts-9.3.2/code/export-data.js"></script>
<script src="<?= base_url() ?>/template/plugins/Highcharts-9.3.2/code/highcharts-3d.js"></script> -->


 <!-- Datatables -->
<link rel="stylesheet" type="text/css" href="<?= base_url()?>/template/datatables/css.css"/>
<script type="text/javascript" src="<?= base_url()?>/template/datatables/pdf.js"></script>
<script type="text/javascript" src="<?= base_url()?>/template/datatables/font.js"></script>
<script type="text/javascript" src="<?= base_url()?>/template/datatables/datatable.js"></script>

<!-- Bootstrap Tagsinput Css -->
<!-- <link href="<?= base_url()?>/public/new/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
	<link href="<?= base_url()?>/public/static/js/alertify/css/alertify.css" rel="stylesheet">
	<link href="<?= base_url()?>/public/plug/date/daterangepicker.css" rel="stylesheet"> -->
	<link href="<?= base_url()?>/template/date/daterangepicker.css" rel="stylesheet">
	<script type="text/javascript" src="<?= base_url()?>/template/date/date_moment.js"></script>
	<script type="text/javascript" src="<?= base_url()?>/template/date/date_range.js"></script>

<!-- Plugin Loading page -->

	<script src="<?= base_url()?>/template/blokui.js"></script>
	<script src="<?= base_url()?>/template/loader.js"></script>
	


	



</head>

<body>
<div class="container">

<div class="row">

	<!-- Task Info -->

	<div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                       GT Painting Takeout Report
                        <!-- <a href="" class="btn btn-primary btn-sm float-right">New Record</a> -->
                    </div>
                    <div class="card-body">

					<div class="row clearfix">
					<div class="col-sm-4">
						<label>Date Range</label>
						<input required type="text" id="f1" name="periode" class="cursor form-control" onchange="reload_table()">
					</div>
					<div class="col-sm-4">
						<label>SHIFT</label>
						<select class="form-control show-tick" id="f2" data-live-search="true" onchange="reload_table()">
							<option value="">=== Pilih ===</option>
							<option value="1">1</option>
  							<option value="2">2</option>
  							<option value="3">3</option>
							
						</select>
					</div>
					


				</div>
<hr>

						<div id='area_lod'>
                        <table id="report1" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Kode Mesin</td>
                                    <td>IP Code</td>
									<td>Material Deskripsi</td>
									<td>Parkir</td>
									<td>Jumlah</td>
									<td>Tgl Checkout</td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
						</div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- /.Content -->

	<script>
		setTimeout(function() {
			rangetanggal();
		}, 100);
	</script>
	<script>
		$(function() {
			// $('.select3').selectpicker();
		});
	</script>
    

	<script type="text/javascript">
		var dataTable = $('#report1').DataTable({
			"paging": true,
			"processing": false, //Feature control the processing indicator.
			"language": {
				"sSearch": "Pencarian",
				"processing": ' <span class="sr-only dataTables_processing">Loading...</span> <br><b style="color:black;background:white">Process of displaying data<br> Please wait..</b>',
				"oPaginate": {
					"sFirst": "Page First",
					"sLast": "Page Last",
					"sNext": "Next",
					"sPrevious": "Previous"
				},
				"sInfo": "Total :  _TOTAL_ , Row (_START_ - _END_)",
				"sInfoEmpty": "No data displayed",
				"sZeroRecords": "Data not available",
				"lengthMenu": "&nbsp;Show _MENU_ entries",
			},
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"responsive": false,
			"searching": true,
			"lengthMenu": [
				[5, 1000, 10000],
				[5, 1000, 10000]
			],
			dom: 'Blfrtip',
			buttons: [{

				
            text: '<span class="fas fa-sync-alt"></span> Refresh',
            className :"btn btn-light btn-sm",
            action: function ( e, dt, node, config ) {
                reload_table();
            }
        },
        {
            extend: 'excelHtml5',
            exportOptions: { columns: [0,1,2,3,4,5,6] },
            text:'<span class="fas fa-file-excel"></span> Download Excell',
            className :"btn btn-light btn-sm",
            title: 'Painting',
            messageTop: 'DI CETAK : <?php echo date("d/m/Y H:i")?>',
            filename: 'painting_report',
            customize: function( xlsx ) 
            {
                var source = xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
                source.setAttribute('name','painting');
            }
        },
					
				/*{
				extend: 'colvis',
				exportOptions: {
				columns:[ 0,1,2,3,4,5]
				},text:' Coloumn',	
			},*/
			],

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?= site_url('report/data_tables'); ?>",
				"type": "POST",
				"data": function(data) {
					 data.f1 = $('#f1').val(); //inputan value 1
					 data.f2 = $('#f2').val(); ////inputan value 2
					// data.f3 = $('#f3').val();
					// data.f4 = $('#f4').val();
					// data.f5 = $('#f5').val();
				},
				beforeSend: function() {
					loading('area_lod') ;
				},
				complete: function(data) {
					unblock('area_lod');
				},

			},

			//Set column definition initialisation properties.
			"columnDefs": [{
				"targets": [-4,-6,-7], //last column
				"orderable": false, //set not orderable
			}, ],

		});

		function reload_table() {
			dataTable.ajax.reload(null, false);
		}

		// function view(id) {
		// 	$("#title_mdl_view").html("VIEW DATA");
		// 	$("#mdl_formSubmit_view").modal();
		// 	$("#formSubmit_view").attr("url", "<?= base_url("report_rem/view_data"); ?>");
		// 	$("#view_page").html('<br><br><br><center>Loading...</center><br><br><br>');
		// 	$.post("<?= site_url("report_rem/view_data"); ?>", {id:id}, function(data) {
		// 		$("#view_page").html('<iframe src="<?= base_url(); ?>/report_rem/view_data?id=' + id + '" style="width:100%;height:500px">' + data + '</iframe>');
		// 	});

		// }

		

		

		// // function downloadXL() {
		// // 	var f1 = $('#f1').val();
		// // 	var f2 = $('#f2').val();
		// // 	var f3 = $('#f3').val();
		// // 	var f4 = $('#f4').val();
		// // 	var s = $('.whatever').val();
		// // 	window.open(
		// 		"<?= base_url() ?>/report_rem/downloadXL/?f1=" + f1 + "&f2=" + f2 + "&f3=" + f3 + "&f4=" + f4 + "&s=" + s,
		// // 		'_blank' // <- This is what makes it open in a new window.
		// // 	);
		// // }
	</script>

<script>
		function rangetanggal() {
			$('#f1').daterangepicker({
				"showDropdowns": true,
				ranges: {
					'Today': [moment(), moment()],
					'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
					'1 week ago': [moment().subtract(7, 'days'), moment()],
					//   '30 Hari yang lalu': [moment().subtract(29, 'days'), moment()],
					//    'This Month': [moment().startOf('month'), moment().endOf('month')],
					//    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
				},
				"locale": {
					"format": "DD/MM/YYYY",
					"separator": " - ",
					"applyLabel": "Apply",
					"cancelLabel": "Cancel",
					"fromLabel": "From",
					"toLabel": "To",
					"customRangeLabel": "Customize",
					"weekLabel": "W",
					"daysOfWeek": [
						"Min",
						"Sen",
						"Sel",
						"Rab",
						"Kam",
						"Jum",
						"Sab",

					],
					"monthNames": [
						"Januari",
						"Februari",
						"Maret",
						"April",
						"Mei",
						"Juni",
						"Juli",
						"Agustus",
						"September",
						"Oktober",
						"November",
						"Desember"
					],
					"firstDay": 1
				},
				"startDate": moment(),
				"endDate": moment(),
				"opens": "left"
			}, function(start, end, label) {
				console.log('New date range selected: ' + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY') + ' (predefined range: ' + label + ')');

			});
		}
	</script>

    </body>

    </html>

