<?php echo $header; ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/') ?>css/voucher.css">
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(<?php echo site_url('asset/img/uploads/banner/' . $bannertitlepage->image . '') ?>);">
    <h2 class="l-text2 t-center m-text-glow">
        Voucher
    </h2>
</section>
<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-20">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Voucher
    </span>
</div>
<section class="blog bgwhite p-t-10 p-b-45">
    <div class="container">
        <div class="row bg5">
            <div class="container blue-bg">
                <div class="col-md-9">
                <h3 class="m-text5 t-center">
                    VOUCHER DISKON
                </h3>
                <br/>
                    <h2 class="section-heading"></h2>
                    <?php foreach ($voucherlist as $value) { ?>
                        <div class="coupons-list">
                            <div class="store-offer-item shadow-box">
                                <div class="store-thumb-link">
                                    <div class="offer-image">
                                        <a href="javascript:void(0);"><img src="<?php echo site_url('asset/img/uploads/banner/' . $logo->image . ''); ?>" alt="Voucher <?php echo $profile->companyName; ?>" title="voucher <?php echo $profile->companyName; ?>"></a>
                                    </div>
                                </div>
                                <div class="latest-coupon">
                                    <input type="text" readonly value="<?php echo $value->voucherCode; ?>" id="myvoucher<?php echo $value->idvoucher; ?>">
                                    <h3 class="coupon-title"><a href="javascript:void(0);"><?php echo $value->voucherName; ?></a></h3>
                                    <div class="coupon-des">
                                        <?php echo $value->voucherDescription; ?>
                                    </div>
                                </div>
                                <div class="coupon-detail coupon-button-type">
                                    <a href="javascript:void(0);" id="myTooltip" class=" tooltiptextcoupon-button coupon-code"  onclick="copyVoucher('<?php echo $value->idvoucher; ?>');">
                                        <span class="code-text "><?php echo $value->voucherCode; ?></span>
                                    </a>
                                    <div class="exp-text">Expires <?php echo date_ind($value->endDate); ?></div>
                                </div>

                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo $footer; ?>
<script>
    function copyVoucher(id) {
        var copyText = document.getElementById("myvoucher" + id);
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
        swal("", "voucher " + copyText.value + " copied", "success");
    }
</script>
</body>
</html>