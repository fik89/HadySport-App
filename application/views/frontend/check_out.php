<?php echo $header; ?>
<style>

</style>
<div class="bread-crumb-detail bgwhite flex-w p-l-52 p-r-15 p-t-20 bg5">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <a href="JavaScript:void(0);" class="s-text16">
        Checkout
    </a>
</div>
<section class="bg5 p-t-30 p-b-100">
    <div class="container">
        <div class="col-lg-6 m-t-0 m-r-0 m-l-r-auto p-lr-15-sm">
            <div class="row">
                <?php if ($this->session->flashdata('MSG')) { ?>
                    <?= $this->session->flashdata('MSG') ?>
                <?php }
                $now = date('Y-m-d H:i:s');
                if (!empty($orderresult)) {
                    if($orderresult->dueDate < $now){
                        echo '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Order Gagal</strong>, Anda telah melebihi batas waktu untuk melakukan pembayaran.</div>';
                    }
                }
                ?>
                <div>
                    <div class="checkout__header">
                        <div class="checkout__logo-wrapper">
                            <img src="<?php echo site_url('asset/img/uploads/banner/' . $logo->image . ''); ?>" alt="<?php echo $profile->companyName; ?>" style="width: 60%;">
                        </div>

                        <div class="checkout__header-info">
                            <span class="checkout__date"><?php
                            if (!empty($orderresult)) {
                                echo date_ind($orderresult->invoiceDate);
                            }
                            ?></span>
                            <span class="checkout__ref">
                                ID Order : 
                                <?php
                                if (!empty($orderresult)) {
                                    echo $orderresult->idorder;
                                }
                                ?></span>
                            </div>
                        </div>

                        <div class="checkout__subheader-wrapper">
                            <div class="checkout__subheader">
                                <h1 class="checkout__username"> <?php
                                if (!empty($orderresult)) {
                                    echo $orderresult->username;
                                }
                                ?>, Hi</h1>
                                <span class="checkout__help-text">Order Anda Berhasil di buat, Segera lakukan pembayaran sebelum</span>
                                <br>
                            </div>
                            <?php
                            if (!empty($orderresult)) {
                                if ($orderresult->invoiceStatus == 'canceled') {
                                    echo '<div class="p-t-20">
                                        <button class="btn btn-danger btn-block">Order telah dibatalkan</button>
                                    </div>';
                                }else if ($orderresult->invoiceStatus != 'PAID' && $orderresult->invoiceStatus != 'process shiping') {
                                    ?>
                                    <h4 class="m-text-countdown-checkout text-center">
                                        <span id="countdown"></span><br>
                                        <small class="text-info"><?php echo date_ind($orderresult->dueDate); ?></small>
                                    </h4>
                                    <input id="lastsale" value="<?php echo date("M d, Y", strtotime($orderresult->dueDate)); ?> <?php echo get_time($orderresult->dueDate); ?>" type="hidden">
                                    <?php
                                } else {
                                    echo '<h4 class="text-success text-center">Sudah Terkonfirmasi</h4>';
                                }
                            }
                            ?>
                        </div>

                        <div class="checkout__cart">
                            <h2 class="checkout__cart-title">Cart:</h2>

                            <ul class="checkout__cart-list">
                                <li class="checkout__cart-item">
                                    <span class="checkout__index">1</span>
                                    <span class="checkout__item-name">Total Belanja</span>
                                    <span class="checkout__item-price">Rp. <?php
                                    if (!empty($orderresult)) {
                                        echo number_format($orderresult->cartTotal);
                                    }
                                    ?></span>
                                </li>

                                <li class="checkout__cart-item">
                                    <span class="checkout__index">2</span>
                                    <span class="checkout__item-name">Jasa Pengiriman</span>
                                    <span class="checkout__item-price">Rp. <?php
                                    if (!empty($orderresult)) {
                                        echo number_format($orderresult->totalShiping);
                                    }
                                    ?></span>
                                </li>

                                <li class="checkout__cart-item">
                                    <span class="checkout__index">3</span>
                                    <span class="checkout__item-name">Voucher</span>
                                    <span class="checkout__item-price text-danger">Rp. (-<?php
                                        if (!empty($orderresult)) {
                                            echo number_format($orderresult->voucherPrice);
                                        }
                                        ?>)
                                    </span>
                                </li>

                                <li class="checkout__cart-item">
                                    <span class="checkout__index">4</span>
                                    <span class="checkout__item-name">Discount Partner</span>
                                    <span class="checkout__item-price text-danger">Rp. (-<?php
                                        if (!empty($orderresult)) {
                                            echo number_format($orderresult->partnerDiscount);
                                        }
                                        ?>)
                                    </span>
                                </li>

                                <li class="checkout__cart-item">
                                    <span class="checkout__index">5</span>
                                    <span class="checkout__item-name">Ppn (10%)</span>
                                    <span class="checkout__item-price">Rp. <?php
                                    if (!empty($orderresult)) {
                                        echo number_format($orderresult->tax);
                                    }
                                    ?>

                                </span>
                            </li>

                            <li class="checkout__cart-item">
                                <span class="checkout__item-name">Kode Uniq</span>
                                <span class="checkout__item-price text-info">
                                    <?php
                                    if (!empty($orderresult)) {
                                        $countstr = strlen($orderresult->orderSumary);
                                        echo "Rp. " . number_format(substr($orderresult->orderSumary, $countstr - 3));
                                    }
                                    ?>
                                </span>
                            </li>

                            <li class="checkout__cart-item">
                                <span class="checkout__cart-total">Total yang harus dibayar</span>
                                <h4 class="checkout__item-price">
                                    <b><u>Rp. <?php
                                    if (!empty($orderresult)) {
                                        echo number_format($orderresult->orderSumary);
                                    }
                                    ?></u></b>
                                </h4><br>
                                <small>Transfer tepat sampai 3 digit terakhir (tidak dibulatkan). Perbedaan nominal menghambat proses verifikasi.</small>
                            </li>
                        </ul>
                    </div>

                    <div class="checkout__footer">
                        <h6 class="text-center font-weight-bold p-b-10">Silahkan melakukan pembayaran dengan Transfer ke rekening Bank di bawah ini</h6>
                        <div class="checkout__header bo9">
                            <div class="checkout__logo-wrapper">
                                <img src="<?php 
                                if (!empty($orderresult)) {
                                    echo base_url('asset/img/icons/icon_' . $orderresult->bankName . '.svg');} ?>" style="width: 55%;">
                                </div>
                                <div class="checkout__header-info">
                                    <span class="checkout__date font-weight-bold">
                                        <?php
                                        if (!empty($orderresult)) {
                                            echo $orderresult->bankName;
                                        }
                                        ?>
                                    </span>
                                    <span class="checkout__ref font-weight-bold bg5 text-headline">
                                        <?php
                                        if (!empty($orderresult)) {
                                            echo $orderresult->accountNumber;
                                        }
                                        ?>
                                    </span>
                                    <span class="checkout__ref font-weight-bold">
                                        Atas nama :
                                        <?php
                                        if (!empty($orderresult)) {
                                            echo $orderresult->accountName;
                                        }
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <?php
                            if (!empty($orderresult)) {

                                if ($orderresult->invoiceStatus == 'canceled') {
                                    echo '<div class="p-t-20">
                                        <button class="btn btn-danger btn-block">Order telah dibatalkan</button>
                                    </div>';
                                }else if ($orderresult->invoiceStatus != 'PAID' && $orderresult->invoiceStatus != 'process shiping') {
                                    ?>
                                    <div class="p-t-20" id="btn-confirm">
                                        <button class="btn btn-success btn-block" data-toggle="modal" data-target="#modalPayment">Konfirmasi Pembayaran</button>
                                    </div>
                                    <a class="text-center text-danger" href="javascript:void(0);" onclick="cancel_order('<?php echo encryption($orderresult->idorder);?>');">
                                        <i class="fa fa-close"></i> Batalkan Pesanan ini
                                    </a>
                                <?php }
                            }
                            ?>
                        </div>
                        <?php
                        if (!empty($orderresult)) {
                            if ($orderresult->invoiceStatus == 'PAID') {
                                ?>
                                <div class="checkout__footer">
                                    <a href="">Lihat / Cetak Invoice</a>
                                </div>
                            <?php }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (!empty($orderresult)) { ?>
            <div class="modal fade" id="modalPayment">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form class="login_form" action="<?php echo base_url('Invoice/confirm_payment_order') ?>" method="post" accept-charset="UTF-8" enctype="multipart/form-data">

                            <div class="modal-header bg-dark text-white text-center">
                                <h6>Konfirmasi Pembayaran</h6>
                                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="idinvoice" value="<?php echo $orderresult->idinvoice; ?>">
                                <input type="hidden" name="idorder" value="<?php echo $orderresult->idorder; ?>">
                                <div class="col-md-12 p-r-20 p-l-20 form-group">
                                    <label>Transfer ke Bank</label>
                                    <input class="form-control" type="text" name="bankname" id="bankname" value="<?php echo $orderresult->paymentMethod; ?>" readonly="">
                                </div>
                                <div class="col-md-12 p-r-20 p-l-20 form-group">
                                    <label>Total Pembayaran</label>
                                    <input class="form-control" type="text" name="" id="" required="" readonly="" value="<?php echo "Rp. " . number_format($orderresult->invoicePrice); ?>">
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
        <?php } ?>
    </section>
    <?php echo $footer; ?>
    <script type="text/javascript" src="<?php echo base_url('asset/') ?>vendors/countdowntime/countdowntimecheckout.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#loadingpage').hide();
            $('#loadingbutton').hide();
        });
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

          function cancel_order(id) {
            swal({
                title: "",
                text: "Batalkan Order ini ?",
                type: "warning",
                showCancelButton: true, 
                showLoaderOnConfirm: true,
                confirmButtonColor: "#ff0000",
                confirmButtonText: "Cancel Order",
                cancelButtonText: "Batal",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                function (isConfirm) {
                    if (isConfirm) {
                        $('#loader').show();
                        $.ajax({
                            url: '<?php echo base_url('Order/cancel_order'); ?>',
                            method: "POST",
                            data: {"id":id},
                            dataType: "json",
                            accepts: {
                                json: 'application/json'
                            },
                            success: function (response) {
                                if (response.status === '0') {
                                    swal("error", "" + response.message + "", "error");
                                } else {
                                     swal({
                                        title: "",
                                        text: ""+response.message+"",
                                        type: "warning",
                                        showCancelButton: false,
                                        confirmButtonColor: "#5cb85c",
                                        confirmButtonText: "OK",
                                        closeOnConfirm: false,
                                        closeOnCancel: false
                                    },
                                            function (isConfirm) {
                                                if (isConfirm) {
                                                    location.href="<?php echo base_url('pages/profile');?>";
                                                }
                                        });

                                }
                                Pace.stop();
                                $('#loader').hide();
                            }
                        });
                    } else {
                        swal("", "", "error");
                    }
                });
        }
    </script>
</body>
</html>