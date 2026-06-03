<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <!-- validations start -->
    <section id="input-validation">
        <div class="row" align="left">
            <h5 class="card-title" style="font-size: 100%; color: #FFF;">
                <?php 
                    $wm = session()->get('logged_in_wm');
                    if(isset($wm)){
                        echo '<a href="worker/logout_WM" class="btn btn-danger" >Logout</a>';
                    }else{
                        echo '<a href="/" class="btn btn-success" >Login</a>';
                    }
                ?>
            </h5>
			<h5 class="card-title" style="font-size: 100%; color: #FFF;">NIK: 		<?= session()->get('WM_CODE');?></h5>
			<h5 class="card-title" style="font-size: 100%; color: #FFF;">FULL NAME: <?= session()->get('WM_NAME')." ".session()->get('WM_SURNAME');?></h5>
			<h5 class="card-title" style="font-size: 100%; color: #FFF;">GROUP: 	<?= session()->get('GROUP');?></h5>
			<h5 class="card-title" style="font-size: 100%; color: #FFF;">SHIFT: 	<?= session()->get('SHIFT');?></h5>
        </div>
        <div class="row" align="center">
            <div class="col-12">
                <div class="row">
                    <div class="row" align="left">
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                    </div>
                    <div class="row" align="left">
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                    </div>
                    <div class="row" align="left">
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                    </div>
                        <h5 class="card-title" style="font-size: 300%; color: #FFF017;">PAINTING MACHINE</h4>
                    <div class="col-6">
                        <h5 class="card-title" style="font-size: 300%; color: #FFF017;">A1</h4>
                        <h5 class="card-title" style="font-size: 200%; color: #FFF;">NumPad "1"</h4>
                    </div>
                    <div class="col-6">
                        <h5 class="card-title" style="font-size: 300%; color: #FFF017;">M1</h4>
                        <h5 class="card-title" style="font-size: 200%; color: #FFF;">NumPad "2"</h4>
                    </div>
                    <h5 class="card-title" style="font-size: 200%; color: #FFF017;">PRESS BUTTON TO CHOOSE</h4>
					<form id="mchForm" action="/worker/get_mch" method="post">
						<input type="hidden" id="mch" name="mch">
						<input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1" />
					</form>
                    <div class="row" align="left">
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                    </div>
                    <div class="row" align="left">
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                    </div>
                    <div class="row" align="left">
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- validations end -->

</div>

<script type="text/javascript"> 
	function Func1() {
		document.getElementById("mchForm").submit();
	}
	let keysDown1 = {};
	window.onkeydown = function(e) {
		keysDown1[e.key] = true;

		if (keysDown1["1"]) {
			document.getElementById("mch").value = "A1"; //set value on myInputID
			Func1();
		}
		else if(keysDown1["2"] ){
			document.getElementById("mch").value = "M1"; //set value on myInputID
			Func1();
		}
	}

	window.onkeyup = function(e) {
	keysDown1[e.key] = false;
	}
</script>
<?= $this->endSection() ?>
