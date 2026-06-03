<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
	<?php 
		$mm = session()->get('logged_in_mm');
		if(isset($mm)){
			echo '';
		}else{
			echo '<script>window.location.href = "parking";</script>';
		}
	?>
	<div class="col-4">
		<div class="row">
			<h5 class="card-title" style="font-size: 100%; color: #FFF;"><?= session()->get('MM_CODE');?></h5>
			<h5 class="card-title" style="font-size: 100%; color: #FFF;"><?= session()->get('MM_NAME')." ".session()->get('MM_SURNAME');?></h5>
				<h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
		</div>
	</div>
	<form id="reprint" action="/Worker/tagconf" method="post" enctype="multipart/form-data">
		<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
		<input type="hidden" name="MM_CODE" value="<?= session()->get('MM_CODE'); ?>">
		<input type="hidden" name="id" value="<?= $painting['id']; ?>">
		<input type="hidden" name="Park" value="<?= $painting['Park']; ?>">
		<input type="hidden" name="MCH" value="<?= $painting['MCH']; ?>">
		<input type="hidden" name="CURE_TIME" value="<?= $painting['CURE_TIME']; ?>">
		<div class="page-heading">
							<br>
			<!-- validations start -->
			<section id="input-validation">
				<div class="row" align="center">
					<div class="col-md-12">
						<div class="text-center">
							<p style="font-size: 150%; color: #FFF017; margin-bottom: 0px;">SELECTED PARKING LOT</p>
							<p style="font-size: 250%; color: #00ff89; font-weight:bold; margin-bottom: 0px;"><?= $painting['Park'];?></p>
							<p style="font-size: 130%; color: #FFF017; margin-bottom: 0px;">SELECTED PAINTED GT TROLY</p>
							<p style="font-size: 250%; color: #00ff89; font-weight:bold; margin-bottom: 0px;"><?= $painting['MAT_IP_CODE'];?></p>
							<p style="font-size: 130%; color: #FFF017; margin-bottom: 0px;"><?= $painting['MAT_DESC'];?></p>
							<p style="font-size: 250%; color: #00ff89; font-weight:bold; margin-bottom: 0px;"><?= $painting['Amount'];?></p>
						</div>
					</div>
					<div class="col-md-12">
						<div class="text-left">
							<p style="font-size: 150%; color: #FFF017; margin-bottom: 0px;">CURE TIME</p>
							<p style="font-size: 250%; color: #00ff89; font-weight:bold; margin-bottom: 0px;"><?= $painting['CURE_TIME'];?></p>
							<br>
							<br>
							<?= $message?>
<?php

							$dateCure = date_create_from_format("d/m/Y H.i", $painting['CURE_TIME'])->format("Y-m-d H:i:s");
							$dateNow =  date_create()->format('Y-m-d H:i:s');
							
							if($dateNow >= $dateCure AND $painting['id'] == $fifo['id']){
								echo '<input type="submit" class="btn btn-danger" style="font-size: 250%; color: #00ff89; font-weight:bold;" value="CONFIRM"/>';
							}else{
								echo '
									<!-- Button trigger Quality -->
									<button type="button" class="btn btn-danger" style="font-size: 250%; color: #00ff89; font-weight:bold;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
									  Need Confirm Quality
									</button>
									<!-- Button trigger Pricking
									<button type="button" class="btn btn-danger" style="font-size: 250%; color: #00ff89; font-weight:bold;" data-bs-toggle="modal" data-bs-target="#pricking">
									  Confirm Pricking
									</button>  -->
									';
							}
