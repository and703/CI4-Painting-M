<?= $this->extend("layouts/app") ?>
<?= $this->section("content") ?>
<br>
<div class="page-heading">
    <!-- validations start -->
    <section id="input-validation" align="center">
        <div class="container">
            <div class="col-4">
                <div class="row">
                    <h5 class="card-title" style="font-size: 100%; color: #FFF;"><?= session()->get("WM_CODE") ?></h5>
                    <h5 class="card-title" style="font-size: 100%; color: #FFF;"><?= session()->get("WM_NAME") . " " .session()->get("WM_SURNAME") ?></h5>
                    <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h5>
                </div>
            </div>
            <div id="h" class="row row-cols-12 row-cols-lg-10 g-1 g-lg-1">
            </div>
			<div class="row" align="center">
				<div class="col-12">
					<div class="row">
						<div class="row" align="left">
						</div>
						<h5 class="card-title" style="font-size: 200%; color: #FFF017;">SCAN TAG QRCODE</h4>
						<div class="col-12">
							<form action="/worker/get_tag" method="post">
								<input style="text-align:center; font-weight:bold; width:70%" type="text" class="form-control" name="listTag" placeholder="listTag" required autofocus autocomplete="off">
								<input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1" />
							</form>
						</div>
					</div>
				</div>
			</div>
        </div>
    </section>
    <!-- validations end -->

</div>
<script>
$(document).ready(function(){  
    setInterval(function(){   
        $("#h").load("../fill_co.php?ip=");
    }, 500);
});
</script>
<?= $this->endSection() ?>
