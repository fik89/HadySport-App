<!DOCTYPE html>
<html>
<head>
	<title>Export Ltv</title>
	<style type="text/css">
		body{
			font-family: sans-serif;
		}
		table{
			margin: 20px auto;
			border-collapse: collapse;
		}
		table th,
		table td{
			border: 1px solid #3c3c3c;
			padding: 3px 8px;

		}
		a{
			background: blue;
			color: #fff;
			padding: 8px 10px;
			text-decoration: none;
			border-radius: 2px;
		}
	</style>
</head>
<body>
	<center>
		<h4>Data Customer to export</h4>
	</center>
	<center>
		<a target="_blank" href="<?php echo base_url('d/Exportdata/final_export_ltv?startdate='.$startdate.'&enddate='.$enddate.'');?>">EXPORT</a>
	</center>
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
	<?php if(empty($data)){echo "<center>Data customer Kosong ".$startdate." - ".$enddate."</center>";}?>
</body>
</html>