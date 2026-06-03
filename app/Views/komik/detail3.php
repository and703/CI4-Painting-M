<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Painting Tag</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="stylesheet" href="/assets/css/pages/error.css">
    <link rel="shortcut icon" href="/assets/images/Pirelli_PZero.png" type="image/x-icon">
</head>

<body onload="doPrint(); return false;" style="background-color: #fff;">
  <div id="error">
    <script src="/js/qrcode.js"></script>
    <div class="error-page">
        <div class="row" align="left">
            <div class="col-md-12">
                <div class="text-left">
                    <form id="reprint" action="/komik/get/<?= $komik['id']; ?>" method="post" enctype="multipart/form-data">
                    <?php
                        $count = $komik['Count_Printed']+1;
                    ?>
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                        <input type="hidden" name="Count_Printed" value="<?= $count; ?>">
                        <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1" />
                    </form>
                    <p style="font-size: 300%; color: #000; font-weight:bold; margin-bottom: 0px;"><?= $komik['MAT_DESC'];?></p>
                    <p style="font-size: 400%; color: #000; font-weight:bold; margin-bottom: 0px;">IP:<?= $komik['MAT_IP_CODE'];?>(<?= $komik['Amount'];?> Pcs) <?= $komik['MCH'];?></p>
                    <p style="font-size: 250%; color: #000; font-weight:bold;margin-bottom: 0px;">Date Rel:<?= $komik['On_Insert'];?></p>
                    <p style="font-size: 250%; color: #000;margin-bottom: 0px;"><?= $komik['WM_NAME_WM_SURNAME'];?></p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="text-left">
                    <p style="font-size: 250%; color: #000;margin-bottom: 0px;">GROUP: <?= $komik['WM_GROUP'];?></p>
                    <p style="font-size: 250%; color: #000;margin-bottom: 0px;">SHIFT: <?= $komik['WM_SHIFT'];?></p>
                    <p style="font-size: 450%; font-weight:bold; color: #000;margin-bottom: 0px;"><?= $komik['Park'];?></p>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="text-center">
                    <br>
                    <div id="qrcode"></div>
					<div class="text-left">
						<p style="font-size: 250%; color: #000;margin-bottom: 0px;">,,,,<?= $komik['id'];?></p>
					</div>
                    <?php
                        $Qr = $komik['MAT_IP_CODE'].','.$komik['Amount'].','.$komik['On_Insert'].','.$komik['WM_CODE'].','.$komik['id'];
                    ?>
                    <script type="text/javascript">
                    var qrcode = new QRCode(document.getElementById("qrcode"), {
                        text: "<?= $Qr?>",
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
                    <p style="font-size: 250%; color: #000; font-weight:bold;margin-bottom: 0px;">CURE AFTER : <?= $komik['CURE_TIME'];?></p>
                    <?php
                        date_default_timezone_set("Asia/Bangkok");
                        $Date1 = $komik['On_Insert'];
                        $text1 = str_replace('/', '-', $Date1);
                        $text2 = str_replace('.', ':', $text1);
                        $date = new DateTime($text2);
                        $date->add(new DateInterval('P5D')); // P1D means a period of 1 day
                        $Date2 = $date->format('d/m/Y H.i');
                    ?>
                    <p style="font-size: 250%; color: #000; font-weight:bold;margin-bottom: 0px;">Expired AFTER : <?= $Date2;?></p>
                </div>
            </div>
        </div>
    </div>
  </div>
    
</body>

</html>

<script>
function doPrint() {
  window.print();
  window.onafterprint = function(event) {
    document.getElementById("reprint").submit();
  };
}
</script>