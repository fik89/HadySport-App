<?php echo $header; ?>
<div class="bread-crumb-detail bgwhite flex-w p-l-52 p-r-15 p-t-20 p-l-15-sm">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Login
    </span>
</div>
<section class="bgwhite p-t-20 p-b-100">
    <div class="container">
        <section class="login_area">
            <div class="container">
                <?php if ($this->session->flashdata('MSG')) { ?>
                    <?= $this->session->flashdata('MSG') ?>
                <?php } ?>
                <div class="login_inner">
                    <div class="row">
                        <div class="col-lg-4 bo16 p-l-10 p-r-10 p-t-20 p-b-10">
                            <div class="login_title">
                                <h2>Masuk</h2>
                            </div>
                            <form class="login_form row" action="<?php echo base_url('User/do_login') ?>" method="post">
                                <div class="col-lg-12 form-group">
                                    <input class="form-control" type="email" name="email" placeholder="E-mail" required="">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <input class="form-control" type="password" name="password" placeholder="Password" required="">
                                </div>
                                <div class="col-lg-12 form-group">
                                    <button type="submit" value="submit" class="btn update_btn form-control">Login</button>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label><a href="<?php echo base_url('pages/reset-password') ?>">Lupa Password ?</a></label>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-8">
                            <div class="login_title">
                                <h2>Buat Akun</h2>
                            </div>
                            <form class="login_form row" action="<?php echo base_url('User/store_user') ?>" method="post">
                                <div class="col-lg-6 form-group">
                                    <input class="form-control" type="text" name="username" id="username" placeholder="Nama Lengkap" required="">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <select name="provinsi" id="provinsi" class="form-control">
                                        <option value="" disabled="" selected="">Provinsi</option>
                                        <?php foreach ($provinsi as $value) { ?>
                                            <option value="<?php echo $value->id_prov ?>"><?php echo $value->nama; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <select class="form-control" name="kabupaten" id="kabupaten" required="">
                                        <option disabled="" selected="">Pilih Kabupaten / Kota</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <input class="form-control" type="email" name="useremail" id="useremail" placeholder="Email" required="">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <input class="form-control" type="number" name="userhp" id="userhp" placeholder="Nomor HP (optional)">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <input class="form-control" type="password" name="password" id="password" placeholder="Buat Password minimal 6 karakter" minlength="6" required="">
                                    <input type="checkbox" onclick="showPassword()" placeholder="sasa"> Tampilkan Password
                                </div>
                                <div class="col-lg-6 form-group">
                                    <select class="form-control" name="typeuser" id="typeuser" required="" onchange="typeUserdesc();">
                                        <option value="">Pilih Tipe User</option>
                                        <?php foreach ($partner as $value) { ?>
                                            <option value="<?php echo $value->idpartner ?>"><?php echo $value->partnerName; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 form-group" id="inforule"></div>
                                <div class="col-lg-6 form-group">
                                    <button type="submit" value="submit" class="btn subs_btn form-control">register now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
<?php echo $footer; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#provinsi').change(function () {
            $('#kabupaten').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading"></i>');
            $('#kabupaten').load('<?php echo base_url('Daerah/listKab') ?>/' + $(this).val(), function (responseTxt, statusTxt, xhr)
            {
                if (statusTxt === "success")
                    $('.loading').remove();
            });
            return false;
        });
    });
    function typeUserdesc() {
        var idpartner = $('#typeuser').val();
        $.ajax({
            url: "<?php echo base_url('User/info_partner_by_id'); ?>",
            method: "POST",
            data: {"id": idpartner},
            success: function (data) {
                $('#inforule').html(data, "slow");
            }
        });
    }
    function showPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
</body>
</html>