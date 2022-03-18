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
        <?php if ($this->session->flashdata('MSG')) { ?>
            <?= $this->session->flashdata('MSG') ?>
        <?php } ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0 bo17">
                        <div class="mb-2 bo18 p-2 bg-dark text-center text-white">
                            <h4>Invoice # <?php echo $invoice->idinvoicepartner; ?><br> Status <?php
                                if ($invoice->invoicePartnerStatus == "UNPAID") {
                                    echo "<span class='text-danger'>" . $invoice->invoicePartnerStatus . "</span>";
                                } else {
                                    echo "<span class='text-success'>" . $invoice->invoicePartnerStatus . "</span>";
                                }
                                ?>
                            </h4>
                        </div>
                        <div class="row p-r-20 p-l-20 p-t-20 p-b-20">
                            <div class="col-md-6 text-left">
                                <img src="<?php echo site_url('asset/img/uploads/banner/'.$logo->image.'') ?>" style="max-width: 120px;">
                                <p class="mb-1"><?php echo $profile->address1 . " <br>Telp." . $profile->phone1; ?></p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p class="font-weight-bold mb-1">Tanggal Invoice : <?php echo $invoice->dateRegister; ?></p>
                                <p class="font-weight-bold mb-1">Jatuh Tempo : <?php echo $invoice->dueDate; ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row pb-5 p-4">
                            <div class="col-md-6">
                                <p class="font-weight-bold mb-4">Ditagihkan Kepada</p>
                                <p class="mb-1"><?php echo $user->username; ?></p>
                                <p class="mb-1">Email : <?php echo $user->useremail; ?></p>
                                <p>Alamat : <?php echo $user->kabupaten . ", " . $user->provinsi; ?></p>
                                <p class="mb-1">Telp. <?php echo $user->userHp; ?></p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p class="font-weight-bold mb-4">Informasi</p>
                                <p class="mb-1">Status Akun Anda : <?php
                                    if ($user->userStatus == "unconfirm") {
                                        echo "<span class='text-danger'>" . $user->userStatus . "</span>";
                                    } else {
                                        echo "<span class='text-success'>" . $user->userStatus . "</span>";
                                    }
                                    ?></p>
                                <p class="mb-1"> Status Pembayaran : <?php
                                    if ($invoice->invoicePartnerStatus == "UNPAID") {
                                        echo "<span class='text-danger'>" . $invoice->invoicePartnerStatus . "</span>";
                                    } else {
                                        echo "<span class='text-success'>" . $invoice->invoicePartnerStatus . "</span>";
                                    }
                                    ?></p>
                            </div>
                        </div>
                        <div class="row p-4">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="border-0 text-uppercase small font-weight-bold">ID</th>
                                                <th class="border-0 text-uppercase small font-weight-bold">Item</th>
                                                <th class="border-0 text-uppercase small font-weight-bold">Description</th>
                                                <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
                                                <th class="border-0 text-uppercase small font-weight-bold">Unit Cost</th>
                                                <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td><?php echo $invoice->iduser; ?></td>
                                                <td><?php echo $invoice->invoicePartnerDescription; ?></td>
                                                <td>1</td>
                                                <td><?php echo "Rp. <span class='money'>" . $invoice->invoicePartnerPrice . "</span>"; ?></td>
                                                <td><?php echo "Rp. <span class='money'>" . $invoice->invoicePartnerPrice . "</span>"; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                            <div class="py-3 px-5 text-right">
                                <div class="mb-2">Total</div>
                                <div class="h2 font-weight-light"><?php echo "Rp. <span class='money'>" . $invoice->invoicePartnerPrice . "</span>"; ?></div>
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
                                            <th class="border-0 text-uppercase small font-weight-bold">ID</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Cara Pembayaran</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Bank</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Atas Nama</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Unit Cost</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Transfer Bank</td>
                                            <td><?php echo $invoice->paymentMethod; ?></td>
                                            <td><?php echo $invoice->bankName; ?></td>
                                            <td><?php echo "Rp. <span class='money'>" . $invoice->invoicePartnerPrice . "</span>"; ?></td>
                                            <td> <?php echo "Rp. <span class='money'>" . $invoice->invoicePartnerPrice . "</span>"; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="p-2">
                                <?php
                                if ($invoice->invoicePartnerStatus == "PAID") {
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
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modalPayment">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="login_form" action="<?php echo base_url('Invoice/konfirmasi_pembayaran_partner') ?>" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                <div class="modal-header bg-dark text-white text-center">
                    <h6>Konfirmasi Pembayaran</h6>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="idinvoice" value="<?php echo $invoice->idinvoicepartner; ?>">
                    <input type="hidden" name="iduser" value="<?php echo $invoice->iduser; ?>">
                    <div class="col-md-12 p-r-20 p-l-20 form-group">
                        <label>Transfer ke Bank</label>
                        <input class="form-control" type="text" name="bankname" id="bankname" value="<?php echo $invoice->paymentMethod; ?>" readonly="">
                    </div>
                    <div class="col-md-12 p-r-20 p-l-20 form-group">
                        <label>Total Pembayaran</label>
                        <input class="form-control" type="text" name="" id="" required="" readonly="" value="<?php echo "Rp. ".number_format($invoice->invoicePartnerPrice);?>">
                    </div>
                    <div class="col-md-12 p-r-20 p-l-20 form-group">
                        <label>Upload Bukti Transfer</label>
                        <input class="form-control" type="file" name="slip" id="slip" placeholder="Bukti Transfer" required="" onchange="preview();">
                        <hr>
                        <img id="slippreview" style="width: 50%; height: 50%;"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-block subs_btn form-control" type="submit" onclick="confirmPayment();">
                        Konfirmasi Sudah Bayar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php echo $footer; ?>
<script>
    function preview() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("slip").files[0]);
        oFReader.onload = function (oFREvent) {
            document.getElementById("slippreview").src = oFREvent.target.result;
        };
    }
</script>
</body>
</html>