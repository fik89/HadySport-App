<?php echo $header; ?>
<div class="bread-crumb-detail bgwhite flex-w p-l-52 p-r-15 p-t-50">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <a href="<?php echo base_url('pages/cart?idorder=' . $detailorder->idorder . '') ?>" class="s-text16">
        Keranjang Belanja
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <a href="<?php echo base_url('pages/cart/form-customer?idorder=' . $detailorder->idorder . '') ?>" class="s-text16">
        Data Pembeli
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <a href="<?php echo base_url('pages/cart/shiping?idorder=' . $detailorder->idorder . '') ?>" class="s-text16">
        Metode Pengiriman
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Metode Pembayaran
    </span>
</div>
<section class="cart bgwhite p-t-30 p-b-100">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="login_title form-customer">
                    <h6>Data Penerima Barang</h6>
                </div>
                <table class="table bo9 bg5">
                    <tbody>
                        <tr>
                            <td><small>Nama Penerima</small></td>
                            <td><small> <?php echo $detailorder->firstName . " " . $detailorder->lastName; ?></small></td>
                        </tr>
                        <tr>
                            <td><small>Alamat</small></td>
                            <td><small><?php echo $detailorder->desa . ", " . $detailorder->rt . "-" . $detailorder->rw . ", " . $detailorder->kecamatan . ", " . $detailorder->namaKabupaten . ", " . $detailorder->namaProvinsi . ", " . $detailorder->kodePos; ?></small></td>
                        </tr>
                        <tr>
                            <td><small>Kontak</small></td>
                            <td><small>E-mail: <?php echo $detailorder->custEmail . ", Telepon :" . $detailorder->custHp; ?></small></td>
                        </tr>
                    </tbody>
                </table>
                <div class="login_title form-customer">
                    <h6>Transfer Via Bank</h6>
                </div>
                <form class="login_form row form-customer bo20" action="<?php echo base_url('Order/store_payment?idorder=' . $detailorder->idorder . '') ?>" method="post">
                    <input type="hidden" name="ordersumary" value="<?php echo $ordershiping->totalPrice;?>">
                    <input type="hidden" name="voucher" value="<?php echo $detailorder->voucherPrice;?>">
                    <div class="col-md-6 form-group">
                        <select class="form-control" id="bank" name="bank" required="">
                            <option selected disable value=""> Pilih Bank </option>
                            <?php foreach ($bank as $value) { ?>
                                <option value="<?php echo $value->idbank ?>"><?php echo $value->bankName; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-6 form-group">
                        <a href="<?php echo base_url('pages/cart/shiping?idorder=' . $detailorder->idorder . ''); ?>"><i class="fa fa-angle-double-left p-r-10"></i> Kembali ke Metode Pengiriman</a>
                    </div>
                    <div class="col-md-6 form-group">
                        <button type="submit" value="submit" class="btn subs_btn form-control" onclick="">Order Sekarang <i class="fa fa-angle-double-right"></i></button>
                    </div>
                </form>

                <div class="flex-w flex-sb-m p-t-25 p-b-25 bo17 p-l-35 p-r-60 p-lr-15-sm m-t-30">
                    <div class="size11 bo4 m-r-10">
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="vouchercode" id="vouchercode" placeholder="Kode Voucher (case sensitive)" required="">
                    </div>
                    <div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
                        <button onclick="applyVoucher();" class="flex-c-m sizefull bg-brown bo-rad-23 hov1 s-text1 trans-0-4">
                            Apply
                        </button>
                    </div>
                    <div id="voucher">
                    </div> 
                </div>
            </div>
            <div class="bo9 col-md-5 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 bg5">
                <h5 class="p-b-24 bo20">
                    Keranjang Belanja
                </h5>

                <div class="flex-w flex-sb-m p-b-12 bo20">
                        <table>
                    <?php foreach ($this->cart->contents() as $items) { ?>
                            <tr>
                                <th class="p-r-10"><small>(<?php echo $items['qty']; ?>)</small></th>
                                <td class="p-r-10"><small> <?php echo $items['name']; ?></small></td>
                                <td><small>Rp. <?php echo number_format($items['subtotal']); ?></small></td>
                            </tr>
                    <?php } ?>
                        </table>
                </div>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                        <table>
                            <tr>
                                <th class="p-r-20"><small>Jumlah Pesanan</small></th>
                                <td><small><?php echo array_sum(array_column($this->cart->contents(), 'qty'));?> pcs</small></td>
                            </tr>
                            <tr>
                                <th class="p-r-20"><small>Jumlah Berat (KG)</small></th>
                                <td><small><?php echo ceil(($detailorder->totalWeight)/1000); ?> Kg</small></td>
                            </tr>
                        </table>
                </div>
              <div class="flex-w flex-sb-m p-b-12">
                    <span class="s-text18 w-size19 w-full-sm">
                        Subtotal:
                    </span>

                    <span class="w-full-sm">
                        <?php echo "Rp. " . number_format($this->cart->total()); ?>
                    </span>
                </div>

                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <span class="s-text18 w-size19 w-full-sm">
                        Ongkos Kirim :
                    </span>

                    <span class="w-full-sm">
                        Rp. <?php echo number_format($ordershiping->shipingCarge) . "  (" . $ordershiping->shipingName . ")"; if (empty($ordershiping->shipingCarge)){echo '<small><i>selesaikan proses</i></small>';}?> 
                    </span>
                </div>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <span class="s-text18 w-size19 w-full-sm">
                        Voucher : 
                    </span>

                    <span class="w-full-sm">
                        Rp. <?php echo number_format($orderresult->voucherPrice); if(empty($orderresult->voucherPrice)){echo '<small><i>Input Voucher</i></small>';} ?> 
                        <?php if($orderresult->voucherPrice != 0){?>
                            <button class="text-danger" onclick="removeVoucher('<?php echo $detailorder->idvoucher;?>');"><i class="fa fa-close"></i></button>
                        <?php } ?>
                    </span>
                </div>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <span class="s-text18 w-size19 w-full-sm">
                        Discount Partner : 
                    </span>

                    <span class="w-full-sm">
                        Rp. <?php
                        echo number_format($orderresult->partnerDiscount);
                        if (empty($orderresult->partnerDiscount)) {
                            echo '<small><i>silahkan login</i></small>';
                        }
                        ?> 
                    </span>
                </div>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <span class="s-text18 w-size19 w-full-sm">
                        Total
                    </span>

                    <span class="w-full-sm">
                        <?php echo "Rp. " . number_format($orderresult->orderSumary); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<?php echo $footer; ?>

<?php if ($this->session->flashdata('MSG')) { ?>
    <?= $this->session->flashdata('MSG') ?>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function () {
    });

    function applyVoucher() {
        var voucher = $('#vouchercode').val();
        var totalprice = <?php echo $this->cart->total(); ?>;
        if (voucher === "") {
            document.getElementById("vouchercode").focus();
        } else {
            $('#voucher').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading color0"></i>');
            $.ajax({
                url: "<?php echo site_url('d/Marketing/search_code_voucher'); ?>",
                method: "POST",
                data: {voucher: voucher, totalprice:totalprice},
                success: function (data) {
                    $('#voucher').html(data);
                    $('.loading').remove();
                }
            });
        }
    }

    function useVoucher(value, id) {
        var voucher = value;
        var idvoucher = id;
        var subtotal = '<?php echo $this->cart->total(); ?>';
        var idorder = '<?php echo $detailorder->idorder; ?>';
        $('#voucher').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading color0"></i>');
        $.ajax({
            url: "<?php echo site_url('Order/use_voucher'); ?>",
            method: "POST",
            data: {voucherprice: voucher, subtotal: subtotal, idorder: idorder, idvoucher: idvoucher},
            success: function () {
                window.location.reload();
                $('.loading').remove();
            }
        });
    }
    
    function removeVoucher(idvoucher){
        var idorder = '<?php echo $orderresult->idorder; ?>';
        swal({
            title: "Hapus Voucher ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "<?php echo site_url('Order/remove_voucher'); ?>",
                    method: "POST",
                    data: {idvoucher: idvoucher, idorder: idorder},
                    success: function (data) {
                        if(data == 'Sukses')
                        {
                            swal("Terhapus!", "", "success");  
                            window.location.reload();       
                        }
                        else
                        {
                            swal("", "", "error");         
                        }    
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