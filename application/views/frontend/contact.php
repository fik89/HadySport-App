<?php echo $header; ?>
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(<?php echo site_url('asset/img/uploads/banner/'.$bannertitlepage->image.'') ?>);">
    <h2 class="l-text2 t-center m-text-glow">
        Kontak
    </h2>
</section>
<div class="bread-crumb-detail bgwhite flex-w p-l-52 p-r-15 p-t-20">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Kontak
    </span>
</div>
    <section class="bgwhite p-t-20 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 p-b-30">
                <h3 class="m-text26 p-t-15 p-b-16">
                    <?php echo $profile->companyName; ?>
                </h3>
                <p class="p-b-20" style="text-align: justify !important;">
                    <?php echo $profile->companyDescription; ?>
                </p>
                 <p class="s-text8 w-size27">
                    <?php echo $profile->address1; ?><br>
                    <?php echo $profile->email; ?><br>
                    <?php echo $profile->phone1; ?>
                </p>
                </div>
                <div class="col-md-6 p-b-30">
                     <?php echo form_open('Home/store_contact', 'class="login_form form-customer"'); ?>
                        <h4 class="m-text26 p-b-36 p-t-15">
                            Pesan Anda
                        </h4>
                        <div class="size15 m-b-20 form-group">
                            <input class="sizefull s-text7 p-l-22 p-r-22 form-control" type="text" name="_name" id="_name" placeholder="Nama Anda" required="">
                            <p class="help-block text-danger"><?php echo form_error('_name'); ?></p>
                        </div>
                        <div class="size15 m-b-20 form-group">
                            <input onkeyup="if (/\D/g.test(this.value))
                                                            this.value = this.value.replace(/\D/g, '')" class="sizefull s-text7 p-l-22 p-r-22 form-control" type="text" name="_phone" id="_phone" placeholder="Nomor Telpon" required="">
                            <p class="help-block text-danger"><?php echo form_error('_phone'); ?></p>
                        </div>
                        <div class="size15 m-b-20 form-group">
                            <input class="sizefull s-text7 p-l-22 p-r-22 form-control" type="email" name="_email" id="_email" placeholder="Email" required="">
                            <p class="help-block text-danger"><?php echo form_error('_email'); ?></p>
                        </div>
                        <div class="form-group">
                            <textarea class="s-text7 size20 p-l-22 p-r-22 p-t-20 m-b-20 form-control" name="_message" id="_message" placeholder="Pesan" required="" ></textarea>
                            <p class="help-block text-danger"><?php echo form_error('_message'); ?></p>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 m-b-5">
                                <input type="text" onkeyup="if (/\D/g.test(this.value))this.value = this.value.replace(/\D/g, '')" name="captcha" id="captcha" class="form-control" placeholder="captcha code" required="" maxlength="4">
                            </div>
                            <div class="col-md-6"><?php echo $cap_img;?></div>
                            
                        </div>
                        <div class="w-size25">
                            <button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" type="submit">
                                Kirim
                            </button>
                        </div>
                    </form>
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