<?= $this->extend('layouts/error') ?>

<?= $this->section('content') ?>

<script src="/assets/js/extensions/qrcode.js"></script>
<div class="error-page container">
    <div class="row" align="left">
        <div class="col-md-12">
            <div class="text-left">
                <p style="font-size: 250%; color: #000; font-weight:bold; margin-bottom: 0px;"><?= $painting->MAT_DESC;?></p>
                <p style="font-size: 250%; color: #000; font-weight:bold; margin-bottom: 0px;">IP:<?= $painting->MAT_IP_CODE;?>(<?= $painting->Amount;?> Pcs) <?= $painting->MCH;?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-left">
                <p style="font-size: 200%; color: #000; font-weight:bold;margin-bottom: 0px;">Date Rel:<?= $painting->On_Insert;?></p>
                <p style="font-size: 200%; color: #000;margin-bottom: 0px;"><?= $painting->WM_NAME_WM_SURNAME;?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-left">
                <br>
                <div id="qrcode"></div>
                <?php
                    $Qr = $painting->MAT_IP_CODE.', '.$painting->Amount.', '.$painting->On_Insert.', '.$painting->WM_CODE;
                ?>
                <script type="text/javascript">
                var qrcode = new QRCode(document.getElementById("qrcode"), {
                    text: "<?php echo $Qr;?>",
                    width: 400,
                    height: 400,
                    colorDark : "#000000",
                    colorLight : "#ffffff",
                    correctLevel : QRCode.CorrectLevel.H
                });
                </script>
                <br>
            </div>
        </div>
        <div class="col-md-4">
        </div>
        <div class="col-md-12">
            <div class="text-left">
                <p style="font-size: 250%; color: #000; font-weight:bold;margin-bottom: 0px;">CURE AFTER : <?= $painting->CURE_TIME;?></p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
