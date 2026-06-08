<?php
    header("Refresh:600");
?>
<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<br>
<div class="page-heading">
    <section id="input-validation" align="center">
        <div class="">
            <div class="row">
                <div class="col-2">
                    <div class="row">
                        <?php
                            $mm = session()->get('logged_in_mm');
                            $qc = session()->get('logged_in_qc');
                            if (isset($mm)) {
                                echo '<a href="' . site_url('worker/logout_MM') . '" class="btn btn-danger" >Logout</a>';
                            } elseif (isset($qc)) {
                                echo '<a href="' . site_url('worker/logout_MM') . '" class="btn btn-danger" >Logout</a>';
                            } else {
                                echo '<a href="' . site_url('parking') . '" class="btn btn-success" >Login</a>';
                            }
                        ?>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><?= session()->get('MM_CODE') ?></h5>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><?= session()->get('MM_NAME') . " " . session()->get('MM_SURNAME') ?></h5>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h5 class="card-title" style="font-size: 400%; color: #FFF017;">Park Auto</h5>
                        <div id="h" class="row row-cols-12 row-cols-xs-12 g-2 g-xs-2">
                        </div>
                    </div>
                    <div class="col-6">
                        <h5 class="card-title" style="font-size: 400%; color: #FFF017;">Temp Park Manual</h5>
                        <div id="i" class="row row-cols-12 row-cols-xs-12 g-2 g-xs-2">
                        </div>
                        <h5 class="card-title" style="font-size: 400%; color: #FFF017;">Park Manual</h5>
                        <div id="j" class="row row-cols-12 row-cols-xs-12 g-2 g-xs-2">
                        </div>
                    </div>
                </div>
                <div class="row" align="center">
                    <div class="col-12">
                        <div class="row">
                            <div class="row" align="left">
                            </div>
                            <h5 class="card-title" style="font-size: 200%; color: #FFF017;">SCAN TAG QRCODE</h5>
                            <div class="col-12">
                                <form action="<?= site_url('worker/get_tag') ?>" method="post" autocomplete="off">
                                    <?= csrf_field() ?>
                                    <?php
                                        $mm = session()->get('logged_in_mm');
                                        $qc = session()->get('logged_in_qc');
                                        if (isset($mm)) {
                                            echo '
                                            <input style="text-align:center; font-weight:bold; width:70%" type="text" class="form-control" id="fill_ip" placeholder="Filter IP" autofocus><br>
                                            <input type="reset" style="text-align:center; font-weight:bold; width:30%" class="form-control" value="Reset Input"><br>
                                            <input style="text-align:center; font-weight:bold; width:70%" type="text" class="form-control" name="listTag" placeholder="listTag" required autocomplete="off">
                                            ';
                                        } elseif (isset($qc)) {
                                            echo '
                                            <input style="text-align:center; font-weight:bold; width:70%" type="text" class="form-control" id="fill_ip" placeholder="Filter IP" autofocus><br>
                                            <input type="reset" style="text-align:center; font-weight:bold; width:30%" class="form-control" value="Reset Input"><br>
                                            <input style="text-align:center; font-weight:bold; width:70%" type="text" class="form-control" name="listTag" placeholder="listTag" required autocomplete="off">
                                            ';
                                        } else {
                                            echo '
                                            <input style="text-align:center; font-weight:bold; width:70%" type="text" class="form-control" id="fill_ip" placeholder="Filter IP" autofocus><br>
                                            <input type="reset" style="text-align:center; font-weight:bold; width:30%" class="form-control" value="Reset Input"><br>';
                                        }
                                    ?>
                                    <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
    $mm = session()->get('logged_in_mm');
    $qc = session()->get('logged_in_qc');
    if (isset($qc)) {
        $autoVariant = 'form';
        $manualVariant = 'form';
    } elseif (isset($mm)) {
        $autoVariant = 'interactive';
        $manualVariant = 'interactive';
    } else {
        $autoVariant = 'basic';
        $manualVariant = 'basic';
    }
?>
<style>
    .blink {
        animation: blinker 1s linear 1;
        background: black;
        color: white;
    }
    @keyframes blinker {
        50% { opacity: 0; }
    }
</style>
<script>
$(document).ready(function(){
    const ip_code = document.getElementById('fill_ip');
    const baseUrl = '<?= site_url() ?>';

    function loadParking() {
        const ip = ip_code.value;
        const ipParam = ip ? '?ip=' + encodeURIComponent(ip) : '';

        $("#h").load(baseUrl + "/parking-display/A/<?= $autoVariant ?>" + ipParam);
        $("#i").load(baseUrl + "/parking-display/B/<?= $manualVariant ?>" + ipParam);
        $("#j").load(baseUrl + "/parking-display/M/form" + ipParam);
    }

    loadParking();
    setInterval(loadParking, 1000);
});
</script>
<?= $this->endSection() ?>
