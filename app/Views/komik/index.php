<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
        
<p style="font-size: 250%; color: #FFF017; font-weight:bold; margin-bottom: 0px;">Press "+" For Painting Tag</p>
<div class="container">
    <div class="row">
        <div class="col" align="center">
        <br><br><br>
            <h1 class="mt-2" style="color: #FFF017;">Press number pad according to the serial number that will be reprinted</h1>
<!--             <?php if (session()->getFlashdata('pesan')) : ?>
              <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
              </div>
            <?php endif;  ?> -->
          <table class="table" style="color: #FFF017;">
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($komik as $k) : {
                    # code...
                }?>
              <tr>
                <th style="font-size: 200%; color: #FFF017;" scope="row"><?= $i; ?></th>
                  <td><?= $k['WM_CODE']; ?></td>
                  <td><?= $k['WM_NAME_WM_SURNAME']; ?></td>
                  <td><?= $k['MCH']; ?></td>
                  <td><?= $k['MAT_IP_CODE']; ?></td>
                  <td><?= $k['MAT_DESC']; ?></td>
                  <td><?= $k['Amount']; ?></td>
                  <td><?= $k['On_Insert']; ?></td>
                  <td><?= $k['CURE_TIME']; ?></td>
                <td>
                    <a href="/re_print/<?= $k['id']; ?>" id="<?= $i++;?>"></a>
                </td>
              </tr>
              <?php endForeach; ?>
            </tbody>
          </table>
        <br><br><br>
        </div>
    </div>
</div>
<script type="text/javascript"> 
        function reprint() {
            document.getElementById("+").click();
        }
        function worker() {
            document.getElementById("-").click();
        }
        function park() {
            document.getElementById(".").click();
        }
        function print1() {
            document.getElementById("1").click();
        }
        function print2() {
            document.getElementById("2").click();
        }
        function print3() {
            document.getElementById("3").click();
        }
        function print4() {
            document.getElementById("4").click();
        }
        function print5() {
            document.getElementById("5").click();
        }

        let keysDown = {};
        window.onkeydown = function(e) {
          keysDown[e.key] = true;

          if (keysDown["+"]) {
              reprint();
              console.log("+");
          }
          else if (keysDown["1"]) {
              print1();
              console.log("1");
          }
          else if(keysDown["2"] ){
              print2();
              console.log("2");
          }
          else if(keysDown["3"] ){
              print3();
              console.log("3");
          }
          else if(keysDown["4"] ){
              print4();
              console.log("4");
          }
          else if(keysDown["5"] ){
              print5();
              console.log("5");
          }
          else if(keysDown["-"] ){
              worker();
              console.log("-");
          }
          else if(keysDown["."] ){
              park();
              console.log(".");
          }
        }

        window.onkeyup = function(e) {
          keysDown[e.key] = false;
        }
    </script>
<?= $this->endSection(); ?>