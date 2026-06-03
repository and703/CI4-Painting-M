<?php
	include './conn.php';
	$s_keyword="";
	if (isset($_POST['keyword'])) {
		$s_keyword = $_POST['keyword'];
	}
	
	$no = 1;
	$query = "SELECT * FROM ip_outside WHERE IP_CODE =? AND is_active ='1'";
	$dewan1 = $db1->prepare($query);
	$dewan1->bind_param('s', $s_keyword);
	$dewan1->execute();
	$res1 = $dewan1->get_result();

	if ($res1->num_rows > 0) {
		while ($row = $res1->fetch_assoc()) {
			if($row['CAT_IP'] == '0'){
				echo '<h5 class="card-title" style="font-size: 400%; color: #FFF017;">Outside Process</h4>
				<input type="hidden" name="mch" value="M1">';
			}elseif($row['CAT_IP'] == '1'){
				echo '<h5 class="card-title" style="font-size: 400%; color: #FFF017;">Inside Process</h4>
				<input type="hidden" name="mch" value="M2">';
			}elseif($row['CAT_IP'] == '2'){
				echo '<h5 class="card-title" style="font-size: 400%; color: #FFF017;">Outside+Inside Process</h4>
				<input type="hidden" name="mch" value="M3">';
			}elseif($row['CAT_IP'] == '3'){
				echo '<h5 class="card-title" style="font-size: 400%; color: #FFF017;">Auto Process MCH 1</h4>
				<input type="hidden" name="mch" value="A1">';
			}
		} 
	}
?>