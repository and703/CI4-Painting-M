<?php
    //header("Refresh:600");
?>
<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<br>
<div style="zoom:40%;" class="page-heading">
    <!-- validations start -->
    <section id="input-validation" align="center">
        <div class="row">
            <div class="col-12">
                <h5 class="card-title" style="font-size: 600%; color: #FFF017;">GT STOCK SUPERMARKET AFTER BOIACCA</h4>
                <div id="h" class="row row-cols-4 row-cols-xs-12 g-2 g-xs-2" align="center">
                </div>
            </div>
        </div>
    </section>
    <!-- validations end -->

</div>
<?php 
    $tst = 'tst';
?>
<script>
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if(this.readyState === 4){
            document.getElementById('h').innerHTML = this.responseText;
        } else {
            document.getElementById('h').innerHTML = '<div class="text-center"><div class="spinner-border text-warning" style="width: 10rem; height: 10rem;" role="status"><span class="visually-hidden"></span></div></div><div class="text-center"><div class="spinner-border text-warning" style="width: 10rem; height: 10rem;" role="status"><span class="visually-hidden"></span></div></div><div class="text-center"><div class="spinner-border text-warning" style="width: 10rem; height: 10rem;" role="status"><span class="visually-hidden"></span></div></div><div class="text-center"><div class="spinner-border text-warning" style="width: 10rem; height: 10rem;" role="status"><span class="visually-hidden"></span></div></div>';
        }
    }
    xhr.open('GET', '../<?= $tst?>.php', true);
    xhr.send();
    setInterval(function(){   
        $("#h").load("../<?= $tst?>.php");
    }, 60000);
</script>
<?= $this->endSection() ?>