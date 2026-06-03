<?php
    header("Refresh:600");
?>
<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<br>
<div class="page-heading">
    <!-- validations start -->
    <section id="input-validation" align="center">
        <div class="">
            <div class="row">
                <div class="col-2">
                    <div class="row">
                        <?php 
                            $mm = session()->get('logged_in_mm');
                            $qc = session()->get('logged_in_qc');
                            if(isset($mm)){
                                echo '<a href="worker/logout_MM" class="btn btn-danger" >Logout</a>';
                            }elseif(isset($qc)){
                                echo '<a href="worker/logout_MM" class="btn btn-danger" >Logout</a>';
                            }else{
                                echo '<a href="parking" class="btn btn-success" >Login</a>';
                            }
                        ?>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><?= session()->get('MM_CODE');?></h5>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><?= session()->get('MM_NAME')." ".session()->get('MM_SURNAME');?></h5>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h5 class="card-title" style="font-size: 400%; color: #FFF017;">Park Auto</h4>
                        <div id="h" class="row row-cols-12 row-cols-xs-12 g-2 g-xs-2">
                        </div>
                    </div>
                    <div class="col-6">
<<<<<<< HEAD
                        <h5 class="card-title" style="font-size: 400%; color: #FFF017;">Temp Park Manual</h4>
                        <div id="i" class="row row-cols-12 row-cols-xs-12 g-2 g-xs-2">
                        </div>
                        <h5 class="card-title" style="font-size: 400%; color: #FFF017;">Park Manual</h4>
                        <div id="j" class="row row-cols-12 row-cols-xs-12 g-2 g-xs-2">
=======
                        <h5 class="card-title" style="font-size: 400%; color: #FFF017;">Park Manual</h4>
                        <div id="i" class="row row-cols-12 row-cols-xs-12 g-2 g-xs-2">
>>>>>>> ebb5504 (Add parking management features with dynamic updates and manual tag confirmation)
                        </div>
                    </div>
                </div>
                <div class="row" align="center">
                    <div class="col-12">
                        <div class="row">
                            <div class="row" align="left">
                            </div>
                            <h5 class="card-title" style="font-size: 200%; color: #FFF017;">SCAN TAG QRCODE</h4>
                            <div class="col-12">
                                <form action="/worker/get_tag" method="post" autocomplete="off">
                                    <?php 
                                        $mm = session()->get('logged_in_mm');
                                        $qc = session()->get('logged_in_qc');
                                        if(isset($mm)){
                                            echo '
                                            <input style="text-align:center; font-weight:bold; width:70%" type="text" class="form-control" id="fill_ip" placeholder="Filter IP" autofocus><br>
                                            <input type="reset" style="text-align:center; font-weight:bold; width:30%" class="form-control" value="Reset Input"><br>
                                            <input style="text-align:center; font-weight:bold; width:70%" type="text" class="form-control" name="listTag" placeholder="listTag" required autofocus autocomplete="off">
                                            ';
                                        }elseif(isset($qc)){
                                            echo '
                                            <input style="text-align:center; font-weight:bold; width:70%" type="text" class="form-control" id="fill_ip" placeholder="Filter IP" autofocus><br>
                                            <input type="reset" style="text-align:center; font-weight:bold; width:30%" class="form-control" value="Reset Input"><br>
                                            <input style="text-align:center; font-weight:bold; width:70%" type="text" class="form-control" name="listTag" placeholder="listTag" required autofocus autocomplete="off">
                                            ';
                                        }else{
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
    <!-- validations end -->

</div>
<?php 
    $mm = session()->get('logged_in_mm');
    $qc = session()->get('logged_in_qc');
    $MM_CODE = session()->get('MM_CODE');
    if(isset($qc)){
        $co = 'co3';
<<<<<<< HEAD
        $cb = 'cb3';
        $ci = 'ci3';
    }elseif(isset($mm) && $MM_CODE == 'irhamkh002'){
        $co = 'co2';
        $cb = 'cb2';
        $ci = 'ci2';
    }else{
        $co = 'co';
        $cb = 'cb';
=======
        $ci = 'ci3';
    }elseif(isset($mm) && $MM_CODE == 'irhamkh002'){
        $co = 'co2';
        $ci = 'ci2';
    }else{
        $co = 'co';
>>>>>>> ebb5504 (Add parking management features with dynamic updates and manual tag confirmation)
        $ci = 'ci';
    }
?>
<script>

$(document).ready(function(){  
    const ip_code = document.getElementById('fill_ip');
    setInterval(function(){   
        $("#h").load("../<?= $co?>.php?ip="+ip_code.value);
<<<<<<< HEAD
        $("#i").load("../<?= $cb?>.php?ip="+ip_code.value);
        $("#j").load("../<?= $ci?>.php?ip="+ip_code.value);
    }, 1000);
=======
        $("#i").load("../<?= $ci?>.php?ip="+ip_code.value);
    }, 500);
>>>>>>> ebb5504 (Add parking management features with dynamic updates and manual tag confirmation)
});
</script>
<?= $this->endSection() ?>