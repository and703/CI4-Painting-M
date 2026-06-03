<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <!-- validations start -->
    <section id="input-validation">
        <div class="row" align="center">
            <div class="col-12">
                <div class="row">
                    <div class="row" align="left">
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                    </div>
                    <h5 class="card-title" style="font-size: 300%; color: #FFF017;">INPUT NIK</h4>
                    <div class="col-12">
                        <form action="/worker/get_nik_mm" method="post">
                            <input style="text-align:center; font-weight:bold; width:50%" type="text" class="form-control" name="WM_CODE" id="WM_CODE" placeholder="NIK" required autofocus autocomplete="off" oninput="getVal()">
							<div class="container1"></div>
                    </div>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                    <?php endif;  ?>
                        <h5 class="card-title" style="font-size: 200%; color: #FFF017;">PLEASE INPUT YOUR EMPLOYEE NUMBER IDENTIFICATION</h4>
							<input type="submit" class="btn btn-danger" style="font-size: 250%; color: #00ff89; font-weight:bold;" value="LOGIN"/>
                        </form>
                </div>
            </div>
        </div>
    </section>
    <!-- validations end -->
    
    <?php 
        $mm = session()->get('logged_in_mm');
        if(isset($mm)){
            echo '
            <script language="JavaScript" type="text/javascript">
                window.location.href = "park_view";
            </script>';
        }
    ?>
</div>
<script>
var max_fields = 1;
var wrapper = $(".container1");
var x = 0;
function getVal() {
	const val = document.querySelector('input').value;
	console.log(isNaN(val));
	if(isNaN(val)){
		console.log(val);        
		if (x < max_fields) {
            x++;
			$(wrapper).append('<input style="text-align:center; font-weight:bold; width:50%" type="password" class="form-control" name="Pass" id="Pass" placeholder="Pass" required autofocus autocomplete="off"">'); //add input box
        }
	}else{
		var element = document.getElementById("Pass"); // notice the change
		element.parentNode.removeChild(element);
        x--;
	}
	if(val === 'irhamkh002'){
		var element = document.getElementById("Pass"); // notice the change
		element.parentNode.removeChild(element);
        x--;
	}
}
</script>
<?= $this->endSection() ?>