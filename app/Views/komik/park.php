<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<a href="worker/logout_MM" class="btn btn-success">LOGOUT</a>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-2">Daftar Reprint</h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
              <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
              </div>
            <?php endif;  ?>
          <table class="table" style="color: #fff;">
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($komik as $k) : {
                    # code...
                }?>
              <tr>
                <th scope="row"><?= $i; ?></th>
                  <td><?= $k['WM_CODE']; ?></td>
                  <td><?= $k['WM_NAME_WM_SURNAME']; ?></td>
                  <td><?= $k['MCH']; ?></td>
                  <td><?= $k['MAT_IP_CODE']; ?></td>
                  <td><?= $k['MAT_DESC']; ?></td>
                  <td><?= $k['Amount']; ?></td>
                  <td><?= $k['On_Insert']; ?></td>
                  <td><?= $k['CURE_TIME']; ?></td>
                <td>
                    <a href="/komik/<?= $k['id']; ?>" class="btn btn-success" id="<?= $i++;?>">Print</a>
                </td>
              </tr>
              <?php endForeach; ?>
            </tbody>
          </table>
        </div>
    </div>
</div>
<script type="text/javascript"> 
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

          if (keysDown["1"]) {
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
        }

        window.onkeyup = function(e) {
          keysDown[e.key] = false;
        }
    </script>
<?= $this->endSection(); ?>