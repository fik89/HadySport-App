<?php echo $header; ?>
<div class="bread-crumb-detail-single bgwhite flex-w p-l-52 p-r-15 p-t-20 p-l-15-sm">
    <a href="<?php echo base_url('') ?>" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">
        Update Account
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
                        <div class="col-lg-10">
                            <div class="login_title">
                                <h2>Update Akun</h2>
                            </div>
                            <form class="login_form row" action="<?php echo base_url('User/update_user/'.encryption($datauser->iduser).'') ?>" method="post" id="form-update-user">
                                <div class="col-lg-6 form-group">
                                    <label for="postalcode"><small>Nama Depan</small></label>
                                    <input class="form-control" type="text" name="username" id="username" value="<?php echo $datauser->username;?>" required="">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="postalcode"><small>Nama Belakang</small></label>
                                    <input class="form-control" type="text" name="lastname" id="lastname" value="<?php echo $datauser->lastName;?>" required="">
                                </div>

                                <div class="col-lg-12 form-group">
                                    <label for="fulladdress"><small>Alamat Lengkap</small></label>
                                    <textarea class="form-control" type="text" name="fulladdress" id="fulladdress" required="" row="7"><?php echo $datauser->alamat;?></textarea>
                                </div>


                                <div class="col-lg-6 form-group">
                                    <label for="provinsi"><small>Provinsi</small></label>
                                    <select name="provinsi" id="provinsi" class="form-control">
                                        <?php if($datauser->codeProvinsi == 0){?>
                                            <option value="" disabled="" selected="">Pilih Provinsi</option>
                                        <?php }else{
                                            echo '<option value="'.$datauser->codeProvinsi.'">'.$datauser->provinsi.'</option>';
                                        }?>
                                    </select>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="kabupaten"><small>Kabupaten</small></label>
                                    <select class="form-control" name="kabupaten" id="kabupaten" required="">
                                        <?php if($datauser->codeProvinsi == 0){?>
                                            <option value="" disabled="" selected="">Pilih Kabupaten</option>
                                        <?php }else{
                                            echo '<option value="'.$datauser->codeKabupaten.'">'.$datauser->kabupaten.'</option>';
                                        }?>
                                    </select>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label for="provinsi"><small>Kecamatan</small></label>
                                    <select class="form-control" name="kecamatan" id="kecamatan" required="">
                                        <?php if($datauser->codeKecamatan == 0){?>
                                            <option value="" disabled="" selected="">Pilih Kecamatan</option>
                                        <?php }else{
                                            echo '<option value="'.$datauser->codeKecamatan.'">'.$datauser->kecamatan.'</option>';
                                        }?>
                                    </select>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label for="desa"><small>Desa</small></label>
                                    <input class="form-control" type="text" name="desa" id="desa" value="<?php echo $datauser->desa;?>" required="">
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label for="rt"><small>Rt</small></label>
                                    <input onkeyup="if (/\D/g.test(this.value))
                                    this.value = this.value.replace(/\D/g, '')" class="form-control" type="text" name="rt" id="rt" value="<?php echo $datauser->rt;?>" required="">
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label for="rw"><small>Rw</small></label>
                                    <input onkeyup="if (/\D/g.test(this.value))
                                    this.value = this.value.replace(/\D/g, '')" class="form-control" type="text" name="rw" id="rw" value="<?php echo $datauser->rw;?>" required="">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="kodepos"><small>Kode Pos</small></label>
                                    <input onkeyup="if (/\D/g.test(this.value))
                                    this.value = this.value.replace(/\D/g, '')" class="form-control" type="text" name="kodepos" id="kodepos" value="<?php echo $datauser->kodepos;?>" required=""  minlength="5" maxlength="8">
                                </div>

                                <div class="col-lg-6 form-group">
                                    <label for="postalcode"><small>Email</small></label>
                                    <input class="form-control" type="email" name="useremail" id="useremail" value="<?php echo $datauser->useremail;?>" required="">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="postalcode"><small>Nomor HP</small></label>
                                    <input class="form-control" type="number" name="userhp" id="userhp" value="<?php echo $datauser->userHp;?>">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="postalcode"><small>Password</small></label>
                                    <input class="form-control" type="password" name="password" id="password" placeholder="Buat Password minimal 6 karakter" minlength="6" required="" value="<?php echo $datauser->password;?>">
                                    <input type="checkbox" onclick="showPassword()" > Tampilkan Password
                                </div>
                                <div class="col-lg-6 form-group">
                                    <select class="form-control" name="typeuser" id="typeuser" required="" onchange="typeUserdesc();">
                                        <option value="<?php echo $datauser->tipeuser;?>" selected><?php echo $datauser->partnerName;?></option>

                                        <?php foreach ($partner as $value) { ?>
                                            <option value="<?php echo $value->idpartner ?>"><?php echo $value->partnerName; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 form-group" id="inforule"></div>
                                <div class="col-lg-12 form-group">
                                    <button type="submit" value="submit" class="btn subs_btn form-control">Simpan</button>
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
        function getProvinsi() {
            $('.loading').remove();
            var $op = $("#provinsi")
            $('#provinsi').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading color0"></i>');
            $.getJSON("<?php echo base_url('') ?>d/Shipinggateway/get_provinsi", function (data) {
                $.each(data, function (i, field) {
                    $op.append('<option value="' + field.province_id + '">' + field.province + '</option>');
                });
                $('.loading').remove();
            });

        }
        getProvinsi();

        $("#provinsi").on("change", function (e) {
            e.preventDefault();
            var option = $('option:selected', this).val();
            $('#kabupaten option:gt(0)').remove();

            if (option === '')
            {
                alert('null');
                $("#kabupaten").prop("disabled", true);

            } else
            {
                $("#kabupaten").prop("disabled", false);
                getKota(option);
            }
        });

        $("#kabupaten").on("change", function (e) {
            e.preventDefault();
            var option = $('option:selected', this).val();
            $('#kecamatan option:gt(0)').remove();
            if (option === '')
            {
                alert('null');
                $("#kecamatan").prop("disabled", true);
            } else
            {
                $("#kecamatan").prop("disabled", false);
                getKecamatan(option);
            }
        });

        function getKota(idpro) {
            $('.loading').remove();
            var $op = $("#kabupaten");
            $('#kabupaten').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading color0"></i>');
            $.getJSON("<?php echo base_url('') ?>d/Shipinggateway/get_kota/" + idpro, function (data) {
                $.each(data, function (i, field) {
                    $op.append('<option value="' + field.city_id + '">' + field.type + ' ' + field.city_name + '</option>');
                });
                $('.loading').remove();
            });
        };

        function getKecamatan(idkot) {
            var $op = $("#kecamatan");
            $('.loading').remove();
            $('#kecamatan').after('<i class="fa fa-spinner fa-pulse fa-2x fa-fw loading"></i>');
            $.getJSON("<?php echo base_url('d/Shipinggateway/get_kecamatan/')?>" + idkot, function (data) {

                $.each(data, function (i, field) {
                    $op.append('<option value="' + field.subdistrict_id + '">' + field.subdistrict_name + '</option>');
                });

                $('.loading').remove();
            });
        }



        $('#form-update-user').on('submit', function(e) {
            var form = this;
            e.preventDefault();
            var id = '<?php echo encryption($datauser->iduser);?>';

            swal({
                title: "Simpan Update",
                text: "Password",
                type: "input",
                showCancelButton: true,
                confirmButtonColor: "#5cb85c",
                confirmButtonText: "Simpan",
                cancelButtonText: "Batal",
                closeOnConfirm: false,
                animation: "slide-from-top",
                inputPlaceholder: "Password Akun Anda"
            },
            function (inputValue) {
                if (inputValue === false)
                    return false;
                if (inputValue === "") {
                    swal.showInputError("Masukan Password!");
                    return false;
                }
                $.ajax({
                    url: '<?php echo base_url('User/cek_password'); ?>/'+id+'/'+inputValue,
                    success: function (data) {
                        if(data == 'False')
                        {
                           swal("Gagal,", "Password Salah", "error");
                       }
                       else if(data == 'True')
                       {
                        form.submit();
                    }

                }
            })
            });
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