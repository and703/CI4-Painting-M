
		<table>
			<tbody>
			<?php foreach($paint as $row):?>
				<tr>
					 <td><?= $row['id']; ?></td>
					 <td><?= $row['WM_CODE']; ?></td>
					 <td><?= $row['WM_NAME_WM_SURNAME']; ?></td>
					 <td><?= $row['MCH']; ?></td>
					 <td><?= $row['MAT_IP_CODE']; ?></td>
					 <td><?= $row['MAT_DESC']; ?></td>
					 <td><?= $row['Amount']; ?></td>
					 <td><?= $row['On_Insert']; ?></td>
					 <td><?= $row['CURE_TIME']; ?></td>
					 <td><?= $row['Count_Printed']; ?></td>
					<td>
						<a href="rePrint/<?= $row['id'];?>">Print</a>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
