<?php
    header("Refresh:600");
?>
<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<br>  
<style>
    .loader {
      width: 60px;
      height: 60px;
      background: transparent;
      border: 10px solid transparent;
      border-top-color: #f56;
      border-left-color: #f56;
      border-radius: 50%;
      animation: loader .75s 10 ease forwards;
    }

    @keyframes loader {
      100% {
        transform: rotate(360deg);
      }
    }
</style>	
<div class="page-heading">
    <!-- validations start -->
    <section id="input-validation" align="center">
        <div class="">
            <div class="row">
                <div class="col-2">
                    <div class="row">
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;">
                            <?php 
                                $wm = session()->get('logged_in_wm');
                                if(isset($wm)){
                                    echo '<a href="worker/logout_CURE" class="btn btn-danger" >Logout</a>';
                                }else{
                                    echo '<a href="/cure" class="btn btn-success" >Login</a>';
                                }
                            ?>
                        </h5>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><?= session()->get('MM_CODE');?></h5>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><?= session()->get('MM_NAME')." ".session()->get('MM_SURNAME');?></h5>
                        <h5 class="card-title" style="font-size: 100%; color: #FFF;"><br></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h5 class="card-title" style="font-size: 400%; color: #FFF017;">Park Buffer Curring</h4>
                        <div id="h" class="row row-cols-12 row-cols-xs-12 g-2 g-xs-2">
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
        $co = 'pbc3';
    }elseif(isset($mm) && $MM_CODE == 'irhamkh002'){
        $co = 'pbc2';
    }else{
        $co = 'pbc';
    }
?>
<script>
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if(this.readyState === 4){
            document.getElementById('h').innerHTML = this.responseText;
        } else {
            document.getElementById('h').innerHTML = '<div class="text-center"><div class="spinner-border text-warning" style="width: 10rem; height: 10rem;" role="status"><span class="visually-hidden"></span></div></div>';
        }
    }
    xhr.open('GET', '../<?= $co?>.php', true);
    xhr.send();
    setInterval(function(){   
        $("#h").load("../<?= $co?>.php");
    }, 500);
</script>
<?= $this->endSection() ?>