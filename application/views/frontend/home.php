<?php echo $header_home; ?>
<?php if (!empty($datapopup)) { ?>
    <div class="bts-popup" role="alert">
        <div class="bts-popup-container">
            <?php if ($datapopup->popupType == "Image Only") { ?>
                <img class="image-replace" src="<?php echo base_url('asset/img/uploads/popup/' . $datapopup->popupImage . ''); ?>" alt="" width="100%" height="100%" />
            <?php } elseif ($datapopup->popupType == "Text Only") { ?>
                <p><?php echo $datapopup->popupText; ?></p>
            <?php } elseif ($datapopup->popupType == "Header Image And Bottom Text") { ?>
                <img class="image-replace" src="<?php echo base_url('asset/img/uploads/popup/' . $datapopup->popupImage . ''); ?>" alt="" width="100%" height="100%" />
                <p><?php echo $datapopup->popupText; ?></p>
            <?php } ?>
            <?php if ($datapopup->statusButton == "show") { ?>
                <div class="bts-popup-button">
                    <a href="<?php echo base_url('pages/product/search?category=0&price=asc&group='); ?>">Shop Now</a>
                </div>
            <?php } ?>
            <a href="#0" class="bts-popup-close img-replace">Close</a>
        </div>
    </div>
<?php } ?>
<section class="slide1">
    <div class="wrap-slick1">
        <div class="slick1">
            <?php
            $i = 1;
            foreach ($bannerhome as $value) {
                ?>
                <div class="item-slick1 item<?php echo $i++; ?>-slick1" style="background-image: url(<?php echo site_url('asset/img/uploads/banner/' . $value->image . '') ?>);">
                    <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-30">
                        <h4 class="caption1-slide1 t-center bo14 p-b-6 animated visible-false m-text-glow m-b-22" data-appear="fadeInUp">
                            <?php echo $value->bannerText; ?>
                        </h4>
                        <div class="wrap-btn-slide1 w-size2 animated visible-false" data-appear="zoomIn">
                            <a href="<?php echo base_url('pages/product/search?category=0&price=asc&group=') ?>" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4 bo17">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<div class="banner bgwhite p-t-20 p-b-40">
    <div class="container">
        <div class="row">
            <?php foreach ($bannerftop as $value) { ?>
                <div class="col-sm-10 col-md-4 p-t-30 p-b-10 m-l-r-auto">
                    <div class="block3">
                        <div class="block3-img dis-block hov-img-zoom bo18">
                            <img src="<?php echo site_url('asset/img/uploads/banner/' . $value->image . '') ?>" alt="IMG-BLOG">
                        </div>
                        <div class="block1-wrapbtn w-size2">
                            <a href="<?php echo base_url('pages/product/search?category=' . $value->bannerLink . '&price=asc&group='); ?>" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4 bo17">
                                <?php echo $value->bannerText; ?> 
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php if (!empty($productsale)) { ?>
    <section class="newproduct p-t-10 p-b-10 bggray">
    <div class="container">
        <div class="sec-title p-b-20">
            <h3 class="m-text-flash">
                FLASH DEAL
            </h3>
            <h3 class="m-text-countdown" id="countdown">Berakhir dalam</h3>
            <input id="lastsale" value="<?php echo date("M d, Y", strtotime($lastsale->endDate)); ?> 24:00:00" type="hidden">
        </div>
        <div class="wrap-slick4">
            <div class="slick4">
                <?php foreach ($productsale as $value) { ?>
                    <div class="item-slick4 p-l-15 p-r-15">
                        <div class="block2 card">
                            <?php if ($value->pricesale != "") { ?>
                                <div class="block2-img wrap-pic-w of-hidden hov-img-zoom pos-relative block2-labelsale">
                                    <span class="sale-precent-blok">
                                        <?php echo floor(($value->price - $value->pricesale) / $value->price * 100) . " % OFF"; ?>
                                    </span>
                                <?php } else { ?>
                                    <div class="block2-img wrap-pic-w of-hidden hov-img-zoom pos-relative block2-labelnew">
                                    <?php } ?>
                                    <img src="<?php echo site_url('asset/img/uploads/product/' . $value->fotoName . '') ?>" class="bo18" alt="<?php echo $value->productName;?>">

                                    <div class="block2-overlay trans-0-4">
                                        <div class="block2-btn-addcart w-size1-product trans-0-4">
                                            <button onclick="window.location.href = '<?php echo base_url('pages/product-detail/' . $value->postSlug . '') ?>'" class="flex-c-m size1 bo-rad-23 bgwhite hov1 trans-0-4 bo17 s-text2 trans-0-4">
                                                Beli
                                            </button>
                                        </div>
                                    </div> 
                                </div>
                                <div class="block2-txt p-t-20">
                                    <a href="<?php echo base_url('pages/product-detail/' . $value->postSlug . '') ?>" class="block2-name dis-block s-text3-product p-b-5">
                                        <?php echo substr($value->productName, 0, 18). "...";?>
                                    </a>
                                    <?php if ($value->pricesale != "") { ?>
                                        <div class="text-center">
                                            <span class="block2-oldprice m-text7 text-center">
                                                <?php echo "Rp. " . number_format($value->price); ?>
                                            </span>
                                            <span class="block2-newprice m-text6 text-center">
                                                <?php echo "Rp. " . number_format($value->pricesale); ?>
                                            </span>
                                        </div>
                                    <?php } else { ?>
                                        <div class="text-center">
                                            <span class="block2-price m-text6 text-center">
                                                <?php echo " Rp. " . number_format($value->price); ?>
                                            </span>
                                        </div>
                                    <?php } ?>
                                    <?php if($value->volunteer != 0){?>
                                        <div class="text-center">
                                            <span class="block2-price m-text6 text-center">
                                                <input id="rating" value="<?php echo $value->rating; ?>" class="rating-loading ratingbar" data-step="1" data-size="xs" readonly=""> 
                                            </span>
                                        </div>
                                    <?php }else {echo"<br>";}?>
                                    <div class="text-center">
                                            <span class="m-text-stock text-center">
                                                <?php echo number_format($value->quantityStock); ?> Tersisa
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="sec-title p-t-30">
                <h3 class="m-text5-arrow t-center">
                    <i class="fa fa-angle-double-down animated ani"></i>
                </h3>
                <h3 class="m-text5-arrow t-center">
                    <a href="<?php echo base_url('pages/product/search?category=0&price=ASC&group=sale') ?>" class="p-t-5 p-b-5 p-l-5 p-r-5 bo-rad-10 bg-green">Lihat Semua </a>
                </h3>
            </div>
        </div>
    </section>
<?php } ?>

<section class="newproduct bgwhite p-t-30 p-b-35">
    <div class="container">
        <div class="sec-title-centered p-b-60">
            <h3 class="m-text5-glow t-center text-headline">
                New Arrivals
            </h3>
        </div>
        <div class="wrap-slick2">
            <div class="slick2">
                <?php foreach ($newarrival as $value) { ?>
                    <div class="item-slick2 p-l-15 p-r-15">
                        <div class="block2 card mx-auto">
                            <?php if ($value->pricesale != "") { ?>
                                <div class="block2-img wrap-pic-w of-hidden hov-img-zoom pos-relative block2-labelsale">
                                    <span class="sale-precent-blok">
                                        <?php echo floor(($value->price - $value->pricesale) / $value->price * 100) . " % OFF"; ?>
                                    </span>
                                <?php } else { ?>
                                    <div class="block2-img wrap-pic-w of-hidden hov-img-zoom pos-relative block2-labelnew">
                                    <?php } ?>
                                    <img src="<?php echo site_url('asset/img/uploads/product/' . $value->fotoName . '') ?>" class="bo18" alt="<?php echo $value->productName;?>">

                                    <div class="block2-overlay trans-0-4">
                                        <div class="block2-btn-addcart w-size1-product trans-0-4">
                                            <button onclick="window.location.href = '<?php echo base_url('pages/product-detail/' . $value->postSlug . '') ?>'" class="flex-c-m size1 bo-rad-23 bgwhite hov1 trans-0-4 bo17 s-text2 trans-0-4">
                                                Beli
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="block2-txt p-t-20">
                                    <a href="<?php echo base_url('pages/product-detail/' . $value->postSlug . '') ?>" class="block2-name dis-block s-text3-product p-b-5">
                                        <?php echo substr($value->productName, 0, 18). "...";?>
                                    </a>
                                    <?php if ($value->pricesale != "") { ?>
                                        <div class="text-center">
                                            <span class="block2-oldprice m-text7 text-center">
                                                <?php echo "Rp. " . number_format($value->price); ?>
                                            </span>
                                            <span class="block2-newprice m-text6 text-center">
                                                <?php echo "Rp. " . number_format($value->pricesale); ?>
                                            </span>
                                        </div>
                                    <?php } else { ?>
                                        <div class="text-center">
                                            <span class="block2-price m-text6 text-center">
                                                <?php echo " Rp. " . number_format($value->price); ?>
                                            </span>
                                            <br>
                                        </div>
                                    <?php } ?>
                                    <?php if($value->volunteer != 0){?>
                                        <div class="text-center">
                                            <span class="block2-price m-text6 text-center">
                                                <input id="rating" value="<?php echo $value->rating; ?>" class="rating-loading ratingbar" data-step="1" data-size="xs" readonly=""> 
                                            </span>
                                        </div>
                                    <?php }else{echo"<br>";} ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="sec-title p-t-30">
            <h3 class="m-text5-arrow t-center">
                <i class="fa fa-angle-double-down animated ani"></i>
            </h3>
            <h3 class="m-text5-arrow t-center">
                <a href="<?php echo base_url('pages/product/search?category=0&price=ASC&group=new') ?>" class="p-t-5 p-b-5 p-l-5 p-r-5 bo-rad-10 bg-green">Lihat Semua </a>
            </h3>
        </div>
    </div>
</section>



<section class="newproduct bgwhite p-t-30 p-b-35">
    <div class="container">
        <div class="sec-title-centered p-b-60">
            <h3 class="m-text5-glow t-center text-headline">
                Product Bestseller
            </h3>
        </div>
        <div class="wrap-slick5">
            <div class="slick5">
                <?php foreach ($productbest as $value) { ?>
                    <div class="item-slick5 p-l-15 p-r-15">
                        <div class="block2 card">
                            <?php if ($value->pricesale != "") { ?>
                                <div class="block2-img wrap-pic-w of-hidden hov-img-zoom pos-relative block2-labelsale">
                                    <span class="sale-precent-blok">
                                        <?php echo floor(($value->price - $value->pricesale) / $value->price * 100) . " % OFF"; ?>
                                    </span>
                                <?php } else { ?>
                                    <div class="block2-img wrap-pic-w of-hidden hov-img-zoom pos-relative block2-labelnew">
                                    <?php } ?>
                                    <img src="<?php echo site_url('asset/img/uploads/product/' . $value->fotoName . '') ?>" class="bo18" alt="<?php echo $value->productName;?>">

                                    <div class="block2-overlay trans-0-4">
                                        <div class="block2-btn-addcart w-size1-product trans-0-4">
                                            <button onclick="window.location.href = '<?php echo base_url('pages/product-detail/' . $value->postSlug . '') ?>'" class="flex-c-m size1 bo-rad-23 bgwhite hov1 trans-0-4 bo17 s-text2 trans-0-4">
                                                Beli
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="block2-txt p-t-20">
                                    <a href="<?php echo base_url('pages/product-detail/' . $value->postSlug . '') ?>" class="block2-name dis-block s-text3-product p-b-5">
                                        <?php echo substr($value->productName, 0, 18). "...";?>
                                    </a>
                                    <?php if ($value->pricesale != "") { ?>
                                        <div class="text-center">
                                            <span class="block2-oldprice m-text7 text-center">
                                                <?php echo "Rp. " . number_format($value->price); ?>
                                            </span>
                                            <span class="block2-newprice m-text6 text-center">
                                                <?php echo "Rp. " . number_format($value->pricesale); ?>
                                            </span>
                                        </div>
                                    <?php } else { ?>
                                        <div class="text-center">
                                            <span class="block2-price m-text6 text-center">
                                                <?php echo " Rp. " . number_format($value->price); ?>
                                            </span>
                                        </div>
                                    <?php } ?>
                                    <?php if($value->volunteer != 0){?>
                                        <div class="text-center">
                                            <span class="block2-price m-text6 text-center">
                                                <input id="rating" value="<?php echo $value->rating; ?>" class="rating-loading ratingbar" data-step="1" data-size="xs" readonly=""> 
                                            </span>
                                        </div>
                                    <?php }else{echo "<br>";} ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="sec-title p-t-30">
            <h3 class="m-text5-arrow t-center">
                <i class="fa fa-angle-double-down animated ani"></i>
            </h3>
            <h3 class="m-text5-arrow t-center">
                <a href="<?php echo base_url('pages/product/search?category=0&price=ASC&group=best') ?>" class="p-t-5 p-b-5 p-l-5 p-r-5 bo-rad-10 bg-green">Lihat Semua </a>
            </h3>
        </div>
    </div>
</section>

<hr>
    <section class="shipping bgwhite p-t-30 p-b-35">
        <div class="flex-w p-l-15 p-r-15">
            <?php
            if (!empty($footertagline)) {
                foreach ($footertagline as $value) {
                    ?>
                    <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
                        <h4 class="m-text12 t-center">
                            <img src="<?php echo base_url('asset/img/uploads/footer/'.$value->icon.'');?>">
                            <br>
                            <?php echo $value->taglineTitle; ?>
                        </h4>
                        <span class="s-text11 t-center">
                            <?php echo $value->taglineDescription; ?>
                        </span>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </section>
        <?php echo $footer; ?>
        <?php if (!empty($productsale)) { ?>
            <script type="text/javascript" src="<?php echo base_url('asset/') ?>vendors/countdowntime/countdowntime.js"></script>
        <?php } ?>
        <?php if ($this->session->flashdata('MSG')) { ?>
            <?= $this->session->flashdata('MSG') ?>
        <?php } ?>
        <?php if (!empty($datapopup)) { ?>
            <script>
                jQuery(document).ready(function ($) {
                    window.onload = function () {
                        $(".bts-popup").delay(1000).addClass('is-visible');
                    }
                    $('.bts-popup-trigger').on('click', function (event) {
                        event.preventDefault();
                        $('.bts-popup').addClass('is-visible');
                    });
                    $('.bts-popup').on('click', function (event) {
                        if ($(event.target).is('.bts-popup-close') || $(event.target).is('.bts-popup')) {
                            event.preventDefault();
                            $(this).removeClass('is-visible');
                        }
                    });
                    $(document).keyup(function (event) {
                        if (event.which == '27') {
                            $('.bts-popup').removeClass('is-visible');
                        }
                    });
                });
            </script>
        <?php } ?>
    </body>
    </html>