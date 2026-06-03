<style>
	.blink {
		animation: blinker 1s linear 1;
		background: black;
		color: white;
	}

	@keyframes blinker {
		50% {
			opacity: 0;
		}
	}
</style>
<?php
include 'conn.php';

		if(! $_GET['ip'] == ''){
			$blink="blink";
			$ip = $_GET['ip']; 
			$sql = "SELECT 
						row_number() over (order by id) as No, fp.*
					FROM pcs.fifo_park_b fp
					where fp.MAT_IP_CODE = ".$ip."";
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc()) {
				$dateCure = date_create_from_format('d/m/Y H.i', $row['CURE_TIME'])->format("Y-m-d H:i");
				$timeCure = date_create_from_format('d/m/Y H.i', $row['CURE_TIME'])->format("H:i");
				$dateprint = date_create_from_format('d/m/Y H.i', $row['On_Insert'])->format("Y-m-d H:i");
				$dateNow =  date_create()->format('Y-m-d H:i');
				$dateExp = date("Y-m-d H:i", strtotime("+120 hours $dateprint"));
				if(strtotime($dateNow) <= strtotime($dateCure)){
?>
					<div class="col" >
						<div class="card rounded-pill shadow-sm">
							<div class="card-header py-1 <?= $blink?>" style="background-color: #dc3545; padding-left: 0px;"></div>
							<div class="card-body <?= $blink?>" style="background-color: #dc3545; padding-left: 30px;padding-right: 30px;">
								<h1 class="card-title pricing-card-title" style="font-size: 150%; padding-left: 0px;"><?= $row['slot'];?></h1>
								<ul class="list-unstyled" style="margin-bottom: 0px; font-weight:bold; font-size: 100%;">
									<li><?= $row['MAT_IP_CODE'];?></li>
								</ul>
								<ul class="list-unstyled" style="margin-bottom: 0px;font-size: 100%;">
									<li><?= $row['Amount'];?></li>
								</ul>
								<ul class="list-unstyled" style="margin-bottom: 0px;font-size: 150%;">
									<li><?= $timeCure;?></li>
								</ul>
							</div>
							<div class="card-footer py-1 <?= $blink?>" style="background-color: #dc3545; border-top-width: 0px;"></div> 
						</div>
					</div>
<?php
					$blink="";
				}elseif(strtotime($dateNow) >= strtotime($dateExp)){
?>
					<div class="col" >
						<div class="card rounded-pill shadow-sm">
							<div class="card-header py-1 <?= $blink?>" style="background-color: #c617ff; padding-left: 0px;"></div>
							<div class="card-body <?= $blink?>" style="background-color: #c617ff; padding-left: 30px;padding-right: 30px;">
								<h1 class="card-title pricing-card-title" style="font-size: 150%; padding-left: 0px;"><?= $row['slot'];?></h1>
								<ul class="list-unstyled" style="margin-bottom: 0px; font-weight:bold; font-size: 100%;">
									<li><?= $row['MAT_IP_CODE'];?></li>
								</ul>
								<ul class="list-unstyled" style="margin-bottom: 0px;font-size: 100%;">
									<li><?= $row['Amount'];?></li>
								</ul>
								<ul class="list-unstyled" style="margin-bottom: 0px;font-size: 150%;">
									<li><?= $timeCure;?></li>
								</ul>
							</div>
							<div class="card-footer py-1 <?= $blink?>" style="background-color: #c617ff; border-top-width: 0px;"></div>
						</div>
					</div>
<?php
					$blink="";
				}else{
?>
					<div class="col" >
						<div class="card rounded-pill shadow-sm">
							<div class="card-header py-1 <?= $blink?>" style="background-color: #ffc107; padding-left: 0px;"></div>
							<div class="card-body <?= $blink?>" style="background-color: #ffc107; padding-left: 30px;padding-right: 30px;">
								<h1 class="card-title pricing-card-title" style="font-size: 150%; padding-left: 0px;"><?= $row['slot'];?></h1>
								<ul class="list-unstyled" style="margin-bottom: 0px; font-weight:bold; font-size: 100%;">
									<li><?= $row['MAT_IP_CODE'];?></li>
								</ul>
								<ul class="list-unstyled" style="margin-bottom: 0px;font-size: 100%;">
									<li><?= $row['Amount'];?></li>
								</ul>
								<ul class="list-unstyled" style="margin-bottom: 0px;font-size: 150%;">
									<li><?= $timeCure;?></li>
								</ul>
							</div>
							<div class="card-footer py-1 <?= $blink?>" style="background-color: #ffc107; border-top-width: 0px;"></div>
						</div>
					</div>
<?php
					$blink="";
				}
			}
		}else{
			$sql1 = "SELECT * FROM parking_b ORDER BY id ASC";
			$result1 = $conn->query($sql1);
			while($row1 = $result1->fetch_assoc()) {
				if(! $row1['id_paint'] == 0){
					$sql = "SELECT *  FROM painting WHERE id = ".$row1['id_paint']." ORDER BY id ASC ";
					$result = $conn->query($sql);
					while($row = $result->fetch_assoc()) {
						$dateCure = date_create_from_format('d/m/Y H.i', $row['CURE_TIME'])->format("Y-m-d H:i");
						$timeCure = date_create_from_format('d/m/Y H.i', $row['CURE_TIME'])->format("H:i");
						$dateprint = date_create_from_format('d/m/Y H.i', $row['On_Insert'])->format("Y-m-d H:i");
						$dateNow =  date_create()->format('Y-m-d H:i');
						$dateExp = date("Y-m-d H:i", strtotime("+120 hours $dateprint"));
						if(strtotime($dateNow) <= strtotime($dateCure)){
?>
							<div class="col" >
								<div class="card rounded-pill shadow-sm">
									<div class="card-header py-1" style="background-color: #dc3545; padding-left: 0px;"></div>
									<div class="card-body" style="background-color: #dc3545; padding-left: 30px; padding-right: 30px;">
										<h1 class="card-title pricing-card-title" style="font-size: 150%;padding-left: 0px;"><?= $row1['slot'];?></h1>
										<ul class="list-unstyled" style="margin-bottom: 0px; font-weight:bold; font-size: 100%;">
											<li><?= $row['MAT_IP_CODE'];?></li>
										</ul>
										<ul class="list-unstyled" style="margin-bottom: 0px;font-size: 100%;">
											<li><?= $row['Amount'];?></li>
										</ul>
										<ul class="list-unstyled" style="margin-bottom: 0px;font-size: 150%;">
											<li><?= $timeCure;?></li>
										</ul>
									</div>
									<div class="card-footer py-1" style="background-color: #dc3545; border-top-width: 0px;"></div>
								</div>
							</div>
<?php
						}elseif(strtotime($dateNow) >= strtotime($dateExp)){
?>
							<div class="col" >
								<div class="card rounded-pill shadow-sm">
									<div class="card-header py-1" style="background-color: #c617ff; padding-left: 0px;"></div>
									<div class="card-body" style="background-color: #c617ff; padding-left: 30px;padding-right: 30px;">
										<h1 class="card-title pricing-card-title" style="font-size: 150%; padding-left: 0px;"><?= $row1['slot'];?></h1>
										<ul class="list-unstyled" style="margin-bottom: 0px; font-weight:bold; font-size: 100%;">
											<li><?= $row['MAT_IP_CODE'];?></li>
										</ul>
										<ul class="list-unstyled" style="margin-bottom: 0px;font-size: 100%;">
											<li><?= $row['Amount'];?></li>
										</ul>
										<ul class="list-unstyled" style="margin-bottom: 0px;font-size: 150%;">
											<li><?= $timeCure;?></li>
										</ul>
									</div>
									<div class="card-footer py-1" style="background-color: #c617ff; border-top-width: 0px;"></div>
								</div>
							</div>
<?php
						}elseif($row['MAT_IP_CODE'] == 1){
?>
							<div class="col" >
								<div class="card rounded-pill shadow-sm">
									<div class="card-header py-1" style="background-color: #c617ff; padding-left: 0px;"></div>
									<div class="card-body" style="background-color: #c617ff; padding-left: 30px;padding-right: 30px;">
										<h1 class="card-title pricing-card-title" style="font-size: 150%; padding-left: 0px;"><?= $row1['slot'];?></h1>
										<ul class="list-unstyled" style="margin-bottom: 0px; font-weight:bold; font-size: 100%;">
											<li><?= $row['MAT_IP_CODE'];?></li>
										</ul>
										<ul class="list-unstyled" style="margin-bottom: 0px;font-size: 100%;">
											<li><?= $row['Amount'];?></li>
										</ul>
										<ul class="list-unstyled" style="margin-bottom: 0px;font-size: 150%;">
											<li><?= $timeCure;?></li>
										</ul>
									</div>
									<div class="card-footer py-1" style="background-color: #c617ff; border-top-width: 0px;"></div>
								</div>
							</div>
<?php
						}else{
?>
							<div class="col" >
								<div class="card rounded-pill shadow-sm">
									<div class="card-header py-1" style="background-color: #ffc107; padding-left: 0px;"></div>
									<div class="card-body" style="background-color: #ffc107; padding-left: 30px;padding-right: 30px;">
										<h1 class="card-title pricing-card-title" style="font-size: 150%; padding-left: 0px;"><?= $row1['slot'];?></h1>
										<ul class="list-unstyled" style="margin-bottom: 0px; font-weight:bold; font-size: 100%;">
											<li><?= $row['MAT_IP_CODE'];?></li>
										</ul>
										<ul class="list-unstyled" style="margin-bottom: 0px; font-size: 100%;">
											<li><?= $row['Amount'];?></li>
										</ul>
										<ul class="list-unstyled" style="margin-bottom: 0px; font-size: 150%;">
											<li><?= $timeCure;?></li>
										</ul>
									</div>
									<div class="card-footer py-1" style="background-color: #ffc107; border-top-width: 0px;"></div>
								</div>
							</div>
<?php
						}
					}
				}else{
?>
					<div class="col">
						<div class="card rounded-pill shadow-sm">
							<div class="card-header py-1" style="background-color: #34a11d;"></div>
							<div class="card-body" style="background-color: #34a11d; padding-left: 30px; padding-right: 30px;">
								<h1 class="card-title pricing-card-title" style="font-size: 150%;"><?= $row1['slot'];?></h1>
								<ul class="list-unstyled" style="margin-bottom: 92px;">
									<li></li>
								</ul>
							</div>
							<div class="card-footer py-1" style="margin-top: 0px; background-color: #34a11d; border-top-width: 0px;"></div>
						</div>
					</div>
<?php
				}
			}
		}
?>