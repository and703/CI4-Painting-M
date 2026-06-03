
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Painting Tag</title>

    <!--<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="/assets/css/bootstrap.css">

    <link rel="stylesheet" href="/assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/app.css">
    <?= $this->renderSection('styles') ?>
    <link rel="shortcut icon" href="/assets/images/Pirelli_PZero.png" type="image/x-icon">
    <script src="/assets/vendors/jquery/jquery.min.js"></script>
    
    <script type="text/javascript"> 
        function display_c(){
        var refresh=1000; // Refresh rate in milli seconds
        mytime=setTimeout('display_ct()',refresh)
        }

        function display_ct() {
        var x = new Date()
        document.getElementById('ct').innerHTML = x;
        document.getElementById('ct').style.fontSize='20px';
        document.getElementById('ct').style.color='#FFF017';
        display_c();
        }
    </script>

    <script type="text/javascript"> 
        function reprint() {
            document.getElementById("+").click();
        }
        function Func2() {
            document.getElementById(".").click();
        }
        function Func3() {
            document.getElementById("-").click();
        }

        let keysDown = {};
        window.onkeydown = function(e) {
            keysDown[e.key] = true;

            if (keysDown["+"]) {
                reprint();
                console.log("+");
            }
            else if(keysDown["."] ){
                Func2();
                console.log(".");
            }
            else if(keysDown["-"] ){
                Func3();
                console.log("-");
            }
        }

        window.onkeyup = function(e) {
        keysDown[e.key] = false;
        }
    </script>
</head>

<body onload=display_ct();>
<a href="/park_view" id="."></a>
<a href="/worker/logout_WM" id="-"></a>
<a href="/reprint" id="+"></a>
    <div id="app">
        <!-- Main -->
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-end" style="padding-right: 10px;">
                        <span id='ct'></span>
                    </div>
                </div>
            </footer>
        <div id="main" style="padding-top: 0px;padding-bottom: 0px;">
            <!-- Content -->
            <?= $this->renderSection('content') ?>
            <!-- End Content -->
            
            <!-- Footer -->
            <?= $this->include('layouts/footer') ?>
            <!-- End Footer -->
        </div>
        <!-- End Main -->
    </div>

    <script src="/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <?php 
    if($title == "Stock_Total" || $title == "Stock_View"){
    ?>
    <?php }else{
    ?>
    <script src="/js/autoRef.js"></script>
    <?php
    }?>
    <?= $this->renderSection('javascript') ?>
</body>
</html>
