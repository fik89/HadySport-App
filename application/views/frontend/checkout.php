    <?php echo $header; ?>
    <div class="bread-crumb-detail bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
        <a href="<?php echo base_url('') ?>" class="s-text16">
            Home
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>
        <span class="s-text17">
            Checkout
        </span>
    </div>
    <section class="bgwhite p-t-20 p-b-100">
        <div class="container">
            <?php if ($this->session->flashdata('MSG')) { ?>
                <?= $this->session->flashdata('MSG') ?>
            <?php } ?>
        </div>
    </section>
    <?php echo $footer; ?>
</body>
</html>