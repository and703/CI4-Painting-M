<?php
include 'conn.php';

	$sql1 = "SELECT MAT_IP_CODE,
				Total 
			FROM stock_rank
				limit 12";
	$result1 = $conn->query($sql1);
	while($row1 = $result1->fetch_assoc()) {
		if($row1['Total'] <= '15'){
?>
			<div class="col" >
				<div class="card rounded-pill shadow-sm">
					<div class="card-header py-1" style="background-color: #dc3545; padding-left: 0px;">
						<h1 class="card-title pricing-card-title" style="font-size: 250%; padding-left: 0px;"><?= $row1['MAT_IP_CODE'];?></h1>
						<h1 class="card-title pricing-card-title" style="font-size: 200%; padding-left: 0px;">STOCK : <?= $row1['Total'];?></h1>
					</div>
					<div class="card-body flex-fill" style="background-color: purple; padding-left: 30px;padding-right: 30px;">
						<h1 class="card-title pricing-card-title" style="font-size: 200%; padding-left: 0px;"></h1>
						<div class="row row-cols-1 row-cols-xs-1 g-2 g-xs-2">
							<h1 class="card-title pricing-card-title" style="font-size: 150%; padding-left: 0px; padding-bottom: 10px;">PARK :
							<?php
								$sql2 = "SELECT MCH, MAT_IP_CODE, Park
								FROM pcs.parking_view
								where MAT_IP_CODE = '".$row1['MAT_IP_CODE']."'";
								$result2 = $conn->query($sql2);
								while($row2 = $result2->fetch_assoc()) {
									if($row2){
										echo $row2['Park'].", ";
									}
								}
							?>
							</h1>
							<h1 class="card-title pricing-card-title" style="font-size: 150%; padding-left: 0px;">CURR : </h1>
							<h1 class="card-title pricing-card-title" style="font-size: 150%; padding-left: 0px; padding-bottom: 20px;">
							<?php
								$tsql = "SELECT
											DISTINCT de.MCH_CODE, mmc.MCH_DESC, 
											mm.MAT_CODE, de.EVS_MCH_SIDE 
										FROM PCS.dbo.DC_EVENTS de, 
												PCS.dbo.MD_MATERIALS mm, 
												PCS.dbo.MD_MACHINES mmc
										WHERE CONVERT(VARCHAR(10),de.EVS_START,101) = CONVERT(VARCHAR(10),GETDATE(),101)
											AND de.MAT_SAP_CODE = mm.MAT_SAP_CODE 
											AND de.MCH_CODE = mmc.MCH_CODE
											AND mmc.PP_CODE = 'V01'
											AND mm.MAT_CODE = '".$row1['MAT_IP_CODE']."'";  

								$stmt = sqlsrv_query( $conn1, $tsql );
								/* Execute the query. */
								if( $stmt === false) {
									die( print_r( sqlsrv_errors(), true) );
								}
								while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
								echo $row['MCH_DESC'] ."(".$row['EVS_MCH_SIDE']."), ";
								}
							?>
							</h1>
                        </div>
						<div class="row row-cols-1 row-cols-xs-1 g-2 g-xs-2">
							<h1 class="card-title pricing-card-title" style="font-size: 150%; padding-left: 0px; padding-bottom: 20px;">BUILD : 
							<?php
								$tsql = "SELECT
											DISTINCT de.MCH_CODE, mmc.MCH_DESC, 
											mm.MAT_CODE
										FROM PCS.dbo.DC_EVENTS de, 
												PCS.dbo.MD_MATERIALS mm, 
												PCS.dbo.MD_MACHINES mmc
										WHERE CONVERT(VARCHAR(10),de.EVS_START,101) = CONVERT(VARCHAR(10),GETDATE(),101)
											AND de.MAT_SAP_CODE = mm.MAT_SAP_CODE 
											AND de.MCH_CODE = mmc.MCH_CODE
											AND mmc.PP_CODE = 'B02'
											AND mm.MAT_CODE = '".$row1['MAT_IP_CODE']."'";  

								$stmt = sqlsrv_query( $conn1, $tsql );
								/* Execute the query. */
								if( $stmt === false) {
									die( print_r( sqlsrv_errors(), true) );
								}
								while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
									echo $row['MCH_DESC'].", ";
								}
							?>
							</h1>
							<?php
								$sql3 = "SELECT *
											FROM buff_stock
											where MAT_IP_CODE = '".$row1['MAT_IP_CODE']."'";
								$result3 = $conn->query($sql3);
								$row3 = $result3->fetch_assoc();
								if($row3){
									$Total = $row3['Total'];
								}else{
									$Total = 0;
								}
							?>
							<div class="progress" style="height: 75px;">
								<div class="progress-bar bg-warning" role="progressbar" style="font-size: 500%; width: <?= ($row1['Total']/($row1['Total']+$Total))*100;?>%;" aria-valuenow="<?= $row1['Total'];?>" aria-valuemin="0" aria-valuemax="<?= $row1['Total']+$Total;?>"><?= $row1['Total'];?></div>
								<div class="progress-bar bg-info" role="progressbar" style="font-size: 500%; width: <?= ($Total/($row1['Total']+$Total))*100;?>%;" aria-valuenow="<?= $Total;?>" aria-valuemin="0" aria-valuemax="<?= $row1['Total']+$Total;?>"><?= $Total;?></div>
							</div>
                        </div>
					</div>
					<div class="card-footer py-1" style="background-color: purple; border-top-width: 0px;"></div> 
				</div>
			</div>
