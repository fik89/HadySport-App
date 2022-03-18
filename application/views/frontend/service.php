<?php echo $header; ?>
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(<?php echo site_url('asset/img/uploads/banner/' . $bannertitlepage->image . '') ?>);">
    <h2 class="l-text2 t-center m-text-glow">
        Layanan Kami
    </h2>
</section>
<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-20">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Layanan Kami
    </span>
</div>
<section class="blog bgwhite p-t-10 p-b-45">
    <div class="container">
        <div class="row">
            <?php foreach ($dataservice as $value) {?>
            <div class="col-sm-10 col-md-4 p-b-30 m-l-r-auto">
                <div class="block3">
                    <a href="javascript:void(0);" class="block3-img dis-block hov-img-zoom">
                        <img src="<?php echo base_url('').$value->icon;?>" alt="<?php echo $value->title;?>">
                    </a>
                    <div class="block3-txt p-t-14">
                        <h4 class="p-b-7">
                            <a href="javascript:void(0);" class="m-text11">
                                <?php echo $value->title;?>
                            </a>
                        </h4>
                        <p class="s-text8 p-t-16">
                            <?php echo $value->description;?>
                        </p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php echo $footer; ?>
</body>
</html>