<?php
	$dateCure = date_create_from_format("d/m/Y H.i", '26/01/2022 19.09')->format("Y-m-d H:i");
	$dateNow =  date_create()->format('Y-m-d H:i');
	
echo strtotime($dateCure);
echo '<br>';
echo strtotime($dateNow);
echo '<br>';
echo $dateNow;