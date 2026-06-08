<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<p style="font-size: 250%; color: #FFF017; font-weight:bold; margin-bottom: 0px;">Press "+" For RePrint Tag</p>
<div class="page-heading">
    <section id="input-validation">
        <div class="row" align="center">
            <div class="col-12">
                <div class="row">
                    <div class="row" align="left">
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h5>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h5>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h5>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h5>
                    </div>
                    <h5 class="card-title" style="font-size: 300%; color: #FFF017;">AUTO MACHINE 1</h5>
                    <div class="row" align="left">
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h5>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h5>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h5>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h5>
                    </div>
                    <h5 class="card-title" style="font-size: 300%; color: #FFF017;">INPUT NIK</h5>
                    <div class="col-12">
                        <form action="<?= site_url('worker/get_nik') ?>" method="post">
                            <?= csrf_field() ?>
                            <input style="text-align:center; font-weight:bold; width:50%" type="text" class="form-control" name="WM_CODE" placeholder="NIK" required autofocus autocomplete="off">
                            <input oninput="this.value = this.value.toUpperCase()" style="text-align:center; font-weight:bold; width:50%" type="text" class="form-control" name="GROUP" placeholder="GROUP" required autocomplete="off">
                            <input style="text-align:center; font-weight:bold; width:50%" type="text" class="form-control" name="SHIFT" placeholder="SHIFT" required autocomplete="off">
                            <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1" />
                        </form>
                    </div>
                    <h5 class="card-title" style="font-size: 200%; color: #FFF017;">PLEASE INPUT YOUR EMPLOYEE NUMBER IDENTIFICATION</h5>
                    <div class="row" align="left">
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h5>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h5>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h5>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h5>
                    </div>
                    <div class="row" align="left">
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h5>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h5>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h5>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    $wm = session()->get('logged_in_wm');
    if (isset($wm)) {
        echo '<script>window.location.href = "' . site_url('mch') . '";</script>';
    }
    ?>
</div>
<?= $this->endSection() ?>
