<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
<title>GT Boiacca Parking Status</title>
	<!-- Google Font: Source Sans Pro
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?= base_url() ?>/template/plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->

	<link rel="stylesheet" href="<?= base_url() ?>/template/datatables/bootstrap.min.css">



	<!-- jQuery Datatables -->
	<script src="<?= base_url() ?>/template/plugins/jquery/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/template/datatables/css.css" />
	<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" /> 
	<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />


	<!-- JS Datatables -->

	<script type="text/javascript" src="<?= base_url() ?>/template/datatables/pdf.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>/template/datatables/font.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>/template/datatables/datatable.js"></script>
	<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script> -->
	<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
	<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>  -->








	<!-- Bootstrap Tagsinput Css -->
	<link href="<?= base_url() ?>/template/date/daterangepicker.css" rel="stylesheet">
	<script type="text/javascript" src="<?= base_url() ?>/template/date/date_moment.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>/template/date/date_range.js"></script>

	<!-- Plugin Loading page -->

	<script src="<?= base_url() ?>/template/blokui.js"></script>
	<script src="<?= base_url() ?>/template/loader.js"></script>


	<style>
		body {
			font: 90%/1.45em "Helvetica Neue", HelveticaNeue, Verdana, Arial, Helvetica, sans-serif;
			margin: 0;
			padding: 0;
			color: #333;
			background-color: #201B05;
		}

		.red {
			background-color: red !important;
		}

		.green {
			background-color: green !important;
		}


		table#report1.dataTable tbody tr.Highlight>.sorting_1 {
			background-color: #10A632;
		}

		table#report1.dataTable tbody tr.Highlight {
			background-color: #10A632;
		}

		table#report1.dataTable tbody tr.Highlight_2>.sorting_1 {
			background-color: #F32222;
		}

		table#report1.dataTable tbody tr.Highlight_2 {
			background-color: #F32222;
		}


		table#report1.dataTable tbody tr.Highlight_3>.sorting_1 {
			background-color: #FBD308;
		}

		table#report1.dataTable tbody tr.Highlight_3 {
			background-color: #FBD308;
		}
	</style>

</head>

<body>
	<div class="container-xl">

		<div class="row">

			<!-- Task Info -->

			<div class="container mt-5">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
							Parking Status
								<!-- <a href="" class="btn btn-primary btn-sm float-right">New Record</a> -->
							</div>
							<div class="card-body">


								<hr>

								<div id='area_lod'>
									<table id="report1" class="display table table-striped table-bordered table-hover" style="width:100%">
										<thead>

											<tr>
												<td>No</td>
												<td>IP Code</td>
												<td>Machine</td>
												<td>Material Deskripsi</td>
												<td>Slot</td>
												<td>Jumlah</td>
												<td>Operator</td>
												<td>Print Out</td>
												<td>Cure Time</td>
												<td>Hours</td>
												<td>Waktu Expired</td>
												

											</tr>

										</thead>


									</table>
								</div>

							</div>

						</div>
					</div>
				</div>
			</div>



			<script type="text/javascript">
				$(document).ready(function() {
					$('#report1').DataTable({
						"processing": true,
						"serverSide": true,
						"lengthMenu": [
							[5, 100],
							[5, 100]
						],
						dom: 'Blfrtip',
						buttons: [{
								extend: 'excelHtml5',
								exportOptions: {
									columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
								},
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
						"order": [[ 9, "desc" ]],
						"ajax": {
							"url": "<?= site_url('r_status/data_tables'); ?>",
							"type": "POST",
							"data": function(data) {

							},
							////////////////////////
							beforeSend: function() {
								loading('area_lod');
							},
							complete: function(data) {
								unblock('area_lod');
							},

						},
						//Set column definition initialisation properties.
						"columnDefs": [{
							"targets": [-1, -2, -4, -6, -9, -10], //last column
							"orderable": true, //set not orderable
						}, ],
						
						/*
						rowCallback: function(row, data) {
							
							console.log(data[11]);

							if (data[11] === 'NORMAL') {
								$(row).addClass('Highlight');
							} else if (data[11] === 'EXPIRED') {
								$(row).addClass('Highlight_2');
							} else {
								$(row).addClass('Highlight_3');
							}
						},
						*/


					});
				});
			</script>

</body>

</html>