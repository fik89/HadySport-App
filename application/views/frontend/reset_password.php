<?php echo $header; ?>
<div class="bread-crumb-detail bgwhite flex-w p-l-52 p-r-15 p-t-50 p-l-15-sm">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Reset Password
    </span>
</div>
<section class="bgwhite p-t-20 p-b-100">
    <div class="container">
        <?php if ($this->session->flashdata('MSG')) { ?>
            <?= $this->session->flashdata('MSG') ?>
        <?php } ?>
        <div class="bo17 w-size18 p-l-20 p-r-20 p-t-20 p-b-38 m-t-30 m-r-0 m-l-r-auto p-lr-15-sm">
            <form class="login_form" action="<?php echo base_url('User/do_reset_password'); ?>" method="post">
                <h5 class="bo18 m-b-20 p-b-20 text-center">
                    Reset Password
                </h5>
                <div class="flex-w flex-sb-m p-b-12 bo20">
                    <div class="col-lg-12 form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" required="">
                    </div>
                </div>
                <div class="size15 trans-0-4 p-t-30 m-b-20">
                    <button class="btn btn-block subs_btn form-control" type="submit">
                        Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
<?php echo $footer; ?>
<?php if ($this->session->flashdata('MSG')) { ?>
    <?= $this->session->flashdata('MSG') ?>
<?php } ?>
</body>
</html>