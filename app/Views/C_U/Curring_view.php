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
                    <div class="row" align="left">
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h4>
                    </div>
                    <h5 class="card-title" style="font-size: 300%; color: #FFF017;">INPUT NIK</h4>
                    <div class="col-12">
                        <form action="/worker/cure_log" method="post">
                            <input style="text-align:center; font-weight:bold; width:50%" type="text" class="form-control" name="WM_CODE" placeholder="NIK" required autofocus autocomplete="off">
                            <input oninput="this.value = this.value.toUpperCase()" style="text-align:center; font-weight:bold; width:50%" type="text" class="form-control" name="GROUP" placeholder="GROUP" required autofocus autocomplete="off">
                            <input style="text-align:center; font-weight:bold; width:50%" type="text" class="form-control" name="SHIFT" placeholder="SHIFT" required autofocus autocomplete="off">
                            <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1" />
                        </form>
                    </div>
                        <h5 class="card-title" style="font-size: 200%; color: #FFF017;">PLEASE INPUT YOUR EMPLOYEE NUMBER IDENTIFICATION</h4>
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
                </div>
            </div>
        </div>
    </section>
    <!-- validations end -->
    
    <?php 
        $wm = session()->get('logged_in_cm');
        if(isset($wm)){
            echo '
            <script language="JavaScript" type="text/javascript">
                window.location.href = "cure_mch";
            </script>';
        }
    ?>
</div>
<?= $this->endSection() ?>