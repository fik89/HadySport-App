<?php echo $header; ?>
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(<?php echo site_url('asset/img/uploads/banner/'.$bannertitlepage->image.'') ?>);">
    <h2 class="l-text2 t-center m-text-glow">
        Tentang Kami
    </h2>
</section>
<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-20">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Tentang Kami
    </span>
</div>
<section class="bgwhite p-t-66 p-b-38">
    <div class="container">
        <div class="row">
            <div class="text-center col-md-12 p-b-30">
                <h3 class="m-text26 p-t-15 p-b-16">
                    <?php echo $profile->companyName; ?>
                </h3>

                <p class="p-b-28">
                    <?php echo $profile->companyDescription; ?>
                </p>
                <p class="s-text8 w-size27">
                    <?php echo $profile->address1; ?><br>
                    <?php echo $profile->email; ?><br>
                    <?php echo $profile->phone1; ?>
                </p>
            </div>
        </div>
    </div>
</section>
<?php echo $footer; ?>
</body>
</html>