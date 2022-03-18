<?php echo $header; ?>
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(<?php echo site_url('asset/img/uploads/banner/' . $bannertitlepage->image . '') ?>);">
    <h2 class="l-text2 t-center m-text-glow">
        Kebijakan & Privasi
    </h2>
</section>
<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-20">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Kebijakan & Privasi
    </span>
</div>
<section class="blog bgwhite p-t-10 p-b-45">
    <div class="container">
            <div class="sec-title p-b-40">
                <h3 class="m-text5 t-center">
                    Kebijakan & Privasi
                </h3>
                <br/>
                <h5 class="t-center">
                    Kebijakan & Privasi di perbarui pada <?php echo date_ind($dataprivacypolicy->date_update);?>
                </h5>
            </div>
        <div class="row">
            <div class="col-sm-10 col-md-12 p-b-30 m-l-r-auto">
                <?php echo $dataprivacypolicy->description;?>
            </div>
        </div>
    </div>
</section>
<?php echo $footer; ?>
</body>
</html>