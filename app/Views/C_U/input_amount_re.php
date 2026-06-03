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
                    <h5 class="card-title" style="font-size: 350%; color: #FFF;"><?= $painting['MCH'];?></h4>
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
            <div class="col-6">
                <div class="row">
                    <h5 class="card-title" style="font-size: 150%; color: #FFF;"><?= $gt_ip->MAT_IP_CODE;?></h4>
                    <h5 class="card-title" style="font-size: 150%; color: #FFF;"><?= $gt_ip->MAT_DESC;?></h4>
                </div>
            </div>
        </div>
        <div class="row" align="center">
            <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
            <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
            <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
        </div>
        <form action="/worker/save" method="post">
            <div class="row" align="center">
                <div class="col-6">
                    <input type="hidden" name="id" value="<?= $painting['id'];?>">
                    <input type="hidden" name="Park" value="<?= $painting['Park'];?>">
                    <input type="hidden" name="mch" value="A1_RE">
                    <input type="hidden" name="mch1" value="<?= $painting['MCH'];?>">
                    <input type="hidden" name="MAT_DESC" value="<?= $painting['MAT_DESC'];?>">
                    <input type="hidden" name="MAT_IP_CODE" value="<?= $painting['MAT_IP_CODE'];?>">
                    <input type="hidden" name="On_Insert" value="<?= $painting['On_Insert'];?>">
                    <input type="hidden" name="CURE_TIME" value="<?= $painting['CURE_TIME'];?>">
                    <input type="hidden" name="Count_Printed" value="1">
                    <input type="hidden" name="AG_time" value="<?= $AG_time?>">
                    
                    <h5 class="card-title" style="font-size: 300%; color: #FFF017;">OP NAME</h4>
                    <input style="text-align:center; font-size: 300%; font-weight:bold; width:80%" type="text" class="form-control" id="valid-state" placeholder="WM_NAME_WM_SURNAME" name="WM_NAME_WM_SURNAME" value="<?= $painting['WM_NAME_WM_SURNAME'];?>" disabled>
                    <h5 class="card-title" style="font-size: 300%; color: #FFF017;">GROUP</h4>
                    <input style="text-align:center; font-size: 300%; font-weight:bold; width:80%" type="text" class="form-control" id="valid-state" placeholder="WM_GROUP" name="WM_GROUP" value="<?= $painting['WM_GROUP'];?>" disabled>
                    <h5 class="card-title" style="font-size: 300%; color: #FFF017;">SHIFT</h4>
                    <input style="text-align:center; font-size: 300%; font-weight:bold; width:80%" type="text" class="form-control" id="valid-state" placeholder="WM_SHIFT" name="WM_SHIFT" value="<?= $painting['WM_SHIFT'];?>" disabled>
                    <h5 class="card-title" style="font-size: 300%; color: #FFF017;">MACHINE</h4>
                    <input style="text-align:center; font-size: 300%; font-weight:bold; width:80%" type="text" class="form-control" id="valid-state" placeholder="MCH" name="mch1" value="<?= $painting['MCH'];?>" disabled>
                </div>
                <div class="col-6">
                    <h5 class="card-title" style="font-size: 300%; color: #FFF017;">IP CODE</h4>
                    <input style="text-align:center; font-size: 300%; font-weight:bold; width:80%" type="text" class="form-control" id="valid-state" placeholder="MAT_IP_CODE" name="MAT_IP_CODE" value="<?= $painting['MAT_IP_CODE'];?>" disabled>
                    <h5 class="card-title" style="font-size: 300%; color: #FFF017;">MATERIAL DESCRIPTION</h4>
                    <input style="text-align:center; font-size: 300%; font-weight:bold; width:80%" type="text" class="form-control" id="valid-state" placeholder="MAT_DESC" name="MAT_DESC" value="<?= $painting['MAT_DESC'];?>" disabled>
                    <h5 class="card-title" style="font-size: 300%; color: #FFF017;">DATE CREATE</h4>
                    <input style="text-align:center; font-size: 300%; font-weight:bold; width:80%" type="text" class="form-control" id="valid-state" placeholder="CREATE_DATE" name="CREATE_DATE" value="<?= $painting['On_Insert'];?>" disabled>
                    <h5 class="card-title" style="font-size: 300%; color: #FFF017;">CURE TIME</h4>
                    <input style="text-align:center; font-size: 300%; font-weight:bold; width:80%" type="text" class="form-control" id="valid-state" placeholder="CURE_TIME" name="CURE_TIME" value="<?= $painting['CURE_TIME'];?>" disabled>
                        
                </div>
            </div>
            <div class="col-12" align="center">
                <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                <h5 class="card-title" style="font-size: 300%; color: #FFF017;">INPUT AMOUNT TYRE REBOIACCA</h4>
                <input align="center" style="text-align:center; font-size: 300%; font-weight:bold; width:50%" type="text" class="form-control" id="valid-state" placeholder="Amount" name="Amount" autofocus required autocomplete="off" value="<?= $painting['Amount'];?>" maxlength="2">
            </div>
            <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1" />
        </form>
        <div class="row" align="center">
            <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
            <h5 class="card-title" style="font-size: 200%; color: #FFF017;">PLEASE CONFIRM DESCRIPTION OF TIRE IN THE TROLLEY</h4>
            <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
            <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
        </div>
        <div class="row" align="center">
            <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
            <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
            <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
        </div>
    </section>
    <!-- validations end -->

</div>
<?= $this->endSection() ?>
