<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Detail Order , status Retur : <b><?php echo $detailretur->retur_status; ?></b>
                    <a href="JavaScript:void(0);" onclick="close_detail_retur();"><span class="pull-right"><i class="fa fa-close"></i></span></a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>ID Order</th>
                                <td><?php echo $detailretur->idorder; ?></td>
                            </tr>
                            <tr>
                                <th>ID User</th>
                                <td><?php echo $detailretur->iduser . " | Nama :" . $detailretur->username; ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Order</th>
                                <td><?php echo date_ind($detailretur->orderDate) . " - " . get_time($detailretur->orderDate); ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Retur</th>
                                <td><?php echo date_ind($detailretur->retur_date) . " - " . get_time($detailretur->retur_date); ?></td>
                            </tr>
                            <tr class="bg-default">
                                <th colspan="2">Rincian Retur</th>
                            </tr>
                            <tr class="bg-warning">
                                <th>Opsi Permintaan Retur</th>
                                <td><?php echo strtoupper($detailretur->request_retur_solution); ?></td>
                            </tr>
                            <tr>
                                <th>ID Product</th>
                                <td><?php echo $detailretur->idproduct_retur; ?></td>
                            </tr>
                            <tr>
                                <th>Nama Product</th>
                                <td><?php echo $detailretur->productName; ?></td>
                            </tr>
                            <tr>
                                <th>Harga Product</th>
                                <td><?php echo "Rp. " . number_format($detailretur->price) . " | Harga Diskon : " . "Rp. " . number_format($detailretur->pricesale); ?></td>
                            </tr>
                            <tr>
                                <th>Total Jumlah Beli Product</th>
                                <td><?php echo number_format($detailretur->productQty); ?></td>
                            </tr>
                            <tr>
                                <th>Total Harga Beli Product</th>
                                <td><?php echo "Rp. " . number_format($detailretur->productPrice); ?></td>
                            </tr>
                            <tr class="bg-warning">
                                <th>Jumlah Product di retur</th>
                                <td><?php echo number_format($detailretur->qty_retur); ?></td>
                            </tr>
                            <tr class="bg-warning">
                                <th>Gambar Product di retur</th>
                                <td><a href="<?php
                                    if (!empty($detailretur)) {
                                        echo base_url('') . $detailretur->img_product_retur;
                                    } else {
                                        echo "null";
                                    }
                                    ?>" target="_blank"><?php
                                           if (!empty($detailretur)) {
                                               echo $detailretur->img_product_retur;
                                           } else {
                                               echo "null";
                                           }
                                           ?></a>
                                </td>
                            </tr>
                            <tr class="bg-warning">
                                <th>Alasan retur</th>
                                <td><?php echo $detailretur->comment_retur; ?></td>
                            </tr>
                            <tr class="bg-default">
                                <th colspan="2">Rincian Order</th>
                            </tr>
                            <tr>
                                <th>Tanggal Order</th>
                                <td><?php echo date_ind($detailretur->orderDate) . " - " . get_time($detailretur->orderDate); ?></td>
                            </tr>
                            <tr>
                                <th>Total Belanja</th>
                                <td><?php echo "Rp. " . number_format($detailretur->cartTotal); ?></td>
                            </tr>
                            <tr>
                                <th>Biaya Jasa Pengiriman</th>
                                <td><?php echo "Rp. " . number_format($detailretur->shipingCarge); ?></td>
                            </tr>
                            <tr>
                                <th>Discount Partner</th>
                                <td><?php echo "Rp. " . number_format($detailretur->partnerDiscount); ?></td>
                            </tr>
                            <tr>
                                <th>Voucher</th>
                                <td><?php echo "Rp. " . number_format($detailretur->discountPrice); ?></td>
                            </tr>
                            <tr>
                                <th>Pajak Invoice</th>
                                <td><?php echo "Rp. " . number_format($detailretur->tax); ?></td>
                            </tr>
                            <tr>
                                <th>Total Invoice</th>
                                <td><?php echo "Rp. " . number_format($detailretur->invoicePrice); ?></td>
                            </tr>
                            <tr>
                                <th>Payment Method</th>
                                <td><?php echo $detailretur->paymentMethod . "| Account Bank : " . $detailretur->bankAccountName; ?></td>
                            </tr>
                            <tr>
                                <th>Bukti Pembayaran</th>
                                <td><a href="<?php
                                    if (!empty($detailretur)) {
                                        echo base_url('asset/img/uploads/buktitransfer/') . $detailretur->paymentImage;
                                    } else {
                                        echo "null";
                                    }
                                    ?>" target="_blank"><?php
                                           if (!empty($detailretur)) {
                                               echo $detailretur->paymentImage;
                                           } else {
                                               echo "null";
                                           }
                                           ?></a>
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal Konfirmasi Pembayaran</th>
                                <td><?php echo date_ind($detailretur->dateUploadPayment) . " " . get_time($detailretur->dateUploadPayment); ?></td>
                            </tr>
                            <tr>
                                <th>Nomor Resi</th>
                                <td><?php echo $detailretur->receiptNumber; ?></td>
                            </tr>
                            <tr>
                                <th>Nama & Jenis Paket Jasa Pengiriman</th>
                                <td><?php echo $detailretur->shipingName; ?></td>
                            </tr>
                            <tr>
                                <th>Biaya Jasa Pengiriman</th>
                                <td><?php echo "Rp. " . number_format($detailretur->shipingCarge); ?></td>
                            </tr>
                            <tr>
                                <th>Alamat Pengiriman</th>
                                <td><?php echo $detailretur->desashiping . ", RT:" . $detailretur->rtshiping . " RW:" . $detailretur->rwshiping . ", " . $detailretur->kecamatanshiping . ", " . $detailretur->kabupatenshiping . ", " . $detailretur->provinsishiping . ". Kodepos : " . $detailretur->kodePos; ?></td>
                            </tr>
                            <tr>
                                <th>Alamat Detail</th>
                                <td><?php echo $detailretur->fullAddress; ?></td>
                            </tr>
                            <tr>
                                <th>Informasi Penerima</th>
                                <td><?php echo $detailretur->firstName . " " . $detailretur->lastName . ", Telp: " . $detailretur->custHp . ", Email: " . $detailretur->custEmail; ?></td>
                            </tr>
                            <tr>
                                <th colspan="2" class="bg-info text-center">
                                    Form Konfirmasi
                                </th>
                            </tr>

                            <?php if ($detailretur->retur_status == 'confirmed') { ?>
                                <tr>
                                    <th>Tanggal Konfirmasi</th>
                                    <td><?php echo date_ind($detailretur->date_confirm) . " " . get_time($detailretur->date_confirm); ?></td>
                                </tr>
                                <tr>
                                    <th>Konfirmasi Opsi Retur</th>
                                    <td><?php echo $detailretur->confirm_retur_solution; ?></td>
                                </tr>
                                <tr>
                                    <th>Jumlah Uang di kembalikan</th>
                                    <td><?php echo "Rp. " . number_format($detailretur->money_back); ?></td>
                                </tr>
                                <tr>
                                    <th>Informasi Konfirmasi retur</th>
                                    <td><?php echo $detailretur->comment_reply; ?></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>
                                        <button class="btn btn-block btn-warning" onclick="show_form()"><i class="fa fa-check-circle"></i> Edit Informasi Retur</button>
                                        <button class="btn btn-block btn-primary" onclick="send_email_confirm('<?php echo $detailretur->idretur;?>')"><i class="fa fa-check-circle"></i> Kirim Email</button>
                                    </td>
                                </tr>
                            <?php } ?>
                                
                                <tr id="formconfirm">
                                    <th>
                                        <div class="alert alert-info">
                                            <strong>Note: </strong> Konfirmasi retur dengan <br> jumlah uang tertentu <br> akan tercatat di data keuangan <br> namun tidak akan mengembalikan stok barang, <br> informasi yang diinputkan akan <br> di teruskan ke pembeli melalui e-mail. <br> jika Anda akan mengganti dengan barang baru <br> kosongkan kolom jumlah uang <br> dan berikan keterangan detail ke pembeli.
                                        </div> 
                                    </th>
                                    <td>
                                        <form role="form" id="formconfirmretur">
                                            <div class="form-group">
                                                <label>Opsi Retur Solution</label>
                                                <select class="form-control" id="solution" name="solution">
                                                    <?php if($detailretur->confirm_retur_solution != null){?>
                                                    <option value="<?php echo $detailretur->confirm_retur_solution;?>" selected=""><?php echo $detailretur->confirm_retur_solution;?></option>
                                                    <?php } ?>
                                                    <option value="pengembalian barang">Pengembalian Barang</option>
                                                    <option value="pengembalian uang">Pengembalian Uang</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Jumlah uang yang akan di kembalikan</label>
                                                <input type="hidden" id="returstatus" name="returstatus" value="<?php echo $detailretur->retur_status;?>">
                                                <input type="hidden" name="idretur" id="idretur" value="<?php echo $detailretur->idretur; ?>">
                                                <input type="hidden" name="idorder" id="idorder" value="<?php echo $detailretur->idorder; ?>">
                                                <input type="number" class="form-control" name="moneyback" id="moneyback" placeholder="jumlah uang retur" value="<?php echo $detailretur->money_back;?>">
                                            </div>

                                            <div class="form-group">
                                                <label>Informasi</label>
                                                <textarea class="form-control textarea" name="commentreply" id="commentreply" rows="7" required=""><?php echo $detailretur->comment_reply;?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Update Status Order</label>
                                                <select class="form-control" id="statusordernew" name="statusordernew">
                                                    <option value="process shiping">Process Shiping</option>
                                                    <option value="selesai">Selesai</option>
                                                </select>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                <tr id="btnconfirm">
                                    <th></th>
                                    <td><button class="btn btn-block btn-success" onclick="confirm_retur()"><i class="fa fa-check-circle"></i> Konfirmasi Retur</button></td>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>      
    </div>
