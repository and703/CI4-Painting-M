<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

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


<!-- jQuery Datatables -->
<script src="<?= base_url() ?>/template/plugins/jquery/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/template/datatables/css.css" />
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/sumfooter/css/jquery.dataTables.css" />
	<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" /> -->
	<!-- <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" /> -->


	<!-- JS Datatables -->

	<script type="text/javascript" src="<?= base_url() ?>/template/datatables/pdf.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>/template/datatables/font.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>/template/datatables/datatable.js"></script>
	<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script> -->
	<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
	<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>  -->
	<script type="text/javascript" src="<?= base_url() ?>/sumfooter/js/dataTables.colReorder.min.js"></script>


	<!-- <script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.5.2/js/dataTables.colReorder.min.js"></script> -->


	<!-- Bootstrap Tagsinput Css -->
	<!-- <link href="<?= base_url() ?>/public/new/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
	<link href="<?= base_url() ?>/public/static/js/alertify/css/alertify.css" rel="stylesheet">
	<link href="<?= base_url() ?>/public/plug/date/daterangepicker.css" rel="stylesheet"> -->
	<link href="<?= base_url() ?>/template/date/daterangepicker.css" rel="stylesheet">
	<script type="text/javascript" src="<?= base_url() ?>/template/date/date_moment.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>/template/date/date_range.js"></script>

	<!-- Plugin Loading page -->

	<script src="<?= base_url() ?>/template/blokui.js"></script>
	<script src="<?= base_url() ?>/template/loader.js"></script>







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
								GT Boiacca Report
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
												<td>Machine</td>
												<td>IP Code</td>
												<td>Material Deskripsi</td>
												<td>Jumlah</td>
												<td>Slot</td>
												<td>Print Out</td>
												<td>Operator</td>
												<td>Group</td>
												<td>Shift</td>

											</tr>
										</thead>
										
										<tbody>
										</tbody>

										<tfoot>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>Jumlah</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>

											</tr>
										</tfoot>
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
			
			<script type="text/javascript">
				var dataTable = $('#report1').DataTable({
					"paging": true,
					"processing": false, //Feature control the processing indicator.
					"language": {
						"sSearch": "Search Barcode",
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
					dom: 'Blfrtip',
					buttons: [{


							text: '<span class="fas fa-sync-alt"></span> Refresh',
							className: "btn btn-light btn-sm",
							action: function(e, dt, node, config) {
								reload_table();
							}
						},
						{
							extend: 'excelHtml5',
							exportOptions: {
								columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
							},
							footer: true,
							text: '<span class="fas fa-file-excel"></span> Download Excell',
							className: "btn btn-light btn-sm",
							title: 'Painting',
							messageTop: 'DI CETAK : <?php echo date("d/m/Y H:i") ?>',
							filename: 'painting_report',
							customize: function(xlsx) {
								var source = xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
								source.setAttribute('name', 'painting');
							}
						},
					],
					"order": [[ 7, "desc" ]],
					// Load data for the table's content from an Ajax source
					"ajax": {
						"url": "<?= site_url('report_cure/data_tables'); ?>",
						"type": "POST",
						"data": function(data) {
							data.f1 = $('#f1').val(); //inputan value 1
							data.f2 = $('#f2').val(); ////inputan value 2
							// data.f3 = $('#f3').val();
							// data.f4 = $('#f4').val();
							// data.f5 = $('#f5').val();
						},
						beforeSend: function() {
							loading('area_lod');
						},
						complete: function(data) {
							unblock('area_lod');
						},

					},
					"fixedHeader": true,
					"colReorder": true,
					"pageLength": 5,
					"lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],


					"footerCallback": function(row, data, start, end, display) {
						var api = this.api(),
							data;

						// Remove the formatting to get integer data for summation
						var intVal = function(i) {
							return typeof i === 'string' ?
								i.replace(/[\,]/g, '') * 1 :
								typeof i === 'number' ?
								i : 0;
						};

						// Total over all pages
						total = api
							.column(api.colReorder.transpose(4))
							.data()
							.reduce(function(a, b) {
								return intVal(a) + intVal(b);
							}, 0);

						// Total over this page
						pageTotal = api
							.column(api.colReorder.transpose(4), {
								page: 'current'
							})
							.data()
							.reduce(function(a, b) {
								return intVal(a) + intVal(b);
							}, 0);

						// Update footer
						$(api.column(api.colReorder.transpose(4)).footer()).html(
							+ pageTotal + '   Total'
						);
					},

					//Set column definition initialisation properties.
					"columnDefs": [{
						"targets": [-1, -2, -3, -4, -6, -7], //last column
						"orderable": false, //set not orderable
					}, ],

				});

				function reload_table() {
					dataTable.ajax.reload(null, false);
				}
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
						console.log('New date range selected: ' + start.format('DD/MM/YYYY') + ' to ' + end.format('DD/MM/YYYY') + ' (predefined range: ' + label + ')');

					});
				}
			</script>

</body>

</html>