<?php
		}else{
?>
			<div class="col" >
				<div class="card rounded-pill shadow-sm">
					<div class="card-header py-1" style="background-color: #e3cc00; padding-left: 0px;">
						<h2 class="card-title pricing-card-title" style="font-size: 250%; padding-left: 0px; color: #000000;"><?= $row1['MAT_IP_CODE'];?></h2>
						<h2 class="card-title pricing-card-title" style="font-size: 200%; padding-left: 0px; color: #000000;">STOCK : <?= $row1['Total'];?></h2>
					</div>
					<div class="card-body flex-fill" style="background-color: purple; padding-left: 30px;padding-right: 30px;">
						<h2 class="card-title pricing-card-title" style="font-size: 200%; padding-left: 0px;"></h2>
						<div class="row row-cols-1 row-cols-xs-1 g-2 g-xs-2">
							<h2 class="card-title pricing-card-title" style="font-size: 150%; padding-left: 0px; padding-bottom: 10px;">PARK :
							<?php
								$sql2 = "SELECT MCH, MAT_IP_CODE, Park
								FROM pcs.parking_view
								where MAT_IP_CODE = '".$row1['MAT_IP_CODE']."'";
								$result2 = $conn->query($sql2);
								while($row2 = $result2->fetch_assoc()) {
									if($row2){
										echo $row2['Park'].", ";
									}
								}
							?>
							</h2>
                        </div>
						<div class="row row-cols-1 row-cols-xs-1 g-2 g-xs-2">
							<h1 class="card-title pricing-card-title" style="font-size: 150%; padding-left: 0px;">CURR : </h1>
							<h1 class="card-title pricing-card-title" style="font-size: 150%; padding-left: 0px; padding-bottom: 20px;">
							<?php
								$tsql = "SELECT
											DISTINCT de.MCH_CODE, mmc.MCH_DESC, 
											mm.MAT_CODE, de.EVS_MCH_SIDE 
										FROM PCS.dbo.DC_EVENTS de, 
												PCS.dbo.MD_MATERIALS mm, 
												PCS.dbo.MD_MACHINES mmc
										WHERE CONVERT(VARCHAR(10),de.EVS_START,101) = CONVERT(VARCHAR(10),GETDATE(),101)
											AND de.MAT_SAP_CODE = mm.MAT_SAP_CODE 
											AND de.MCH_CODE = mmc.MCH_CODE
											AND mmc.PP_CODE = 'V01'
											AND mm.MAT_CODE = '".$row1['MAT_IP_CODE']."'";  

								$stmt = sqlsrv_query( $conn1, $tsql );
								/* Execute the query. */
								if( $stmt === false) {
									die( print_r( sqlsrv_errors(), true) );
								}
								while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
								echo $row['MCH_DESC'] ."(".$row['EVS_MCH_SIDE']."), ";
								}
							?>
							
							</h1>
							<h1 class="card-title pricing-card-title" style="font-size: 150%; padding-left: 0px; padding-bottom: 20px;">BUILD : 
							<?php
								$tsql = "SELECT
											DISTINCT de.MCH_CODE, mmc.MCH_DESC, 
											mm.MAT_CODE
										FROM PCS.dbo.DC_EVENTS de, 
												PCS.dbo.MD_MATERIALS mm, 
												PCS.dbo.MD_MACHINES mmc
										WHERE CONVERT(VARCHAR(10),de.EVS_START,101) = CONVERT(VARCHAR(10),GETDATE(),101)
											AND de.MAT_SAP_CODE = mm.MAT_SAP_CODE 
											AND de.MCH_CODE = mmc.MCH_CODE
											AND mmc.PP_CODE = 'B02'
											AND mm.MAT_CODE = '".$row1['MAT_IP_CODE']."'";  

								$stmt = sqlsrv_query( $conn1, $tsql );
								/* Execute the query. */
								if( $stmt === false) {
									die( print_r( sqlsrv_errors(), true) );
								}
								while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
								echo $row['MCH_DESC'].", ";
								}
							?>
							</h1>
							<?php
								$sql3 = "SELECT *
											FROM buff_stock
											where MAT_IP_CODE = '".$row1['MAT_IP_CODE']."'";
								$result3 = $conn->query($sql3);
								$row3 = $result3->fetch_assoc();
								if($row3){
									$Total = $row3['Total'];
								}else{
									$Total = 0;
								}
							?>
							<div class="progress" style="height: 75px;">
								<div class="progress-bar bg-warning" role="progressbar" style="font-size: 500%; width: <?= ($row1['Total']/($row1['Total']+$Total))*100;?>%;" aria-valuenow="<?= $row1['Total'];?>" aria-valuemin="0" aria-valuemax="<?= $row1['Total']+$Total;?>"><?= $row1['Total'];?></div>
								<div class="progress-bar bg-info" role="progressbar" style="font-size: 500%; width: <?= ($Total/($row1['Total']+$Total))*100;?>%;" aria-valuenow="<?= $Total;?>" aria-valuemin="0" aria-valuemax="<?= $row1['Total']+$Total;?>"><?= $Total;?></div>
							</div>
                        </div>
					</div>
					<div class="card-footer py-1" style="background-color: purple; border-top-width: 0px;"></div>
				</div>
			</div>
<?php
		}
	}
?>