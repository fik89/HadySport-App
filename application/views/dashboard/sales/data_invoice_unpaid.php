<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Invoice Belum di bayar <span id="date_time"></span>
        </h3>
        <div class="row" id="tableorder">
            <div class="col-lg-12">
                <div class="row">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            Data Invoice Belum di bayar ( Klik button Restock jika Invoice tidak terbayar )
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTables-dataInvoiceunpaid">
                                <thead>
                                    <tr>
                                        <th>NO</th> 
                                        <th>ID Order</th> 
                                        <th>Total Bayar</th>
                                        <th>Tanggal Order</th>
                                        <th>Tanggal JTP</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $datenow = date("Y-m-d H:i:s");
                                    $no = 1;
                                    foreach ($data as $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $value->idorder; ?></td>
                                            <td><?php echo "Rp.".number_format($value->invoicePrice); ?></td>
                                            <td><?php echo $value->invoiceDate; ?></td>
                                            <td><?php echo $value->dueDate;if($datenow > $value->dueDate ){ echo '  <span class="btn-sm btn-danger">JTP</span>';} ?></td>
                                            <td><?php echo $value->invoiceStatus; ?></td>
                                            <td>
                                                <a href="tel:<?php echo $value->custHp?>" class="btn btn-sm btn-success" data-toggle="tooltip" title="Telepon Pembeli"><i class="fa fa-phone"></i></a>
                                                <button class="btn btn-sm btn-success" data-toggle="tooltip" title="Kirim Email Pembeli" onclick="sendEmailRemainder('<?php echo $value->idorder;?>');"><i class="fa fa-envelope-o"></i></button>
                                                <button class="btn btn-sm btn-danger" data-toggle="tooltip" title="Kembalikan Stok dan Tolak Order ini" onclick="rejectOrder('<?php echo $value->idorder;?>')"><i class="fa fa-recycle"></i></button> | 
                                                <button class="btn btn-sm btn-primary" data-toggle="tooltip" title="Detail Order" onclick="detailOrder('<?php echo $value->idorder;?>');"><i class="fa fa-eye"></i></button>  
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>      
            </div>
        </div>
        <div id="detailOrder"></div>
    </div>
</div>

<script type="text/javascript">
    function rejectOrder(id){
         $('#loader').show();
       swal({
            title: "Reject & Restock",
            text: "Anda Akan menolak order dan mengembalikan stok order ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ff0000",
            confirmButtonText: "Reject & Restock",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "<?php echo base_url('d/Sales/reject_restock_product'); ?>",
                            method: "POST",
                            data: {"id": id},
                            success: function (data) {
                                $('#alert').html(data);
                                dataInvoiceUnpaid();
                            }
                        });
                        swal("", "Request Sukses", "success");
                        $('#loader').hide();
                    } else {
                        swal("", "", "error");
                        $('#loader').hide();
                    }
                });
    }

    function detailOrder(id) {
        var id = id;
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Sales/detail_order') ?>',
            method: "post",
            data: {id: id},
            success: function (resp) {
                $('#detailOrder').html(resp);
                $('#loader').hide();
            }
        });
    }
    function sendEmailRemainder(id) {
        $('#loader').show();
       swal({
            title: "Anda akan mengirim email ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ff0000",
            confirmButtonText: "Kirim",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "<?php echo base_url('d/Invoice/send_email_remainder'); ?>",
                            method: "POST",
                            data: {"id": id},
                            success: function (data) {
                                $('#alert').html(data);
                                dataInvoiceUnpaid();
                            }
                        });
                        swal("", "Request sedang di proses system", "success");
                        $('#loader').hide();
                    } else {
                        swal("", "", "error");
                        $('#loader').hide();
                    }
                });
    }


</script>