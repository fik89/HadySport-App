<?php echo $header; ?>
<section class="bg-title-page p-t-10 p-b-10 flex-col-c-m" style="background-image: url(<?php echo site_url('asset/img/uploads/banner/' . $bannertitlepage->image . '') ?>);">
    <h2 class="l-text2 t-center m-text-glow">
        Blog
    </h2>
</section>
<div class="bread-crumb-detail bgwhite flex-w p-l-52 p-r-15 p-t-20">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Blog
    </span>
</div>
<!-- content page -->
<section class="bgwhite p-t-20">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9 p-b-75">
                <div class="p-r-50 p-r-0-lg">
                    <!-- item blog -->
                    <?php if(empty($datablog)){
                        echo '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Data Kosong....</div>';
                    }else{
                        foreach ($datablog as $value) {?>
                    <div class="item-blog p-b-80">
                        <a href="<?php echo base_url('pages/blog-detail/'.$value->post_blog_slug.'');?>" class="item-blog-img pos-relative dis-block hov-img-zoom">
                            <img src="<?php echo base_url('').$value->banner_image;?>" alt="<?php echo $value->blog_title;?>">

                            <span class="item-blog-date dis-block flex-c-m pos1 size17 bg4 s-text1">
                                <?php echo date_ind($value->post_date);?>
                            </span>
                        </a>
                        <div class="item-blog-txt p-t-33">
                            <h4 class="p-b-11">
                                <a href="<?php echo base_url('pages/blog-detail/'.$value->post_blog_slug.'');?>" class="m-text24">
                                    <?php echo $value->blog_title;?>
                                </a>
                            </h4>
                            <div class="s-text8 flex-w flex-m p-b-21">
                                <span>
                                    <?php echo $value->username;?>
                                    <span class="m-l-3 m-r-6">|</span>
                                </span>
                                <span>
                                    <?php echo $value->blog_category_name;?>
                                    <span class="m-l-3 m-r-6">|</span>
                                </span>
                                <span>
                                    di baca sebanyak <?php echo $value->post_read;?> kali
                                </span>
                            </div>
                            <p class="p-b-12">
                               <?php echo substr($value->blog, 0, 500). " ....";?>
                            </p>
                            <a href="<?php echo base_url('pages/blog-detail/'.$value->post_blog_slug.'');?>" class="s-text18">
                                Selengkapnya
                                <i class="fa fa-long-arrow-right m-l-8" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <?php }} ?>
                </div>
                <!-- Pagination -->
                <?php echo $this->pagination->create_links();?>
            </div>
            <div class="col-md-4 col-lg-3 p-b-75">
                <div class="rightbar"><!-- Search -->
                    <div class="pos-relative bo11 of-hidden">
                        <form method="get" action="<?php echo base_url('pages/blog-search');?>">
                            <input class="s-text7 size16 p-l-23 p-r-50" type="text" name="post" placeholder="Search" required="">

                            <button class="flex-c-m size5 ab-r-m color1 color0-hov trans-0-4">
                                <i class="fs-13 fa fa-search" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                    <!-- Categories -->
                    <h4 class="m-text23 p-b-34 p-t-20">
                        Kategori
                    </h4>
                    <ul>
                        <?php foreach ($datacategory as $value) {?>
                        <li class="p-t-6 p-b-8 bo6">
                            <a href="<?php echo base_url('pages/blog-category/'.$value->idblogcategory.'');?>" class="s-text13 p-t-5 p-b-5">
                                <?php echo $value->blog_category_name;?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo $footer; ?>
<?php if ($this->session->flashdata('MSG')) { ?>
    <?= $this->session->flashdata('MSG') ?>
<?php } ?>
</body>
</html>