</div>
<script type="text/javascript">
    function show_form(){
        $('#formconfirm').show();
        $('#btnconfirm').show();
    }
    function close_detail_retur() {
        $('#datadetailretur').hide();
    }
    function check_status_retur(){
        var status  = $('#returstatus').val();
        if(status == "submit"){
            $('#formconfirm').show();
            $('#btnconfirm').show();
        }else{
            $('#formconfirm').hide();
            $('#btnconfirm').hide();
        }
    }
    function confirm_retur() {
        if (document.getElementById("commentreply").value.length != 0) {
            swal({
                title: "",
                text: "Konfirmasi Request Retur ini ?",
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
                            var form = $('#formconfirmretur').get(0);
                            var form_data = new FormData(form);
                            Pace.start();
                            $('#loader').show();
                            $.ajax({
                                url: '<?php echo base_url('d/Retur/confirm_retur'); ?>',
                                method: "POST",
                                data: form_data,
                                contentType: false,
                                processData: false,
                                dataType: "json",
                                accepts: {
                                    json: 'application/json'
                                },
                                success: function (response) {
                                    if (response.status === '0') {
                                        swal("error", "" + response.message + "", "error");
                                    } else {
                                        $('#datadetailretur').hide();
                                        table.ajax.reload();
                                        swal("", "" + response.message + "", "success");
                                    }
                                    Pace.stop();
                                    $('#loader').hide();
                                }
                            });
                        } else {
                            swal("", "", "error");
                        }
                    });
        } else {
            swal("", "Field Informasi tidak boleh kosong", "error");
        }
    }
</script>