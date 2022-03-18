<!DOCTYPE html>
<html>
	<?php
	$date = date('Y-m-h');
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=tlv".$date.".xls");
	?>
	<body>
		<table>
			<tr>
				<th>email</th>
				<th>phone</th>
				<th>fn</th>
				<th>ln</th>
				<th>zip</th>
				<th>ct</th>
				<th>st</th>
				<th>country</th>
				<th>dob</th>
				<th>doby</th>
				<th>gen</th>
				<th>age</th>
				<th>rating</th>
			</tr>
			<?php 
			foreach ($data as $value) {?>
			<tr>
				<td><?php echo $value->custEmail;?></td>
				<td><?php echo "+62".substr($value->custHp,1);?></td>
				<td><?php echo $value->firstName;?></td>
				<td><?php echo $value->lastName;?></td>
				<td><?php echo $value->kodePos;?></td>
				<td><?php echo $value->namaKabupaten;?></td>
				<td><?php echo $value->namaProvinsi;?></td>
				<td>IDN</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>

			<?php } ?>
		</table>
	</body>
	</html>