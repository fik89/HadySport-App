
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Invoice
            <span class="pull-right">
                <button class="btn btn-sm btn-success" onclick="dataInvoicePartner();"><i class="fa fa-refresh"></i></button>
            </span>
        </h3>
        <div id="finputpartner"></div>
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Data Invoice Partner Berbayar
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="width:100%" id="dataTables-dataInvoicePartner">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id Invoice</th>
                                    <th>Id Akun Berbayar</th>
                                    <th>Email</th>
                                    <th>Status Akun User</th>
                                    <th>Cara Pembayaran</th>
                                    <th>Slip</th>
                                    <th>Jumlah Bayar</th>
                                    <th>Tanggal Register</th>
                                    <th>Tanggal Konfirmasi</th>
                                    <th>Status Payment</th>
                                    <th>Via Bank</th>
                                    <th>Nama Pengirim</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($data as $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td id="idinvoice<?php echo $value->iduser;?>"><?php echo $value->idinvoicepartner; ?></td>
                                        <td><?php echo $value->iduser; ?></td>
                                        <td id="email<?php echo $value->iduser;?>"><?php echo $value->useremail; ?></td>
                                        <td>
                                            <?php
                                            if ($value->userStatus == "Inactive") {
                                                echo "<span class='text-warning text-bold'>" . $value->userStatus . "</span>";
                                            } elseif ($value->userStatus == "Suspend") {
                                                echo "<span class='text-danger text-bold'>" . $value->userStatus . "</span>";
                                            } else {
                                                echo "<span class='text-success text-bold'>" . $value->userStatus . "</span>";
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $value->paymentMethod; ?></td>
                                        <td><a href="<?php echo site_url('asset/img/uploads/buktitransfer/'.$value->paymentImage.'')?>" target="_blank"><img src="<?php echo site_url('asset/img/uploads/buktitransfer/'.$value->paymentImage.'')?>" style="max-width: 200px;"></a></td>
                                        <td><?php echo "Rp. <span class='money'>" . $value->invoicePartnerPrice . "</span>"; ?></td>
                                        <td><?php echo $value->dateRegister; ?></td>
                                        <td><?php echo $value->dateConfirm; ?></td>
                                        <td>
                                            <?php
                                            if ($value->invoicePartnerStatus == "PAID") {
                                                echo "<span class='text-success text-bold'>" . $value->invoicePartnerStatus . "</span>";
                                            } else {
                                                echo "<span class='text-danger text-bold'>" . $value->invoicePartnerStatus . "</span>";
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $value->bankNameSender; ?></td>
                                        <td><?php echo $value->accountNameSender; ?></td>
                                        <td align="center">
                                            <span class="btn btn-sm btn-primary" data-toggle="tooltip" title="konformasi pembayaran" onclick="confirmInvoicePartner('<?php echo $value->iduser; ?>');"><i class="fa fa-check"></i></span>
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
</div>
<script>
    function confirmInvoicePartner(id) {
        var idinvoice = $('#idinvoice' + id).text();
        var email = $('#email' +id).text();
        swal({
            title: "Konfirmasi Pembayaran",
            text: "Apakah Anda akan mengkonfirmasi Pembayaran dan mengirimkan email token aktivasi user ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#5cb85c",
            confirmButtonText: "Konfirmasi",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "<?php echo base_url('d/Invoice/confirm_invoice_partner'); ?>",
                            method: "POST",
                            data: {"idinvoice": idinvoice, "email": email, "iduser":id},
                            success: function (data) {
                                $('#alert').html(data);
                                dataInvoicePartner();
                            }
                        });
                        swal("Sukses!", "Invoice Terkonfirmasi", "success");
                    } else {
                        swal("", "", "error");
                    }
                });
    }
</script>