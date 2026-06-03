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
        <?= $this->renderSection('content') ?>
    </div>
    
</body>

</html>

<script>
function doPrint() {
	window.print();
	window.onafterprint = function(event) {
		window.location.href = '/'
	};
}
</script>