<?php echo $header; ?>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v3.2&appId=<?php echo $fbcomment->widgetScriptId; ?>&autoLogAppEvents=1"></script>
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(<?php echo site_url('asset/img/uploads/banner/' . $bannertitlepage->image . '') ?>);">
    <h2 class="l-text2 t-center m-text-glow">
        Blog
    </h2>
</section>
<div class="bread-crumb-detail bgwhite flex-w p-l-52 p-r-15 p-t-20">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <a href="<?php echo base_url('pages/blog') ?>" class="s-text16">
        Blog
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        <?php if(!empty($blogdetail)){echo $blogdetail->blog_title; }?>
    </span>
</div>
<!-- content page -->
<section class="bgwhite p-t-20 p-b-25">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9 p-b-80">
                <div class="p-r-50 p-r-0-lg">
                    <?php
                    if (empty($blogdetail)) {
                        echo '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Data Kosong....</div>';
                    } else {
                        ?>
                        <div class="p-b-40">
                            <div class="blog-detail-img wrap-pic-w">
                                <img src="<?php echo base_url('') . $blogdetail->banner_image; ?>" alt="IMG-BLOG">
                            </div>
                            <div class="blog-detail-txt p-t-33">
                                <h4 class="p-b-11 m-text24">
                                    <?php echo $blogdetail->blog_title; ?>
                                </h4>
                                <div class="s-text8 flex-w flex-m p-b-21">
                                    <span>
                                        <?php echo $blogdetail->username; ?>
                                        <span class="m-l-3 m-r-6">|</span>
                                    </span>
                                    <span>
                                        <?php echo date_ind($blogdetail->post_date); ?>
                                        <span class="m-l-3 m-r-6">|</span>
                                    </span>
                                    <span>
                                        <?php echo $blogdetail->blog_category_name; ?>
                                        <span class="m-l-3 m-r-6">|</span>
                                    </span>
                                    <span>
                                        di baca sebanyak <?php echo $blogdetail->post_read;?> kali
                                    </span>
                                </div>
                                <p class="p-b-25">
                                    <?php echo $blogdetail->blog; ?>
                                </p>
                            </div>
                            <div class="flex-m flex-w p-t-20">
                                <span class="s-text20 p-r-20">
                                    Tags
                                </span>
                                <div class="wrap-tags flex-w">
                                    <?php
                                    $tags = explode(',', $blogdetail->post_tag);

                                    foreach ($tags as $value) {
                                        echo '<a href="javascript:void(0);" class="tag-item">
                                        ' . $value . '
                                    </a>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <hr>
                            <div class="col-md-12">
                                <div class="fb-comments" data-width="50%" data-numposts="5"></div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 p-b-80">
                <div class="rightbar">
                    <div class="pos-relative bo11 of-hidden">
                        <form method="get" action="<?php echo base_url('pages/blog-search');?>">
                            <input class="s-text7 size16 p-l-23 p-r-50" type="text" name="post" placeholder="Search" required="">

                            <button class="flex-c-m size5 ab-r-m color1 color0-hov trans-0-4">
                                <i class="fs-13 fa fa-search" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                    <!-- Categories -->
                    <h4 class="m-text23 p-b-34 p-t-10">
                        Kategori
                    </h4>
                    <ul>
                        <?php foreach ($datacategory as $value) { ?>

                            <li class="p-t-6 p-b-8 bo6">
                                <a href="#" class="s-text13 p-t-5 p-b-5">
                                    <?php echo $value->blog_category_name; ?>
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