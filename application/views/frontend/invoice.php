<?php echo $header; ?>  
<div class="bread-crumb-detail bgwhite flex-w p-l-52 p-r-15 p-t-20 p-l-15-sm">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Invoice
    </span>
</div>
<section class="bgwhite p-t-20 p-b-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0 bo17">
                        <div class="mb-2 bo18 p-2 bg-dark text-center text-white">
                            <h4>Invoice # <?php echo $invoice->idorder; ?><br> Status <?php
                                if ($invoice->invoiceStatus == "UNPAID") {
                                    echo "<span class='text-danger'>" . $invoice->invoiceStatus . "</span>";
                                } else {
                                    echo "<span class='text-success'>" . $orderresult->status . "</span>";
                                }
                                ?>
                            </h4>
                        </div>
                        <div class="row p-r-20 p-l-20 p-t-20 p-b-20">
                            <div class="col-md-6 text-left">
                                <img src="<?php echo site_url('asset/img/uploads/banner/' . $logo->image . '') ?>" style="max-width: 120px;">
                                <p class="mb-1"><?php echo $profile->address1 . " <br>Telp." . $profile->phone1; ?></p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p class="mb-1">Tanggal Invoice : <?php echo $invoice->invoiceDate; ?></p>
                                <p class="mb-1 text-danger">Jatuh Tempo : <b><?php echo $invoice->dueDate; ?></b></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row pb-5 p-4">
                            <div class="col-md-6">
                                <p class="font-weight-bold mb-4">Ditagihkan Kepada</p>
                                <p class="mb-1"><?php echo $ordershiping->firstName . " " . $ordershiping->lastName; ?></p>
                                <p class="mb-1"><b>Email</b> : <?php echo $ordershiping->custEmail; ?></p>
                                <p><b>Alamat </b>: <?php echo $ordershiping->desa . ", " . $ordershiping->rt . " " . $ordershiping->rw . " , " . $ordershiping->kecamatan . " , " . $ordershiping->namaKabupaten . " , " . $ordershiping->namaProvinsi . ". (kode pos: " . $ordershiping->kodePos . " )."; ?></p>
                                <p class="mb-1"><b>Telp. </b><?php echo $ordershiping->custHp; ?></p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p class="font-weight-bold mb-4">Informasi Pengiriman</p>
                                <p class="mb-1"><b>Kurir</b> : <?php echo $ordershiping->shipingName; ?></p>
                                <p class="mb-1"><b>Biaya</b> : <?php echo "Rp. <span class='money'>" . $ordershiping->shipingCarge . "</span>"; ?></p>
                            </div>
                        </div>
                        <div class="row p-4">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="border-0 text-uppercase small font-weight-bold">Item</th>
                                                <th class="border-0 text-uppercase small font-weight-bold">Description</th>
                                                <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
                                                <th class="border-0 text-uppercase small font-weight-bold">Unit Cost</th>
                                                <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($detailorder as $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $value->idproduct; ?></td>
                                                    <td><?php echo $value->productName; ?></td>
                                                    <td><?php echo $value->productQty; ?></td>
                                                    <td><?php echo "Rp. " . number_format($value->productPrice); ?></td>
                                                    <td><?php echo "Rp. " . number_format($value->subtotalPrice); ?></td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td><?php echo $ordershiping->shipingName; ?></td>
                                                <td>Jasa Pengiriman Barang</td>
                                                <td><?php echo ceil(($ordershiping->totalWeight) / 1000); ?> Kg</td>
                                                <td><?php echo "Rp. " . number_format(($ordershiping->shipingCarge) / (ceil(($ordershiping->totalWeight) / 1000))); ?></td>
                                                <td><?php echo "Rp. " . number_format($ordershiping->shipingCarge); ?></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Subtotal</td>
                                                <td>Rp. <span class="money"><?php echo number_format($ordershiping->totalPrice) ?></span></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Discount Partner</td>
                                                <td>Rp. - <span class="money"><?php echo number_format($orderresult->partnerDiscount) ?></span></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Voucher</td>
                                                <td>Rp. - <span class="money"><?php echo number_format($orderresult->voucherPrice) ?></span></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Ppn (<?php echo $profile->taxProduct." %";?>)</td>
                                                <td>Rp. <span class="money"><?php echo number_format($orderresult->tax) ?></span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                            <div class="py-3 px-5 text-right">
                                <div class="mb-2">Grand Total</div>
                                <div class="h2 font-weight-light"><?php echo "Rp. " . number_format($orderresult->orderSumary); ?></div>
                            </div>
                            <div class="py-3 px-5 text-right">
                                <div class="mb-2">Uniq Payment</div>
                                <div class="h2 font-weight-light"><?php
                                    $countstr = strlen($orderresult->orderSumary);
                                    echo "Rp. " . number_format(substr($orderresult->orderSumary, $countstr - 3))
                                    ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 p-t-30">
                <div class="card">
                    <div class="card-body p-0 bo17">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-0 text-uppercase small font-weight-bold">Cara Pembayaran</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Bank</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Atas Nama</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Uniq Payment</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Transfer Bank</td>
                                            <td><?php echo $invoice->paymentMethod; ?></td>
                                            <td><?php echo $invoice->bankAccountName; ?></td>
                                            <td><?php
                                                $countstr = strlen($orderresult->orderSumary);
                                                echo "Rp. " . number_format(substr($orderresult->orderSumary, $countstr - 3))
                                                ?></td>
                                            <td> <?php echo "Rp. " . number_format($invoice->invoicePrice); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="p-2">
                                <?php
                                if ($invoice->invoiceStatus == "PAID" || $invoice->invoiceStatus == "process shiping" ||$invoice->invoiceStatus == "closing paid"|| $invoice->invoiceStatus == "reject" || $invoice->invoiceStatus == "canceled"|| $orderresult->status != 'offline') {
                                    
                                } else {
                                    ?>
                                    <button class="btn btn-block subs_btn form-control" type="button" data-toggle="modal" data-target="#modalPayment">
                                        Konfirmasi Sudah Bayar
                                    </button>
                                <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if ($invoice->invoiceStatus == "PAID" || $invoice->invoiceStatus == "process shiping" ||$invoice->invoiceStatus == "closing paid"  || $invoice->invoiceStatus != "canceled" || $orderresult->status == 'offline') {
                    ?>
                <br>
                <a class="btn btn-block subs_btn form-control" type="button" href="<?php echo base_url('d/Exportdata/export_invoice_pdf?idorder='.encryption($invoice->idorder).'')?>" target="_blank">
                    Cetak
                </a>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modalPayment">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="login_form" action="<?php echo base_url('Invoice/confirm_payment_order') ?>" method="post" accept-charset="UTF-8" enctype="multipart/form-data">

                <div class="modal-header bg-dark text-white text-center">
                    <h6>Konfirmasi Pembayaran</h6>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="idinvoice" value="<?php echo $invoice->idinvoice; ?>">
                    <input type="hidden" name="idorder" value="<?php echo $invoice->idorder; ?>">
                    <div class="col-md-12 p-r-20 p-l-20 form-group">
                        <label>Transfer ke Bank</label>
                        <input class="form-control" type="text" name="bankname" id="bankname" value="<?php echo $invoice->paymentMethod; ?>" readonly="">
                    </div>
                    <div class="col-md-12 p-r-20 p-l-20 form-group">
                        <label>Total Pembayaran</label>
                        <input class="form-control" type="text" name="" id="" required="" readonly="" value="<?php echo "Rp. " . number_format($invoice->invoicePrice); ?>">
                    </div>
                    <div class="col-md-12 p-r-20 p-l-20 form-group">
                        <label>Upload Bukti Transfer</label>
                        <input class="form-control" type="file" name="slip" id="slip" placeholder="Bukti Transfer" required="" onchange="preview(this);">
                        <hr>
                        <img id="slippreview" style="width: 50%; height: 50%;"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-block subs_btn form-control" id="btn-upload" type="submit" onclick="confirmPayment();">
                        Konfirmasi Sudah Bayar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php echo $footer; ?>
<?php if ($this->session->flashdata('MSG')) { ?>
    <?= $this->session->flashdata('MSG') ?>
<?php } ?>
<script>
    function preview(oInput) {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("slip").files[0]);
        oFReader.onload = function (oFREvent) {
            document.getElementById("slippreview").src = oFREvent.target.result;
        };
        ValidateSingleInput(oInput);
    }
    var _validFileExtensions = [".jpg", ".jpeg", ".png"];      
function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                alert("Maaf, " + sFileName + " tidak valid, silahkan upload dengan tipe file: " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}
</script>
</body>
</html>