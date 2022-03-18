<!DOCTYPE html>
<html>
<style type="text/css">
	table, th, td {
  border: 1px solid black;
}
table{

  width: 100%;
}
</style>
<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=penjualan-export.xls");
?>
<body>
	<center>
      <h3>Data Penjualan <br>
      	<?php
      	if(empty($startdate) && empty($enddate)){
      		echo "Periode : dari awal s/d tanggal: ".date_ind(date('Y-m-d'));
      	}else if(empty($startdate)){
      		echo "Periode : dari awal s/d tanggal: ".date_ind($enddate);
      	}else{
      		echo "Periode : dari tanggal: ".date_ind($startdate)." s/d tanggal: ".date_ind($enddate);
      	}
	
      ?>
      </h3>
      <h4><?php echo $profile->companyName."<br>".$profile->address1;?></h4>
  	</center>
	<table>
		<tr>
			<th>NO</th> 
			<th>ID Order</th> 
			<th>Type</th> 
			<th>Produk</th>
			<th>Qty</th>
			<th>Harga</th>
			<th>Total Harga</th>
			<th>Voucher</th>
			<th>Nama</th>
			<th>Alamat Detail</th>
			<th>Alamat Input</th>
			<th>Jenis Member</th>
			<th>Tgl. Order</th>
			<th>Status</th>
		</tr>

		<?php 
		$no = 1;
		if(empty($data)){
			echo "<tr><td colspan='15'><center>Tidak ada transaksi</center></td></tr>";
		}else{
		foreach ($data as $value) {?>
			<tr>
				<td><?php echo $no++;?></td>
				<td><?php echo $value->idorder;?></td>
				<td><?php echo $value->orderMethod;?></td>
				<td><?php echo $value->productName?></td>
				<td><?php echo $value->productQty;?></td>
				<td><?php echo "Rp. ".number_format($value->productPrice);?></td>
				<td><?php echo "Rp. ".number_format($value->subtotalPrice);?></td>
				<td><?php echo $value->voucherCode;?></td>
				<td><?php echo $value->firstName." ".$value->lastName?></td>
				<td><?php echo $value->fullAddress;?></td>
				<td><?php echo $value->desa.", RT:".$value->rt." RW:".$value->rw.", ".$value->kecamatan.", ".$value->namaKabupaten.", ".$value->namaProvinsi;;?></td>
				<td><?php echo $value->partnerName;?></td>
				<td><?php echo date_ind($value->orderDate)." ".get_time($value->orderDate)?></td>
				<td><?php echo $value->status;?></td>
			</tr>
		<?php }
		$totalpenjualan = 0;
		foreach($data as $key=>$value){
			if(isset($value->subtotalPrice))
				$totalpenjualan += $value->subtotalPrice;
		}
		echo "
		<tr>
		<td colspan='7' align='right'><b> Total Penjualan Rp.".number_format($totalpenjualan)."</b></td>
		</td>";
	} ?>
</table>
</body>
</html>