<style>
table, th, td {
  font-size: 15px;
}
</style>

<div class="p-l-20 p-r-20 p-t-20 p-b-20">
<h3>Expedisi <?php echo $data['summary']['courier_name'];?></h3>
<br>
<h4 style="margin:0 0 5px 0;">I. Informasi Pengiriman</h4>
<table class="table">
	<tr>

		<td width="130">No Resi</td>
		<td>:</td>
		<td><b><?php echo $data['summary']['waybill_number'];?></b></td>
	</tr>
	<tr>
		<td>Status</td>
		<td>:</td>
		<td><b><?php echo $data['summary']['status'];?></b></td>
	</tr>
	<tr>
		<td>Service</td>
		<td>:</td>
		<td><?php echo $data['summary']['service_code'];?></td>
	</tr>
	<tr>
		<td>Dikirim tanggal</td>
		<td>:</td>
		<td><?php echo $data['summary']['waybill_date'];?></td>
	</tr>
	<tr>
		<td valign="top">Dikirim oleh</td>
		<td valign="top">:</td>
		<td valign="top"><?php echo $data['summary']['shipper_name'];?><br /><?php echo $data['summary']['origin'];?></td>
	</tr>
	<tr>
		<td valign="top">Dikirim ke</td>
		<td valign="top">:</td>
		<td valign="top"><?php echo $data['summary']['shipper_name'];?><br /><?php echo $data['details']['receiver_address1'].", ".$data['details']['receiver_address2'].", <br>".$data['details']['receiver_address3'].", ".$data['details']['receiver_city'];?></td>
	</tr>
	<tr>
		<td><?php echo strtoupper($data['summary']['courier_code']);?> Status</td>
		<td>:</td>
		<td><?php echo $data['delivery_status']['status'];?></td>
	</tr>
</table>
<hr>
<h4 style="margin:0 0 5px 0;"> II. Status Pengiriman</h4>
<div class="table-responsive">
	<div style="margin-left:15px;margin-top:5px;"><b>Outbond</b></div>
	<table class="table">
		<?php 
		for ($i=0; $i < count($data['manifest']); $i++) { 
		 	
		?>
		<tr style="text-align: left">
			<th width="30%">Tanggal</th>
			<th width="30%">Lokasi</th>
			<th width="40%">Keterangan</th>
		</tr>
		<tr>
			<td><?php  echo date_ind($data['manifest'][$i]['manifest_date'])." ".$data['manifest'][$i]['manifest_time']; ?></td>
			<td><?php  echo $data['manifest'][$i]['city_name']; ?></td>
			<td><?php  echo $data['manifest'][$i]['manifest_description']; ?></td>
		</tr>

		<?php } ?>
	</table>
</div>
<hr>
<?php if(!empty($data['delivery_status']['pod_receiver'])){?>
<h4 style="margin:0 0 5px 0;">III. Informasi Penerima</h4>
<table class="table">
	<tr>
		<td width="130">Nama Penerima</td>
		<td>:</td>
		<td><b><?php echo $data['delivery_status']['pod_receiver'];?></b></td>
	</tr>
	<tr>
		<td width="130">Diterima Tanggal</td>
		<td>:</td>
		<td><b><?php echo date_ind($data['delivery_status']['pod_date'])." - ".$data['delivery_status']['pod_time'];?></b>
		</td>
	</tr>
</table>
<?php } ?>
</div>