<?php echo $header_detail; ?>
<?php if (!empty($fbcomment)) { ?>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v3.2&appId=<?php echo $fbcomment->widgetScriptId; ?>&autoLogAppEvents=1"></script>
<?php } ?>
<div class="bread-crumb-detail-product bgwhite flex-w p-l-52 p-r-15 p-t-10 p-b-10 p-l-15-sm">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <a href="<?php echo base_url('pages/product/search?category=0&price=asc&group=') ?>" class="s-text16">
        Semua Produk
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <?php echo $breadcrumb;?>
    <span class="s-text17">
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i> <?php echo $productdetail->productName; ?>
    </span>
</div>
<div class="container bgwhite p-t-10 p-b-5">
    <div class="flex-w flex-sb p-b-20">
        <div class="w-size13 p-t-30 respon5">
            <div class="wrap-slick3 flex-sb flex-w">
                <div class="wrap-slick3-dots"></div>
                <div class="slick3">
                    <?php foreach ($productfoto as $value) { ?>
                        <div class="item-slick3" data-thumb="<?php echo site_url('asset/img/uploads/product/' . $value->fotoName . '') ?>">
                            <div class="wrap-pic-w">
                            <a rel="fancybox-thumb" class="fancybox-thumb" href="<?php echo site_url('asset/img/uploads/product/' . $value->fotoName . '') ?>" >
                                <img src="<?php echo site_url('asset/img/uploads/product/' . $value->fotoName . '') ?>" alt="<?php echo $productdetail->productName; ?>">
                            </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="w-size14 p-t-20 respon5">
            <h4 class="product-detail-name">
                <?php echo $productdetail->productName; ?>
            </h4>
            <?php if($productdetail->volunteer != 0){?>
            <input id="rating" value="<?php echo $productdetail->rating; ?>" class="rating-loading ratingbar" data-step="1" data-size="xs" readonly="">
            <?php } ?>    
            <small><?php echo $productdetail->volunteer;?> Ulasan</small>
            <hr>
             <?php if ($productdetail->pricesale != "") { ?>
            <h3 class="m-text-flash">
                FLASH DEAL
            </h3>
            <h3 class="m-text-countdown" id="countdown">Berakhir dalam</h3><hr>
            <input id="lastsale" value="<?php echo date("M d, Y", strtotime($productdetail->endDate));?> 24:00:00" type="hidden">
             <?php } ?>
            <div class="m-text17">
                <?php if ($productdetail->pricesale != "") { ?>
                    <span class="block2-oldprice m-text7 p-r-5">
                        <?php echo "Rp. " . number_format($productdetail->price); ?>
                    </span>
                    <span class="block2-newprice s-textprice p-r-5 p-t-10">
                        <?php echo "Rp. " . number_format($productdetail->pricesale); ?>
                    </span>
                    <span class="sale-precent">
                        <?php echo floor(($productdetail->price-$productdetail->pricesale)/$productdetail->price*100) ." % OFF";?>
                    </span>  <?php } else { ?>
                    <span class="block2-newprice s-textprice p-r-5 p-t-10">
                        <?php echo "Rp. " . number_format($productdetail->price); ?>
                    </span>
                <?php } ?>
            </div>
            <hr>
            <div class="p-t-5 p-b-10">
            <?php if ($productdetail->quantityStock > 10) { ?>
                <span class="label success"><?php echo $productdetail->productStatus . " | " . $productdetail->quantityStock; ?></span>
            <?php } elseif ($productdetail->quantityStock < 1) { ?>
                <span class="label danger"><?php echo $productdetail->productStatus . " | " . $productdetail->quantityStock; ?></span>
            <?php } elseif ($productdetail->quantityStock < 10) { ?>
                <span class="label warning"><?php echo $productdetail->productStatus . " | " . $productdetail->quantityStock; ?></span>
            <?php } ?>
                <div class="flex-m flex-w p-b-10">
                    <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
                        <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                            <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                        </button>
                        <input class="size8 m-text18 t-center" type="number" name="qty" id="qty" value="1" min="0" max="<?php echo $productdetail->quantityStock; ?>">
                        <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2" id="qtyplus" onclick="">
                            <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                        </button>
                    </div>
                    <hr>
<!--                    <div class="flex-w of-hidden m-r-22 m-b-10">
                        <div class="m-text15">
                        Catatan
                        </div>
                        <textarea type="text" name="note" id="note" class="note" id="note" placeholder="Contoh warna, ukuran, dll"></textarea> 
                    </div>-->
                    <div class="btn-addcart-product-detail col-md-6 size25 trans-0-4 m-t-10 m-b-1">
                        <?php if ($productdetail->quantityStock < 1) { ?>
                            <button class="flex-c-m sizefull bg1 bo-rad-4 hov1 s-text14 trans-0-4" onclick="addToWistlist();" >
                                Add to Wishlist
                            </button>
                        <?php } else { ?>
                            <button data-weight="<?php echo $productdetail->productWeight; ?>" data-idproduct="<?php echo $productdetail->idp; ?>" data-image="<?php echo $productdetail->fotoName; ?>"
                                    data-productname="<?php echo $productdetail->productName; ?>" data-price="<?php
                                    if ($productdetail->pricesale != "") {
                                        echo $productdetail->pricesale;
                                    } else {
                                        echo $productdetail->price;
                                    }
                                    ?>"
                                    id="add_cart" class="add_cart flex-c-m sizefull bg-orange bo-rad-4 hov1 s-text14 trans-0-4" <?php if(!empty($fbpixel)){?>onClick="fbq('track', 'AddToCart');"<?php } ?>>
                                Add to Cart <i class="fa fa-circle-o-notch fa-pulse fa-2x fa-fw loading-cart"></i>
                            </button>
                        <?php } ?>
                    </div>
                    <?php if(!empty($orderwa)){?>
<!--                    <div class="wrap p-t-10 col-md-6">
                        <button class="order_via_wa flex-c-m sizefull"><i class="fa fa-whatsapp"></i>  Order Via Whatsapp</button>
                    </div>-->
                    <?php }?>
                </div>
            </div>
            <div class="p-b-20">
                <span class="s-text8 m-r-35">SKU:  <?php echo $productdetail->idp; ?></span>
                <span class="s-text8 m-r-35">Kategori: <?php echo $productdetail->categoryName; ?></span>
            </div>
            <div class="p-b-10">
                <?php if (!empty($sharebutton)) { ?>
                    <span class="s-text8">Bagikan</span>
                <?php } ?>
                <div class="sharethis-inline-share-buttons" id="sharethis-inline-share-buttons"></div>
            </div>
            <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                    Deskripsi
                    <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                    <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                </h5>
                <div class="dropdown-content dis-none p-t-15 p-b-23">
                    <span class="s-text8">
                        <?php echo $productdetail->productDescription; ?>
                    </span>
                </div>
            </div>
            <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
                <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                    Informasi Tambahan
                    <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                    <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                </h5>
                <div class="dropdown-content dis-none p-t-15 p-b-10">
                    <p class="s-text8">
                        <span class="s-text8 m-r-35">Material :</span>
                        <span class="s-text8"><?php echo $productdetail->material; ?></span><br>
                        <span class="s-text8 m-r-62">Size :</span>
                        <span class="s-text8"><?php echo $productdetail->size; ?></span><br>
                        <span class="s-text8 m-r-40">Weight :</span>
                        <span class="s-text8"><?php echo ($productdetail->productWeight/1000)." Kg"; ?></span><br>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php if($productdetail->volunteer != 0){?>
    <div class="col-md-7">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#datarating">Ulasan (<?php echo $productdetail->volunteer;?>)</a>
            </li>
        </ul> 
        <div class="tab-content p-t-10">
            <div class="tab-pane container active" id="datarating">
                <h6>Ulasan pelanggan</h6>
                <?php foreach ($datarating as $value) {?>
                <div class="card">
                    <div class="card-body">
                        <input id="rating" value="<?php echo $value->ratingProduct; ?>" class="rating-loading ratingbar" data-step="1" data-size="xs" readonly="">
                        <p>
                            Oleh : <?php echo $value->username;?>, <small><?php echo date_ind($value->date_create);?></small>
                        </p>
                        <p>
                           <?php echo $value->comment;?>
                        </p>
                    </div>
                </div><br>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<?php if (!empty($relateproduct)) { ?>
    <section class="relateproduct bgwhite p-t-10 p-b-30">
        <div class="container">
            <div class="sec-title p-b-30">
                <h3 class="m-text5-glow t-center">
                    Produk yang Mungkin Anda Suka
                </h3>
            </div>
            <div class="wrap-slick2">
                <div class="slick2">
                    <?php foreach ($relateproduct as $value) { ?>
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
    </section>
<?php } ?>
<?php if (!empty($fbcomment)) { ?>
    <div class="container">
        <hr>
        <div class="col-md-6">
            <div class="fb-comments" data-width="50%" data-numposts="5"></div>
        </div>
    </div>
<?php } ?>
<?php echo $footer; ?>
<script src="<?php echo base_url('');?>asset/vendors/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
<?php if($productdetail->pricesale != ""){?>
<script type="text/javascript" src="<?php echo base_url('asset/') ?>vendors/countdowntime/countdowntime.js"></script>
<?php  } ?>
    <?php if(!empty($orderwa)){?>
<div class="footer-fixed navbar-fixed-bottom wow fadeInUp">
    <div class="col-lg-12 col-xs-6 col-sm-6 no-margin">
        <button class="order_via_wa"><i class="fa fa-whatsapp"></i> Order Via Whatsapp</button>
    </div>
</div>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.loading-cart').hide();
        jQuery(window).scroll(function () {
            if ($(this).scrollTop() > 200) {
                $('.footer-fixed').fadeIn();
            } else {
                $('.footer-fixed').fadeOut();
            }
        });

        $('.add_cart').click(function () {
            $('.loading-cart').show();
            document.getElementById("add_cart").disabled = true;
            document.getElementById("add_cart").style.color = "black";
            var rowid = $(this).data("rowid");
            var idproduct = $(this).data("idproduct");
            var productname = $(this).data("productname");
            var price = $(this).data("price");
            var image = $(this).data("image");
            var weight = $(this).data("weight");
            var qty = $('#qty').val();
            // var note = $('#note').val();
            var curqty = '<?php echo $productdetail->quantityStock; ?>';
            if (parseInt(qty) > parseInt(curqty)) {
                swal("Gagal", "Stok " + curqty + ". Silahkan masukan jumlah yang lebih kecil", "error");
                document.getElementById("qty").value = curqty;
                document.getElementById("add_cart").disabled = false;
                document.getElementById("add_cart").style.color = "white";
                $('.loading-cart').hide();
            } else {
                $.ajax({
                    url: '<?php echo base_url('Cart/add_to_cart') ?>',
                    method: "POST",
                    data: {idproduct: idproduct, productname: productname, price: price, qty: qty, image: image, weight: weight},
                    success: function (resp) {
                        $('#qty-cart-a').html(resp);
                        $('#qty-cart-b').html(resp);
                        $('#qty-cart-c').html(resp);
                        getQty();
                        getList();
//                        document.getElementById('note').value = '';
                        document.getElementById("add_cart").disabled = false;
                        document.getElementById("add_cart").style.color = "white";
                        $('.loading-cart').hide();
                    }
                });
            }
        });

        $('.order_via_wa').click(function () {
        var csphone = '<?php if(!empty($cs)){echo $cs->csPhone;}?>';
        var id = '<?php if(!empty($cs)){echo $cs->id;}?>';
        var count = '<?php if(!empty($cs)){echo $cs->count;}?>';
        <?php if($useragent == "iPhone" || $useragent == "Android" || $useragent == "webOS" || $useragent == "BlackBerry" || $useragent == "iPod"){?>
                window.open('https://api.whatsapp.com/send?phone=<?php echo $cs->csPhone;?>&text=Hallo kak <?php echo $cs->csName;?>, Saya mau Order produk <?php echo $productdetail->productName?>, bagaimana caranya?', '_blank');
        <?php }else{ ?>
            window.open('https://web.whatsapp.com/send?phone=<?php echo $cs->csPhone;?>&text=Hallo kak <?php echo $cs->csName;?>, Saya mau Order produk <?php echo $productdetail->productName?>, bagaimana caranya?', '_blank');
        <?php } ?>
            $.ajax({
                    url: '<?php echo base_url('d/Cs/add_action_order_cs') ?>',
                    method: "POST",
                    data: {csphone:csphone,id:id,count:count}
                });
        });
        $(".fancybox-thumb").fancybox({
        prevEffect  : 'none',
        nextEffect  : 'none',
        helpers : {
            title   : {
                type: 'outside'
            },
            thumbs  : {
                width   : 50,
                height  : 50
            }
        }
    });
    });
    function getList() {
        $.ajax({url: "<?php echo base_url('Cart/load_list_cart') ?>", success: function (resp) {
                $('#list-cart-a').html(resp);
                $('#list-cart-b').html(resp);
                $('#list-cart-c').html(resp);
            }});
    }
    function getQty() {
        var id = '<?php echo $productdetail->idp; ?>';
        var qty = '<?php echo $productdetail->quantityStock; ?>';
        $.ajax({
            url: '<?php echo base_url('d/Product/cek_qty') ?>',
            method: "post",
            data: {id: id},
            success: function (resp) {
                if (resp === "0") {
                    document.getElementById("qtyplus").disabled = true;
                    document.getElementById("add_cart").disabled = true;
                } else if (resp === qty) {
                    document.getElementById("qtyplus").disabled = true;
                    document.getElementById("add_cart").disabled = true;
                }
            }
        });
    }
    function addToWistlist() {
        var idproduct = '<?php echo $productdetail->idp; ?>';
        swal({
            title: "Tambahkan Ke Wishlist!",
            text: "No HP:",
            type: "input",
            showCancelButton: true,
            confirmButtonColor: "#5cb85c",
            confirmButtonText: "Add to Wishlist",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "E-mail atau No HP"
        },
                function (inputValue) {
                    if (inputValue === false)
                        return false;
                    if (inputValue === "") {
                        swal.showInputError("Masukan Nomor Hp!");
                        return false;
                    }
                    $.ajax({
                        url: '<?php echo base_url('Cart/add_to_wishlist'); ?>',
                        method: "POST",
                        data: {"idproduct": idproduct, "emailhp": inputValue},
                        success: function (data) {
                            $('#alert').html(data);
                        }
                    }),
                    swal("Terimakasih,", "<?php echo $productdetail->productName; ?> ditambahkan ke Wishlist", "success");
                });
    }
    <?php if(!empty($fbpixel)){?>
    var button = document.getElementById('add_cart');
    button.addEventListener(
            'click',
            function () {
                fbq('track', 'AddToCart', {
                    content_name: '<?php echo $productdetail->productName; ?>',
                    content_category: '<?php echo $productdetail->categoryName; ?>',
                    content_ids: ['<?php echo $productdetail->idp; ?>'],
                    content_type: 'product'
                });
            },
            false
            );
<?php } ?>
</script>
</body>
</html>