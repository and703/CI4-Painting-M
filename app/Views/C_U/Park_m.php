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
                <div class="col-6">
                    <h5 class="card-title" style="font-size: 400%; color: #FFF017;">Park Auto</h4>
                    <div id="h" class="row row-cols-12 row-cols-xs-12 g-2 g-xs-2">
                    </div>
                </div>
                <div class="col-6">
                    <h5 class="card-title" style="font-size: 400%; color: #FFF017;">Park Manual</h4>
                    <div id="i" class="row row-cols-12 row-cols-xs-12 g-2 g-xs-2">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- validations end -->

</div>
<script>

$(document).ready(function(){
    setInterval(function(){   
        $("#h").load("../co.php?ip=");
        $("#i").load("../ci.php?ip=");
    }, 500);
});
</script>
<?= $this->endSection() ?>