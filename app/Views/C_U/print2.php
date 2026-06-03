<?= $this->extend("layouts/error") ?>

<?= $this->section("content") ?>

<script src="/js/qrcode.js"></script>
<div class="error-page">
    <div class="row" align="left">
    <?= $ID ?>
        <div class="col-md-12">
            <div class="text-left">
                <p style="font-size: 300%; color: #000; font-weight:bold; margin-bottom: 0px;"><?= $painting["MAT_DESC"] ?></p>
                <p style="font-size: 300%; color: #000; font-weight:bold; margin-bottom: 0px;">IP:<?= $painting["MAT_IP_CODE"] ?>(<?= $painting["Amount"] ?> Pcs) <?= $painting["MCH"] ?></p>
                <p style="font-size: 250%; color: #000; font-weight:bold;margin-bottom: 0px;">Date Rel:<?= $painting["On_Insert"] ?></p>
                <p style="font-size: 250%; color: #000;margin-bottom: 0px;"><?= $painting["WM_NAME_WM_SURNAME"] ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-left">
                <p style="font-size: 250%; color: #000;margin-bottom: 0px;">GROUP: <?= $komik["WM_GROUP"] ?></p>
                <p style="font-size: 250%; color: #000;margin-bottom: 0px;">SHIFT: <?= $komik["WM_SHIFT"] ?></p>
                <p style="font-size: 350%; font-weight:bold; color: #000;margin-bottom: 0px;"><?= $komik["Park"] ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-center">
                <br>
                <div id="qrcode"></div>
                <?php $Qr =
                    $painting["MAT_IP_CODE"] .
                    "," .
                    $painting["Amount"] .
                    "," .
                    $painting["On_Insert"] .
                    "," .
                    $painting["WM_CODE"] .
                    "," .
                    $painting["id"]; 
                ?>
                <script type="text/javascript">
                var qrcode = new QRCode(document.getElementById("qrcode"), {
                    text: "<?php echo $Qr; ?>",
                    width: 250,
                    height: 250,
                    colorDark : "#000000",
                    colorLight : "#ffffff",
                    correctLevel : QRCode.CorrectLevel.H
                });
                </script>
                <br>
            </div>
        </div>
        <div class="col-md-12">
            <div class="text-left">
                <p style="font-size: 300%; color: #000; font-weight:bold;margin-bottom: 0px;">CURE AFTER : <?= $painting["CURE_TIME"] ?></p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
