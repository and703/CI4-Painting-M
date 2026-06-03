<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <!-- validations start -->
    <section id="input-validation">
        <div class="row" align="left">
            <div class="col-1">
            </div>
            <div class="col-1">
                <div class="row">
                    <h5 class="card-title" style="font-size: 350%; color: #FFF;"><?= $mch;?></h4>
                </div>
            </div>
            <div class="col-4">
                <div class="row">                    
                    <h5 class="card-title" style="font-size: 100%; color: #FFF;">NIK: <?= session()->get('WM_CODE');?></h5>
                    <h5 class="card-title" style="font-size: 100%; color: #FFF;">FULL NAME: <?= session()->get('WM_NAME')." ".session()->get('WM_SURNAME');?></h5>
                    <h5 class="card-title" style="font-size: 100%; color: #FFF;">GROUP: <?= session()->get('GROUP');?></h5>
                    <h5 class="card-title" style="font-size: 100%; color: #FFF;">SHIFT: <?= session()->get('SHIFT');?></h5>
                </div>
            </div>
        </div>
        <div class="row" align="left">
            <div class="col-1">
            </div>
            <div class="col-6">
                <div class="row">
                    <h5 class="card-title" style="font-size: 150%; color: #FFF;"><?= $gt_ip->MAT_IP_CODE;?></h4>
                    <h5 class="card-title" style="font-size: 150%; color: #FFF;"><?= $gt_ip->MAT_DESC;?></h4>
                </div>
            </div>
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
                    <h5 class="card-title" style="font-size: 300%; color: #FFF017;">INPUT AMOUNT</h4>
                    <div class="col-12">
						<form action="/worker/save" method="post">
							<input type="hidden" name="mch" value="<?= $mch;?>">
							<input type="hidden" name="MAT_DESC" value="<?= $gt_ip->MAT_DESC;?>">
							<input type="hidden" name="MAT_IP_CODE" value="<?= $gt_ip->MAT_IP_CODE;?>">
							<input type="hidden" name="AG_time" value="<?= $AG_time ?>">
							<input type="hidden" name="Count_Printed" value="1">
							<input style="text-align:center; font-size: 300%; font-weight:bold; width:20%" type="text" class="form-control" id="valid-state" placeholder="Amount" name="Amount" autofocus required autocomplete="off" maxlength="2">
							<input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1" />
						</form>
                    </div>
                    <h5 class="card-title" style="font-size: 200%; color: #FFF017;">PLEASE INPUT AMOUNT OF TIRE IN THE TROLLEY</h4>
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
<?= $this->endSection() ?>
