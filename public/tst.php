<?php
	include 'conn.php';

	$sql1 = "SELECT MAT_IP_CODE, Parked, Buffer, Total,
				GROUP_CONCAT(Park SEPARATOR ', ') as Park 
				from park_stock
			group by MAT_IP_CODE
			order by Total ";
	$result1 = $conn->query($sql1);
	while($row1 = $result1->fetch_assoc()) {
		$tsql = "SELECT
					DISTINCT de.MCH_CODE, mmc.MCH_DESC, 
					mm.MAT_CODE, de.EVS_MCH_SIDE 
				FROM PCS.dbo.DC_EVENTS de, 
						PCS.dbo.MD_MATERIALS mm, 
						PCS.dbo.MD_MACHINES mmc
				WHERE CONVERT(VARCHAR(10),de.EVS_START,101) = CONVERT(VARCHAR(10),GETDATE(),101)
					AND mmc.PP_CODE IN ( 'V01', 'B02')
					AND de.MAT_SAP_CODE = mm.MAT_SAP_CODE 
					AND de.MCH_CODE = mmc.MCH_CODE
					AND mm.MAT_CODE = '".$row1['MAT_IP_CODE']."'";  
?>
		<div class="col" >
			<div class="card rounded-pill shadow-sm">
				<div class="card-header py-1" style="background-color: #000000; padding-left: 0px;">
					<div class="progress" style="height: 75px;">
						<div class="progress-bar bg-dark" role="progressbar" style="font-size: 500%; width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="<?= $row1['Total'];?>">IP : <?= $row1['MAT_IP_CODE'];?></div>
						<div class="progress-bar bg-warning" role="progressbar" style="font-size: 500%; color: #000000; width: <?= (($row1['Parked']/$row1['Total'])*100)+2;?>%;" aria-valuenow="<?= $row1['Parked']+2;?>" aria-valuemin="0" aria-valuemax="<?= $row1['Total'];?>"><?= $row1['Parked'];?></div>
						<?php if($row1['Parked'] == '' || $row1['Buffer'] == ''){

						}else{
						?>
							<div class="progress-bar bg-dark" role="progressbar" style="font-size: 100%; width: 1%;" aria-valuenow="1" aria-valuemin="0" aria-valuemax="<?= $row1['Total'];?>"> </div>
						<?php
						}?>
						<div class="progress-bar bg-warning" role="progressbar" style="font-size: 500%; color: #000000; width: <?= (($row1['Buffer']/$row1['Total'])*100)+2;?>%;" aria-valuenow="<?= $row1['Buffer']+2;?>" aria-valuemin="0" aria-valuemax="<?= $row1['Total'];?>"><?= $row1['Buffer'];?></div>
						<div class="progress-bar bg-dark" role="progressbar" style="font-size: 500%; width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="<?= $row1['Total'];?>">TOTAL : <?= $row1['Total'];?></div>
					</div>
					<h1 class="card-title pricing-card-title" style="font-size: 250%; padding-left: 0px; text-align: left;"> PARK :
						<?= $row1['Park'];?>, Machine : 
						<?php
							$stmt = sqlsrv_query( $conn1, $tsql );
							while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
								if ($row['EVS_MCH_SIDE'] == 'S'){
									echo preg_replace("/(?![A-Z0-9])./", "", $row['MCH_DESC']) . ", ";
								}else{
									echo trim($row['MCH_DESC'], "Press ") . "(".$row['EVS_MCH_SIDE']."), ";
								}
							}
						?>
					</h1>
				</div>
				<div class="card-footer py-1" style="background-color: #000000; border-top-width: 0px;"></div> 
			</div>
		</div>
<?php
	}
?>