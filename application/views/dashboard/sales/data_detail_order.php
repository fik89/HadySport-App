<div class="row" id="datadetailorder">
    <div class="col-lg-12">
        <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Detail Order , status : <b><?php echo $orderresult->status; ?></b>
                    <a href="JavaScript:void(0);" onclick="close_detail();"><span class="pull-right"><i class="fa fa-close"></i></span></a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>ID Order</th>
                                <td><?php echo $orderresult->idorder; ?></td>
                            </tr>
                            <tr>
                                <th>ID User</th>
                                <td><?php echo $orderresult->iduser; ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Order</th>
                                <td><?php echo $orderresult->orderDate; ?></td>
                            </tr>
                            <tr class="bg-default">
                                <th colspan="2">Rincian Order</th>
                            </tr>

                            <?php
                            $i = 1;
                            if (!empty($detailorder)) {
                                foreach ($detailorder as $value) {
                                    ?>
                                    <tr>
                                        <th><?php echo "(" . $value->idproduct . ") " . $value->productName; ?></th>
                                        <td><?php echo $value->productQty . " pcs, satuan: Rp" . number_format($value->productPrice) . " ( Rp." . number_format($value->subtotalPrice) . ")"; ?> | <?php echo "Note :" . $value->note; ?></td>
                                    </tr> 
                                    <?php
                                }
                            }
                            ?>
                            <tr class="bg-default">
                                <th colspan="2">Rincian Kurir</th>
                            </tr>

                            <tr>
                                <th>Layanan Kurir</th>
                                <td><?php echo $ordershiping->shipingName; ?></td>
                            </tr>
                            <tr>
                                <th>Layanan Kurir</th>
                                <td><?php
                                    if (empty($ordershiping->receiptNumber)) {
                                        echo "Belum diinput";
                                    } else {
                                        echo $ordershiping->receiptNumber;
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <th>Perkiraan Biaya</th>
                                <td><?php echo number_format($ordershiping->shipingCarge); ?></td>
                            </tr>
                            <tr>
                                <th>Nama Penerima</th>
                                <td><?php echo $ordershiping->firstName . " " . $ordershiping->lastName; ?></td>
                            </tr>

                            <tr>
                                <th>Alamat</th>
                                <td><?php echo $ordershiping->desa . ", RT" . $ordershiping->rt . "- RW" . $ordershiping->rw . ", " . $ordershiping->kecamatan . ", " . $ordershiping->namaKabupaten . ", " . $ordershiping->namaProvinsi . ", " . $ordershiping->kodePos; ?></td>
                            </tr>
                            <tr>
                                <th>Alamat Detail</th>
                                <td><?php echo $ordershiping->fullAddress; ?></td>
                            </tr>
                            <tr>
                                <th>Kontak</th>
                                <td> <?php echo $ordershiping->custEmail . ", Telepon :" . $ordershiping->custHp; ?></td>
                            </tr>

                            <tr class="bg-default">
                                <th colspan="2">Rincian Total</th>
                            </tr>

                            <tr>
                                <th>Subtotal Order + Kurir</th>
                                <td><?php echo "Rp. " . number_format($ordershiping->totalPrice); ?></td>
                            </tr>
                            <tr>
                                <th>Voucher</th>
                                <td><?php echo "Rp. " . number_format($orderresult->voucherPrice); ?></td>
                            </tr>
                            <tr>
                                <th>pajak</th>
                                <td><?php echo "Rp. " . number_format($orderresult->tax); ?></td>
                            </tr>
                            <tr>
                                <th>Uniq Payment</th>
                                <td><?php
                                    $countstr = strlen($orderresult->orderSumary);
                                    echo "Rp. " . substr($orderresult->orderSumary, $countstr - 3);
                                    ?>

                                </td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td><b><?php echo "Rp. " . number_format($orderresult->orderSumary); ?></b></td>
                            </tr>

                            <tr class="bg-default">
                                <th colspan="2">Cara pembayaran</th>
                            </tr>

                            <tr>
                                <th>Cara pembayaran</th>
                                <td><?php
                                    if (!empty($invoice)) {
                                        echo $invoice->paymentMethod;
                                    } else {
                                        echo "null";
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Transfer</th>
                                <td><?php
                                    if (!empty($invoice)) {
                                        echo $invoice->dateConfirmPayment;
                                    } else {
                                        echo "null";
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <th>Jumlah Transfer / Bayar</th>
                                <td><b><?php
                                        if (!empty($invoice)) {
                                            echo "Rp. " . number_format($invoice->invoicePrice);
                                        } else {
                                            echo "null";
                                        }
                                        ?></b></td>
                            </tr>

                            <tr>
                                <th>Bukti Transfer</th>
                                <td><a href="<?php
                                    if (!empty($invoice)) {
                                        echo base_url('asset/img/uploads/buktitransfer/') . $invoice->paymentImage;
                                    } else {
                                        echo "null";
                                    }
                                    ?>" target="_blank"><?php
                                           if (!empty($invoice)) {
                                               echo $invoice->paymentImage;
                                           } else {
                                               echo "null";
                                           }
                                           ?></a></td>
                            </tr>
                            <?php if ($orderresult->status == "closing paid") { ?>
                                <tr>
                                    <th>Aksi</th>
                                    <td>
                                        <button class="btn btn-sm btn-success" onclick="confirmOrder('<?php echo $orderresult->idorder; ?>', '<?php echo $ordershiping->custEmail; ?>', '<?php echo $ordershiping->shipingName; ?>');"><i class="fa fa-truck"></i> Konfirmasi Order ke pengiriman</button>
                                        <button class="btn btn-sm btn-danger" data-toggle="tooltip" title="Kembalikan Stok dan Tolak Order ini" onclick="rejectOrder('<?php echo $value->idorder; ?>')"><i class="fa fa-recycle"></i></button>
                                        <button class="btn btn-sm btn-success" data-toggle="tooltip" title="Selesaikan Order ini" onclick="finish_order('<?php echo encryption($value->idorder); ?>')"><i class="fa fa-check"></i> Selesaikan Order</button>
                                    </td>
                                </tr>
                            <?php } else if ($orderresult->status == "process shiping") { ?>
                                <tr>
                                    <th>Aksi</th>
                                    <td>
                                        <button class="btn btn-sm btn-success" data-toggle="tooltip" title="Selesaikan Order ini" onclick="finish_order('<?php echo encryption($value->idorder); ?>')"><i class="fa fa-check"></i> Selesaikan Order</button>
                                        <a href="<?php echo base_url('d/Exportdata/export_shiping_label_pdf?idorder=' . $value->idorder . ''); ?>" target="_blank" data-toggle="tooltip" title="Cetak Label Box Pengiriman">
                                            <button class="btn btn-sm btn-info"><i class="fa fa-file-pdf-o"></i> Cetak Label Box</button>
                                        </a>
                                        <button class="btn btn-sm btn-danger" data-toggle="tooltip" title="Kembalikan Stok dan Tolak Order ini" onclick="rejectOrder('<?php echo $value->idorder; ?>')"><i class="fa fa-recycle"></i> Kembalikan Stok dan Tolak Order ini</button>
                                    </td>
                                </tr>
                            <?php  } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>      
    </div>
</div>
<script type="text/javascript">
    function confirmOrder1(id) {
        var id = id;
        swal({
            title: "Konfirmasi Order",
            text: "Konfirmasi Order ini dan mengirimkan email? Anda diwajibkan menginputkan resi pengiriman.",
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
                            url: '<?php echo base_url('d/Sales/confirm_order'); ?>',
                            method: "POST",
                            data: {"id": id},
                            success: function (data) {
                                $('#alert').html(data);
                                dataOrder('closing paid');
                            }
                        });
                        swal("Sukses!", "", "success");
                    } else {
                        swal("", "", "error");
                    }
                });

    }
    function rejectOrder(id) {
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
                                table.ajax.reload();
                                $('#datadetailorder').hide();
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

    function confirmOrder(id, email, kurir) {
        swal({
            title: "Konfirmasi Order!",
            text: "Masukan Kode Resi pengiriman:",
            type: "input",
            showCancelButton: true,
            confirmButtonColor: "#5cb85c",
            confirmButtonText: "Konfirmasi",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "kode Resi Pengiriman"
        },
                function (inputValue) {
                    if (inputValue === false)
                        return false;

                    if (inputValue === "") {
                        swal.showInputError("Masukan kode Resi Pengiriman!");
                        return false;
                    }
                    $.ajax({
                        url: '<?php echo base_url('d/Sales/confirm_order'); ?>',
                        method: "POST",
                        data: {"id": id, "resi": inputValue, "email": email, "kurir": kurir},
                        success: function (data) {
                            $('#alert').html(data);
                            dataOrder('closing paid');
                        }
                    }),
                            swal("Sedang di proses system", "" + inputValue, "success");
                    window.open('<?php echo base_url('d/Exportdata/export_shiping_label_pdf?idorder=' . $orderresult->idorder . '') ?>');
                });
    }
    
     function finish_order(id) {
            var id = id;
            swal({
                title:"",
                text: "Apa Anda yakin pesanan dari toko kami sudah diterima atau anda akan menyelesaikan order ini ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#218838",
                confirmButtonText: "Finish",
                cancelButtonText: "Batal",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: '<?php echo base_url('d/Sales/finish_order'); ?>',
                                method: "POST",
                                dataType: "json",
                                accepts: {
                                    json: 'application/json'
                                },
                                data: {"id": id},
                                success: function (resp) {
                                    if (resp.status == 0) {
                                        swal("", "" + resp.message + "", "error");
                                    } else {
                                        swal("", "" + resp.message + "", "success");
                                        table.ajax.reload();
                                        $('#detailorder').hide();
                                    }
                                },
                                error: function (resp) {
                                    swal("error, error_code: " + resp.status);
                                }
                            });
                        } else {
                            swal("", "", "error");
                        }
                    });
    }
</script>