<footer class="p-t-25 p-b-30 p-l-45 p-r-45">
    <div class="flex-w p-b-20">
        <div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
            <h4 class="s-text23 p-b-30">
                Alamat
            </h4>
            <div>
                <p class="s-text8 w-size27">
                    <?php echo $profile->address1; ?><br>
                    <?php echo $profile->phone1; ?>
                </p>
                <div class="flex-m p-t-30">
                    <?php
                    if (!empty($profile->fbLink) && $profile->fbLink != "null") {
                        echo '<a href="' . $profile->fbLink . '" target="_blank" class="fs-18 color1 p-r-20 fa fa-facebook"></a>';
                    }
                    if (!empty($profile->igLink) && $profile->igLink != "null") {
                        echo '<a href="' . $profile->igLink . '" target="_blank" class="fs-18 color1 p-r-20 fa fa-instagram"></a>';
                    }
                    if (!empty($profile->twittLink) && $profile->twittLink != "null") {
                        echo '<a href="' . $profile->twittLink . '" target="_blank" class="fs-18 color1 p-r-20 fa fa-twitter"></a>';
                    }
                    if (!empty($profile->ytLink) && $profile->ytLink != "null") {
                        echo '<a href="' . $profile->ytLink . '" target="_blank" class="fs-18 color1 p-r-20 fa fa-youtube-play"></a>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
            <h4 class="s-text23 p-b-30">
                Layanan
            </h4>
            <ul>
                <li class="p-b-9 <?php echo $activemenu['about']; ?>">
                    <a href="<?php echo base_url('pages/about') ?>" class="s-text8">
                        Tentang Kami
                    </a>
                </li>            
                <li class="p-b-9 <?php echo $activemenu['trackorder']; ?>">
                    <a href="<?php echo base_url('pages/track-order') ?>" class="s-text8">
                        Lacak Order
                    </a>
                </li>
                <li class="p-b-9 <?php echo $activemenu['payment']; ?>">
                    <a href="<?php echo base_url('pages/confirm-payment') ?>" class="s-text8">
                        Konfirmasi Pembayaran
                    </a>
                </li>
                <li class="p-b-9">
                    <a href="<?php echo base_url('pages/reset-password')?>" class="s-text8">
                        Reset Password
                    </a>
                </li>                
            </ul>
        </div>

        <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
            <h4 class="s-text23 p-b-30">
                Jelajahi
            </h4>
            <ul>
                <li class="p-b-9">
                    <a href="<?php echo base_url('pages/voucher')?>" class="s-text8">
                        VOUCHER 
                    </a>
                </li>
                <li class="p-b-9">
                    <a href="<?php echo base_url('pages/blog')?>" class="s-text8">
                        Blog 
                    </a>
                </li>                
                <li class="p-b-9">
                    <a href="<?php echo base_url('pages/cekresi')?>" class="s-text8">
                        Cek resi 
                    </a>
                </li>
            </ul>
        </div>

        <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
        <h4 class="s-text23 p-b-30">
                Bantuan
            </h4>  
            <ul>
                <li class="p-b-9 <?php echo $activemenu['contact']; ?>">
                    <a href="<?php echo base_url('pages/contact') ?>" class="s-text8">
                        Hubungi Kami
                    </a>
                </li>
                <li class="p-b-9 <?php echo $activemenu['terms']; ?>">
                    <a href="<?php echo base_url('pages/terms') ?>" class="s-text8">
                        Syarat & Ketentuan
                    </a>
                </li>
                <li class="p-b-9 <?php echo $activemenu['privacy']; ?>">
                    <a href="<?php echo base_url('pages/privacy') ?>" class="s-text8">
                        Kebijakan & Privasi
                    </a>
                </li>
                <li class="p-b-9 <?php echo $activemenu['service']; ?>">
                    <a href="<?php echo base_url('pages/service'); ?>" class="s-text8">
                        Layanan Kami
                    </a>
                </li>
            </ul>                  
        </div>


        <div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
            <h4 class="s-text23 p-b-30">
                Newsletter
            </h4>
            <form action="<?php echo base_url('Home/store_email_sub')?>" method="post">
                <div class="effect1 w-size9">
                    <input class="s-text bo-rad-5 w-full p-b-5 p-t-5 p-l-10" type="email" required="" name="email" placeholder="email@example.com">
                    <span class="effect1-line"></span>
                </div>
                <div class="w-size2 p-t-20">
                    <button type="submit" class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
                        Subscribe
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div style="padding-bottom:20px" class="t-center">
        <div class="t-center s-text8">
            Copyright © <?php echo date('Y'); ?> All rights reserved </br> <?php echo $profile->companyName; ?> 
        </div>
    </div>
</footer>
<div class="btn-back-to-top bg0-hov" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="fa fa-angle-double-up" aria-hidden="true"></i>
    </span>
</div>
<div id="dropDownSelect1"></div>
<div id="dropDownSelect2"></div>
<script type="text/javascript" src="<?php echo base_url('asset/') ?>vendors/jquery2/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('asset/') ?>vendors/animsition/js/animsition.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('asset/') ?>vendors/bootstrap2/js/popper.js"></script>
<script type="text/javascript" src="<?php echo base_url('asset/') ?>vendors/bootstrap2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('asset/') ?>vendors/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('asset/') ?>vendors/slick/slick.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('asset/') ?>js/slick-custom.js"></script>
<script type="text/javascript" src="<?php echo base_url('asset/') ?>vendors/lightbox2/js/lightbox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('asset/') ?>vendors/sweetalert/sweetalert-dev.js"></script>
<script type="text/javascript" src="<?php echo base_url('asset/') ?>vendors/sweetalert/sweetalert1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('asset/') ?>vendors/swiper/js/swiper.min.js"></script>
<script src="<?php echo base_url('asset/') ?>js/main.js"></script>
<script src='<?php echo base_url('') ?>asset/vendors/bootstrap-star-rating/js/star-rating.min.js' type='text/javascript'></script>

<script type="text/javascript">  
    $(document).ready(function () {
        $.ajax({url: "<?php echo base_url('Cart/load_qty_cart') ?>", success: function (resp) {
                $('#qty-cart-a').html(resp);
                $('#qty-cart-b').html(resp);
                $('#qty-cart-c').html(resp);
                getList();
            }});
        $('.ratingbar').rating({
            showCaption: false,
            showClear: false,
            size: 'xs'
        });
    });
    function getList() {
        $.ajax({url: "<?php echo base_url('Cart/load_list_cart') ?>", success: function (resp) {
                $('#list-cart-a').html(resp);
                $('#list-cart-b').html(resp);
                $('#list-cart-c').html(resp);
            }});
    }
    $(".selection-1").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });

    <?php if(!empty($chatbutton)){?>
   (function () {
       var options = {
           whatsapp: "<?php echo $profile->waPhone;?>", 
           call_to_action: "<?php echo $chatbutton->widgetCta;?>", 
           position: "<?php echo $chatbutton->widgetPosition;?>", 
       };
       var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
       var s = document.createElement('script');
       s.type = 'text/javascript';
       s.async = true;
       s.src = url + '/widget-send-button/js/init.js';
       s.onload = function () {
           WhWidgetSendButton.init(host, proto, options);
       };
       var x = document.getElementsByTagName('script')[0];
       x.parentNode.insertBefore(s, x);
   })();
<?php } ?>

function openSearch() {
  document.getElementById("formsearchbox").style.display = "block";
}

function closeSearch() {
  document.getElementById("formsearchbox").style.display = "none";
}
</script>
<script>

</script>