?>
							<br>
							<br>
							<a class="btn btn-danger" href="javascript:history.back()" style="font-size: 250%; color: #00ff89; font-weight:bold;" >Go Back</a>
						</div>
					</div>
				</div>
			</section>
			<!-- validations end -->
		</div>
	</form>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Confirm Quality</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		<form id="reprint" action="/Worker/tagconf_qty" method="post" enctype="multipart/form-data">
			<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
			<input type="hidden" name="MM_CODE" value="<?= session()->get('MM_CODE'); ?>">
			<input type="hidden" name="id" value="<?= $painting['id']; ?>">
			<input type="hidden" name="Park" value="<?= $painting['Park']; ?>">
			<input type="hidden" name="MCH" value="<?= $painting['MCH']; ?>">
			<input type="hidden" name="CURE_TIME" value="<?= $painting['CURE_TIME']; ?>">
			<div class="page-heading">
								<br>
				<!-- validations start -->
				<section id="input-validation">
					<div class="row" align="center">
						<div class="col-md-12">
							<div class="text-center">
								<p style="font-size: 150%; color: #000; margin-bottom: 0px;">SELECTED PARKING LOT</p>
								<p style="font-size: 250%; color: #000; font-weight:bold; margin-bottom: 0px;"><?= $painting['Park'];?></p>
								<p style="font-size: 130%; color: #000; margin-bottom: 0px;">SELECTED PAINTED GT TROLY</p>
								<p style="font-size: 250%; color: #000; font-weight:bold; margin-bottom: 0px;"><?= $painting['MAT_IP_CODE'];?></p>
								<p style="font-size: 130%; color: #000; margin-bottom: 0px;"><?= $painting['MAT_DESC'];?></p>
								<p style="font-size: 250%; color: #000; font-weight:bold; margin-bottom: 0px;"><?= $painting['Amount'];?></p>
							</div>
						</div>
						<div class="col-md-12">
							<div class="text-left">
								<p style="font-size: 150%; color: #000; margin-bottom: 0px;">CURE TIME</p>
								<p style="font-size: 250%; color: #000; font-weight:bold; margin-bottom: 0px;"><?= $painting['CURE_TIME'];?></p>
								<br>
								<br>
                                <input style="text-align:center; width:100%" type="text" class="form-control" name="Qty_NIK" placeholder="Quality ID" required autofocus autocomplete="off">
								<input style="text-align:center; width:100%" type="password" class="form-control" name="pass_QC" placeholder="Password" autocomplete="off">
								<input type="submit" class="btn btn-danger" style="font-size: 250%; color: #00ff89; font-weight:bold;" value="CONFIRM"/>
							</div>
						</div>
					</div>
				</section>
				<!-- validations end -->
			</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal2 -->
<div class="modal fade" id="pricking" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="prickingLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="prickingLabel">Confirm Pricking</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		<form id="reprint" action="/Worker/tagconf_pry" method="post" enctype="multipart/form-data">
			<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
			<input type="hidden" name="MM_CODE" value="<?= session()->get('MM_CODE'); ?>">
			<input type="hidden" name="id" value="<?= $painting['id']; ?>">
			<input type="hidden" name="Park" value="<?= $painting['Park']; ?>">
			<input type="hidden" name="MCH" value="<?= $painting['MCH']; ?>">
			<input type="hidden" name="CURE_TIME" value="<?= $painting['CURE_TIME']; ?>">
			<div class="page-heading">
								<br>
				<!-- validations start -->
				<section id="input-validation">
					<div class="row" align="center">
						<div class="col-md-12">
							<div class="text-center">
								<p style="font-size: 150%; color: #000; margin-bottom: 0px;">SELECTED PARKING LOT</p>
								<p style="font-size: 250%; color: #000; font-weight:bold; margin-bottom: 0px;"><?= $painting['Park'];?></p>
								<p style="font-size: 130%; color: #000; margin-bottom: 0px;">SELECTED PAINTED GT TROLY</p>
								<p style="font-size: 250%; color: #000; font-weight:bold; margin-bottom: 0px;"><?= $painting['MAT_IP_CODE'];?></p>
								<p style="font-size: 130%; color: #000; margin-bottom: 0px;"><?= $painting['MAT_DESC'];?></p>
								<p style="font-size: 250%; color: #000; font-weight:bold; margin-bottom: 0px;"><?= $painting['Amount'];?></p>
							</div>
						</div>
						<div class="col-md-12">
							<div class="text-left">
								<p style="font-size: 150%; color: #000; margin-bottom: 0px;">CURE TIME</p>
								<p style="font-size: 250%; color: #000; font-weight:bold; margin-bottom: 0px;"><?= $painting['CURE_TIME'];?></p>
								<input type="submit" class="btn btn-danger" style="font-size: 250%; color: #00ff89; font-weight:bold;" value="CONFIRM"/>
							</div>
						</div>
					</div>
				</section>
				<!-- validations end -->
			</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);
</script>
<?= $this->endSection() ?>
