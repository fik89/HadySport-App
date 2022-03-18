<?php echo $header; ?>
<div class="bread-crumb-detail bgwhite flex-w p-l-52 p-r-15 p-t-50 p-l-15-sm">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Checkout
    </span>
</div>
<section class="bgwhite p-t-20 p-b-100">
    <div class="container">
        <?php if ($this->session->flashdata('MSG')) { ?>
            <?= $this->session->flashdata('MSG') ?>
        <?php } ?>
        <div class="bo17 w-size18 p-l-20 p-r-20 p-t-20 p-b-38 m-t-30 m-r-0 m-l-r-auto p-lr-15-sm">
            <form action="<?php echo base_url('Invoice/update_bank_invoice_partner'); ?>" method="post">
                <input type="hidden" value="<?php echo $cart->idinvoicepartner; ?>" name="idinvoicepartner">
                <input type="hidden" value="<?php echo $cart->iduser; ?>" name="iduser">
                <h5 class="bo18 m-b-20 p-b-20">
                    Cart Totals
                    <span class="text-right pull-right">#<?php echo $cart->idinvoicepartner; ?></span>
                </h5>
                <div class="flex-w flex-sb-m p-b-12">
                    <span class="s-text18 w-size19 w-full-sm">
                        Keterangan :
                    </span>
                    <span class="m-text28 w-size20 w-full-sm">
                        <?php echo $cart->invoicePartnerDescription; ?>
                    </span>
                    <span class="s-text18 w-size19 w-full-sm">
                        Subtotal:
                    </span>
                    <span class="m-text22 w-size20 w-full-sm">
                        <?php echo "Rp. " . number_format($cart->invoicePartnerPrice) . ""; ?>
                    </span>
                </div>
                <div class="flex-w flex-sb bo10 p-t-15 p-b-20">
                    <span class="s-text18 w-size19 w-full-sm">
                        Metode Pembayaran:
                    </span>
                    <div class="w-size20 w-full-sm">
                        <br>
                        <p class="s-text19">
                            Transfer Bank
                        </p>
                        <div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
                            <select class="form-control" name="bank" required="">
                                <option selected="" disabled="" value="">Pilih Bank</option>
                                <?php foreach ($bank as $value) { ?>
                                    <option value="<?php echo $value->idbank; ?>"><?php echo $value->bankName; ?></option>
                                <?php } ?>]
                            </select>
                        </div>
                    </div>
                </div>
                <div class="flex-w flex-sb-m p-t-26 p-b-30">
                    <span class="m-text22 w-size19 w-full-sm">
                        Total:
                    </span>

                    <span class="m-text22 w-size20 w-full-sm">
                        <?php echo "Rp. " . number_format($cart->invoicePartnerPrice) . ""; ?>
                    </span>
                </div>

                <div class="size15 trans-0-4">
                    <button class="btn btn-block subs_btn form-control" type="submit">
                        Checkout <i class="fa fa-angle-double-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
<?php echo $footer; ?>
<script type="text/javascript" src="<?php echo site_url('asset/') ?>vendors/select2/select2.min.js"></script>
<script type="text/javascript">
    $(".selection-1").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });

    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect2')
    });
</script>
</body>
</html>