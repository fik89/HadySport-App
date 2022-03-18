<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
        <div class="panel-heading">
                <h4 class="panel-title">
                    Update Data Profil
                </h4>
            </div>
            <div class="panel-body">
                <form role="form" class="form-horizontal" id="companyprofile">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="companyname" class="col-sm-4 control-label">Nama Online Shop</label>
                            <div class="col-sm-8">
                                <input class="form-control required" name="companyname" id="companyname" type="text" value="<?php echo $dataprofile->companyName; ?>" title="input this field" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Nama Pemilik</label>
                            <div class="col-sm-8">
                                <input class="form-control required" type="text" name="owner" id="owner" value="<?php echo $dataprofile->owner; ?>" title="input this field" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Alamat Toko Offline / Alamat Gudang</label>
                            <div class="col-sm-8">
                                <input class="form-control required" name="address1" id="address1" type="text" value="<?php echo $dataprofile->address1; ?>" title="input this field" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Telepone 1</label>
                            <div class="col-sm-8">
                                <input class="form-control required" name="phone1" id="phone1" value="<?php echo $dataprofile->phone1; ?>" type="text" title="input this field" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Telepone 2</label>
                            <div class="col-sm-8">
                                <input class="form-control required" name="phone2" id="phone2" value="<?php echo $dataprofile->phone2; ?>" title="input this field" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Email</label>
                            <div class="col-sm-8">
                                <input class="form-control required" name="email" id="email" value="<?php echo $dataprofile->email; ?>"type="email" title="input this field" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Link Instagram</label>
                            <div class="col-sm-8">
                                <input class="form-control required" name="ig_link" id="ig_link" value="<?php echo $dataprofile->igLink; ?>" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Link Facebook</label>
                            <div class="col-sm-8">
                                <input class="form-control required" name="fb_link" id="fb_link" value="<?php echo $dataprofile->fbLink; ?>" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Link Twitter</label>
                            <div class="col-sm-8">
                                <input class="form-control required" name="twitt_link" id="twitt_link" value="<?php echo $dataprofile->twittLink; ?>" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Youtube Facebook</label>
                            <div class="col-sm-8">
                                <input class="form-control required" name="yt_link" id="yt_link" value="<?php echo $dataprofile->ytLink; ?>" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">WhatsApp Phone</label>
                            <div class="col-sm-8">
                                <input class="form-control required" name="wa" id="wa" value="<?php echo $dataprofile->waPhone; ?>" type="text" title="input this field" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Deskripsi Toko</label>
                            <div class="col-sm-8">
                                <textarea class="textarea form-control required" rows="7" name="companydesc" id="companydesc" title="input this field" required=""> <?php echo $dataprofile->companyDescription; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Meta Tag Deskripsi (Deskripsikan tentang kategori Website Anda, gunakan pemisah koma (,) )</label>
                            <div class="col-sm-8">
                                <textarea class="form-control required" rows="7" name="tagcompanydesc" id="tagcompanydesc" title="input this field" required=""> <?php echo $dataprofile->tagcompanyDescription; ?></textarea>
                            </div>
                        </div>
                        <button type="reset" class="btn btn-default pull-left">Reset</button>
                        <input type="button" onclick="updateCompany();" class="btn btn-success pull-right" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function updateCompany() {
        var valid = $("#companyprofile").valid();
        if (valid == true) {
            var form = $("#companyprofile").get(0);
            $('#loader').show();
            $.ajax({
                url: '<?php echo base_url('d/System/update_company') ?>',
                method: "POST",
                data: new FormData(form),
                contentType: false,
                processData: false,
                success: function (resp) {
                    $('#alert').html(resp);
                    $('#loader').hide();
                    settingCompanyProfile();
                }
            });
        }
    }
</script>